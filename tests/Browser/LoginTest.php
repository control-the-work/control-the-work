<?php

namespace Tests\Browser;

use App\Models\Company;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Spatie\Permission\Models\Role;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
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
     * Assert that a non-existent user cannot login in the system
     *
     * @throws \Throwable
     */
    public function testUserThatDoesNotExistCanNotLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login');
            $browser->type('#email', 'amieiro+no+exists@gmail.com');
            $browser->type('#password', '1234');
            $browser->press('Sign in');
            $browser->assertPathIs('/login');
            $browser->assertSee('These credentials do not match our records.');
        });
    }

    /**
     * Assert that an existent user that is not verified cannot login in the
     * system and that he sees the verification alert
     *
     * @throws \Throwable
     */
    public function testUserThatExistsAndItIsNotVerifiedCanNotLogin() {
        $company = Company::first();
        $user = factory(User::class)->create([
            'company_id' => $company->id,
            'password' => bcrypt('1234'),
            'email_verified_at' => null,
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login');
            $browser->type('#email', $user->email);
            $browser->type('#password', '1234');
            $browser->press('Sign in');
            $browser->assertPathIsNot('/login');
            $browser->assertDontSee('These credentials do not match our records.');
            $browser->assertPathIs('/email/verify');
            $browser->assertSee('Before proceeding, please check your email for a verification link. If you did not receive the email');
        });
    }

    /**
     * Assert that an existent user that is verified cannot login in the
     * system if he uses incorrect credentials
     *
     * @throws \Throwable
     */
    public function testUserThatExistsAndItIsVerifiedCanNotLoginWithAnIncorrectPassword() {
        $company = Company::first();
        $user = factory(User::class)->create([
            'company_id' => $company->id,
            'password' => bcrypt('1234'),
        ]);
        $user->assignRole('Employee');
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login');
            $browser->screenshot("a");
            $browser->type('#email', $user->email);
            $browser->type('#password', '123456');
            $browser->press('Sign in');
            $browser->assertPathIs('/login');
            $browser->assertSee('These credentials do not match our records.');
            $browser->assertPathIsNot('/');
            $browser->assertDontSee($user->name . ' ' . $user->surname);
            $browser->assertDontSee('Employee');
        });

    }

    /**
     * Assert that an existent user that is verified can login in the
     * system if he uses correct credentials
     *
     * @throws \Throwable
     */
    public function testUserThatExistsAndItIsVerifiedCanLoginWithAnCorrectPassword() {
        $company = Company::first();
        $user = factory(User::class)->create([
            'company_id' => $company->id,
            'password' => bcrypt('1234'),
            'email_verified_at' => Carbon::now()
        ]);
        $user->assignRole('Supervisor');
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login');
            $browser->type('#email', $user->email);
            $browser->type('#password', '1234');
            $browser->press('Sign in');
            $browser->assertPathIs('/');
            $browser->assertSee($user->name . ' ' . $user->surname);
            $browser->assertSee('Supervisor');
        });
    }
}
