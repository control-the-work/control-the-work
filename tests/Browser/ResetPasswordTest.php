<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ResetPasswordTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/password/reset');
            $browser->type('email', 'amieiro+no+exists@gmail.com');
            $browser->press('Enviar enlace');
            $browser->assertPathIs('/password/reset');
            $browser->assertSee(__('No podemos encontrar ningún usuario con ese correo electrónico'));
        });
    }
}
