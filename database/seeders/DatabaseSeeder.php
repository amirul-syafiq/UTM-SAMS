<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

  
        $this->call([
            UserRoleSeeder::class,
            RF_Application_Status_seeder::class,
            
        ]);
        \App\Models\User::factory(10)->create();

        \App\Models\Event::factory(10)->create();
        \App\Models\EventPromotion::factory(10)->create();
        \App\Models\EventImage::factory(10)->create();
    }
}
