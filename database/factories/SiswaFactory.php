<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nis' => fake()->unique()->randomNumber(5, true),
            'id_kelas' => fake()->numberBetween(1, 5),
            'nama_siswa' => fake()->name(),
            'agama' => fake()->randomElement(['islam', 'kristen', 'hindu', 'budha', 'konghucu']),
            'tempat_lahir' =>fake()->address(),
            'tgl_lahir' => fake()->date(),
            'jenis_kelamin' => fake()->randomElement(['laki-laki', 'perempuan']),
            'alamat' => fake()->address(),
            'jurusan' => fake()->randomElement(['IPA', 'IPS'])
        ];
    }
}
