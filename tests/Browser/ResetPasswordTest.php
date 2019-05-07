<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ResetPasswordTest extends DuskTestCase
{
    /**
     * Assert that a non-existent user cannot reset the password
     *
     * @throws \Throwable
     * @return void
     */
    public function testResetUserThatDoesNotExist()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/password/reset');
            $browser->type('email', 'amieiro+no+exists@gmail.com');
            $browser->press('Send Password Reset Link');
            $browser->assertPathIs('/password/reset');
            $browser->assertSee(__('We can\'t find a user with that e-mail address.'));
        });
    }
}
