<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DepartureType;

class DepartureTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departureTypes = [
            [
                'type'       => 'Документ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type'       => 'Посылка',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DepartureType::insert($departureTypes);
    }
}
