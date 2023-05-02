<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RF_Status_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'status_code' => 'AP01',
                'status_name' => 'New Application',
                'status_description' => 'Application submitted and pending review by other party',
            ],
            [
                'status_code' => 'AP02',
                'status_name' => 'Approved',
                'status_description' => 'Application has been approved',
            ],
            [
                'status_code' => 'AP03',
                'status_name' => 'Rejected',
                'status_description' => 'Application has been rejected',
            ],
            [
                'status_code' => 'EV01',
                'status_name' => 'Upcoming',
                'status_description' => 'Upcoming event. Start date is in the future',
            ],
            [
                'status_code' => 'EV02',
                'status_name' => 'Ongoing',
                'status_description' => 'Ongoing event. Start date is today',
            ],
            [
                'status_code' => 'EV03',
                'status_name' => 'Ended',
                'status_description' => 'Event has ended. End date is in the past',
            ]
        ];

        DB::table('rf_statuses')->insert($data);
    }
}
