<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            'Kantor Pusat',
            'Kantor Cabang',
            'Tambang 1',
            'Tambang 2',
            'Tambang 3',
            'Tambang 4',
            'Tambang 5',
            'Tambang 6',
        ];

        foreach ($locations as $location) {
            \App\Models\Location::create([
                'name' => $location,
            ]);
        }
    }
}
