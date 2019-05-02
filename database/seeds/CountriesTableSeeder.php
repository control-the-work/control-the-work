<?php

use App\Imports\CountriesImport;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Country::truncate();
            Excel::import(new CountriesImport, 'resources/assets/data/country-list/country.csv');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
