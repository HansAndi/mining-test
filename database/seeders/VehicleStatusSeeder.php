<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Available',
            'Unavailable',
            'Maintenance',
        ];

        foreach ($statuses as $status) {
            \App\Models\VehicleStatus::create([
                'name' => $status,
            ]);
        }
    }
}
