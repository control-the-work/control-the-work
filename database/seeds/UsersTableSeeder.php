<?php

use App\Models\Company;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            $companies = Company::all();
            $companies->each(function ($company) {
                factory(App\User::class, 5)
                    ->create(['company_id' => $company->id]);
            });
        }
    }
}
