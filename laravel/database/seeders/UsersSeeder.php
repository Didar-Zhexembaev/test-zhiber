<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'john',
            'email'             => 'test@mail.ru',
            'email_verified_at' => now(),
            'password'          => bcrypt('adminQwerty123*'),
        ]);
    }
}
