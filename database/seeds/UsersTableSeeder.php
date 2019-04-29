<?php

use App\Models\Company;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            $user = factory(App\User::class)->create([
                'company_id' => $companies->first->id,
                'name' => 'Jesús',
                'surname' => 'Amieiro',
                'username' => 'JesusAmieiro',
                'email' => 'amieiro@gmail.com',
                'password' => Hash::make('amieiro'),
            ]);
            $user->assignRole('Administrator');
        }
    }
}
