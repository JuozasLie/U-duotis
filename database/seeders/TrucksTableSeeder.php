<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrucksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trucks = [
            [
                'unit_number' => 'A1578',
                'year' => 2010,
                'notes' => '“Available for rent”.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => '8050',
                'year' => 2015,
                'notes' => '“Available for rent”.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => '147859',
                'year' => 2020,
                'notes' => '“Available for rent”.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => 'B7845',
                'year' => 2023,
                'notes' => '“Available for rent”.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => 'A5555',
                'year' => 2001,
                'notes' => '“Available for rent”.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => 'A5556',
                'year' => 2023,
                'notes' => '“Available for rent”.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => 'A5557',
                'year' => 2015,
                'notes' => '“Available for rent”.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => 'A5558',
                'year' => 2018,
                'notes' => '“Available for rent”.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the trucks table
        DB::table('trucks')->insert($trucks);
    }
}
