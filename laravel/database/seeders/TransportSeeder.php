<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transport;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transports = [
            [
                'transport'  => 'Самолет',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transport'  => 'Поезд',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transport'  => 'Машина',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transport'  => 'Автобус',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Transport::insert($transports);
    }
}
