<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratMasuk>
 */
class SuratMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'idDireksi' => 1,
            'nomorSurat' => fake()->word(),
            'tanggalSurat' => fake()->dateTimeBetween(),
            'tanggalAgenda' => fake()->dateTimeBetween(),
            'sifatSurat' => fake()->randomElement(['Biasa', 'Rahasia', 'Segera']),
            'pengirim' => fake()->word(),
            'perihal' => fake()->words(3, true),
            'lampiran' => fake()->randomElement(['Ada', 'Tidak Ada']),
            'fileName' => 'sertifprogram.pdf',
            'filePath' => 'uploads/sertifprogram.pdf'
        ];
    }
}
