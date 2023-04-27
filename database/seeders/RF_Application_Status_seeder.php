<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RF_Application_Status_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'status_code' => 'A01',
                'application_status' => 'New Application',
                'application_status_description' => 'Application submitted and pending review by other party',
            ],
            [
                'status_code' => 'A02',
                'application_status' => 'Approved',
                'application_status_description' => 'Application has been approved',
            ],
            [
                'status_code' => 'A03',
                'application_status' => 'Rejected',
                'application_status_description' => 'Application has been rejected',
            ],
        ];
    
        DB::table('rf_application_statuses')->insert($data);
    }
}
