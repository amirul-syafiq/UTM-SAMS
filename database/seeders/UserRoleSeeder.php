<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([[
            'role_code'=>'UR01',
            'role_name' => 'Staff',
            'role_description' => 'UTM Staff',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        [
            'role_code'=>'UR02',
            'role_name' => 'Student',
            'role_description' => 'UTM Students',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ],
        [
            'role_code'=>'UR03',
            'role_name' => 'Club/Association',
            'role_description' => 'Registered clubs and associations',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ],
        [   'role_code'=>'UR04',
            'role_name' => 'Admin',
            'role_description' => 'Super user of the system',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]
        ]
    );
    }
}
