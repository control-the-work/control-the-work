<?php

use App\Models\EventType;
use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventType::create([
            'name' => 'workday',
        ]);
        EventType::create([
            'name' => 'pause',
        ]);
        EventType::create([
            'name' => 'lunch',
        ]);
    }
}
