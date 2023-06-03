<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkunSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin TU',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin12345'),
                'role' => 'TU'
            ],
            [
                'name' => 'Guru',
                'email' => 'guru@gmail.com',
                'password' => bcrypt('guru12345'),
                'role' => 'Guru'
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
