<?php

namespace Tests\Browser;

use App\Models\Company;
use App\Models\EventType;
use App\User;
use Carbon\Carbon;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DashboardTest extends DuskTestCase
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
     * Assert that a user can log in and can create a start workday event
     *
     * @throws \Throwable
     * @return void
     */
    public function testUserCanCreateAnEvent()
    {
        $company = Company::first();
        $user = factory(User::class)->create([
            'company_id' => $company->id,
            'password' => bcrypt('1234'),
        ]);
        $workdayId = EventType::where('name', 'workday')->first()->id;
        $today = Carbon::now()->format('d/m/Y');
        $user->assignRole('Supervisor');
        $this->browse(function (Browser $browser) use ($user, $workdayId, $today) {
            $browser->visit('/login');
            $browser->type('#email', $user->email);
            $browser->type('#password', '1234');
            $browser->press('Sign in');
            $browser->assertPathIs('/');
            $browser->assertSee($user->name . ' ' . $user->surname);
            $browser->assertSee('Supervisor');
            $browser->assertDontSee($today);
            $browser->click('#'. $workdayId);
            $browser->pause(1000);
            $browser->click('.swal2-confirm');
            $browser->pause(1000);
            $browser->pause(4000);
            $browser->assertSee($today);
        });
    }
}
