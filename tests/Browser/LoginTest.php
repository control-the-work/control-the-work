<?php

namespace Tests\Browser;

use App\Models\Company;
use App\User;
use Faker\Generator as Faker;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testUserCanNotLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login');
            $browser->type('email', 'amieiro+no+exists@gmail.com');
            $browser->type('password', '1234');
            $browser->press('Acceder');
            $browser->assertPathIs('/login');
            $browser->assertSee(trans('Estas credenciales no coinciden con nuestros registros.'));
        });
    }

    public function testUserCanLogin() {
        $company = Company::first();
        $user = factory(User::class)->create([
            'company_id' => $company->id,
            'password' => bcrypt('1234')
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login');
            $browser->type('email', $user->email);
            $browser->type('password', '1234');
            $browser->press('Acceder');
            $browser->assertPathIsNot('/login');
            $browser->assertDontSee(trans('Estas credenciales no coinciden con nuestros registros.'));
        });

    }
}
