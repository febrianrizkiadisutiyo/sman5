<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Siswa::factory(20)->create();
        Guru::factory(5)->create();
        Kelas::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Admin TU',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('admin12345')
        // ]);
    }
}
