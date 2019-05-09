<?php

namespace Tests\Browser;

use App\Models\Company;
use App\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    /**
     * Delete all the cookies in each execution
     */
    public function setUp(): void
    {
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
        parent::setUp();
    }

    /**
     * Assert that an existent and verified user can log in, change his password
     * with a correct one, logout and login with the new password
     *
     * @return void
     * @throws \Throwable
     *
     */

    public function testEditUserInsertANewCorrectPasswordAndCanLoginWithTheNewPassword()
    {
        $password = Str::random(20);
        $company = Company::first();
        $user = factory(User::class)->create([
            'company_id' => $company->id,
            'password' => bcrypt($password),
        ]);
        $user->assignRole('Labor union');
        $this->browse(function (Browser $browser) use ($user, $password) {
            $newPassword = Str::random(20);
            // Login
            $browser->visit('/login');
            $browser->type('#email', $user->email);
            $browser->type('#password', $password);
            $browser->press('Sign in');
            $browser->assertPathIs('/');
            // Try to update the password with a new password (20 characters)
            $browser->click('#avatar');
            $browser->assertSee('Profile');
            $browser->click('#profile');
            $browser->assertPathIs('/users/' . $user->id . '/edit');
            $browser->type('#password', $newPassword);
            $browser->type('#password_confirmation', $newPassword);
            $browser->press('Update user');
            // Wait that the swal popup closes
            $browser->pause(3500);
            // Log out
            $browser->click('#avatar');
            $browser->assertSee('Sign out');
            $browser->click('#logout');
            $browser->assertPathIs('/login');
            // Correct login
            $browser->type('#email', $user->email);
            $browser->type('#password', $newPassword);
            $browser->press('Sign in');
            $browser->assertPathIs('/');
        });
    }

    /**
     * Assert that an existent and verified user can log in, can not change his
     * password with an incorrect one, logout, can not login with the new
     * password and can login with the old password
     *
     * @return void
     * @throws \Throwable
     *
     */

    public function testEditUserInsertANewInorrectPasswordAndCanNotLoginWithTheNewPassword()
    {
        $password = Str::random(20);
        $company = Company::first();
        $user = factory(User::class)->create([
            'company_id' => $company->id,
            'password' => bcrypt($password),
        ]);
        $user->assignRole('Administrator');
        $this->browse(function (Browser $browser) use ($user, $password) {
            $newPassword = Str::random(5);
            // Login
            $browser->visit('/login');
            $browser->type('#email', $user->email);
            $browser->type('#password', $password);
            $browser->press('Sign in');
            $browser->assertPathIs('/');
            // Try to update the password with a new password (5 characters)
            $browser->click('#avatar');
            $browser->assertSee('Profile');
            $browser->click('#profile');
            $browser->assertPathIs('/users/' . $user->id . '/edit');
            $browser->type('#password', $newPassword);
            $browser->type('#password_confirmation', $newPassword);
            $browser->press('Update user');
            // Wait that the swal popup closes
            $browser->pause(3500);
            // Log out
            $browser->click('#avatar');
            $browser->assertSee('Sign out');
            $browser->click('#logout');
            $browser->assertPathIs('/login');
            // Incorrect login
            $browser->type('#email', $user->email);
            $browser->type('#password', $newPassword);
            $browser->press('Sign in');
            $browser->assertPathIs('/login');
            // Correct login
            $browser->type('#email', $user->email);
            $browser->type('#password', $password);
            $browser->press('Sign in');
            $browser->assertPathIs('/');
        });
    }

    /**
     * Assert that an existent and verified user can log in, can not change his
     * password with an incorrect one, logout, can not login with the new
     * password and can login with the old password
     *
     * @return void
     * @throws \Throwable
     *
     */
    public function testEditUserInsertBlankSpacesInThePassWordAndThePasswordDoesNotChange()
    {
        {
            $password = Str::random(20);
            $company = Company::first();
            $user = factory(User::class)->create([
                'company_id' => $company->id,
                'password' => bcrypt($password),
            ]);
            $user->assignRole('Employee');
            for ($i = 3; $i <= 9; $i += 3) {
                $emptyPassword = str_pad('', $i);
                $this->browse(function (Browser $browser) use ($user, $password, $emptyPassword) {
                    // Login
                    $browser->visit('/login');
                    $browser->type('#email', $user->email);
                    $browser->type('#password', $password);
                    $browser->press('Sign in');
                    $browser->assertPathIs('/');
                    // Try to update the password with an empty password (6 blank characters)
                    $browser->click('#avatar');
                    $browser->assertSee('Profile');
                    $browser->click('#profile');
                    $browser->assertPathIs('/users/' . $user->id . '/edit');
                    $browser->type('#password', $emptyPassword);
                    $browser->type('#password_confirmation', $emptyPassword);
                    $browser->press('Update user');
                    // Wait that the swal popup closes
                    $browser->pause(3500);
                    // Log out
                    $browser->click('#avatar');
                    $browser->assertSee('Sign out');
                    $browser->click('#logout');
                    $browser->assertPathIs('/login');
                    // Incorrect login
                    $browser->type('#email', $user->email);
                    $browser->type('#password', $emptyPassword);
                    $browser->press('Sign in');
                    $browser->assertPathIs('/login');
                    // Correct login
                    $browser->type('#email', $user->email);
                    $browser->type('#password', $password);
                    $browser->press('Sign in');
                    $browser->assertPathIs('/');
                    // Log out
                    $browser->click('#avatar');
                    $browser->assertSee('Sign out');
                    $browser->click('#logout');
                    $browser->assertPathIs('/login');
                });
            }
        }
    }
}
