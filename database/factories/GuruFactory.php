<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->randomNumber(5, true),
            'nama_guru' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement(['laki-laki', 'perempuan']),
            'alamat' => fake()->address(),
            'no_telefon' => fake()->phoneNumber()
        ];
    }
}
