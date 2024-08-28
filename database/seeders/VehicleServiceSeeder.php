<?php

namespace Database\Seeders;

use App\Models\VehicleService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehicleService::factory()
            ->count(10)
            ->create();
    }
}
