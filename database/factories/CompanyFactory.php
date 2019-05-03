<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'city' => $faker->city,
        'postal_code' => $faker->postcode,
        'country' => $faker->countryCode,
        'comments' => $faker->realText(850),
        'subdomain' => $faker->shuffleString('myawesomesubdomain'),
    ];
});
