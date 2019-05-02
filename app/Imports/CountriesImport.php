<?php

namespace App\Imports;

use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;

class CountriesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \App\Models\Country|null
    */
    public function model(array $row)
    {
        return new Country([
            'id'     => $row[0],
            'name'    => $row[1],
        ]);
    }
}
