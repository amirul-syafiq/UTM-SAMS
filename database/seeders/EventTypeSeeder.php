<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_types')->insert([[
            'event_type_name' => 'Sports',
            'event_type_description' => 'Sports events',
        ],
        [
            'event_type_name' => 'Cultural',
            'event_type_description' => 'Cultural events',
        ],
        [
            'event_type_name' => 'Academic',
            'event_type_description' => 'Academic events',
        ],
        [
            'event_type_name' => 'Others',
            'event_type_description' => 'Other events',
        ]]);
    }
}
