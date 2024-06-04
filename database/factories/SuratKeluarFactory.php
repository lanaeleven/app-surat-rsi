<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratKeluar>
 */
class SuratKeluarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idJenisSurat' => fake()->numberBetween(1, 11),
            'idDireksi' => 1,
            'tahun' => 2024,
            'index' => 25,
            'tanggalSurat' => fake()->dateTimeInInterval('-2 years', '+2 years'),
            'tujuan' => fake()->word(),
            'perihal' => fake()->words(3, true),
            'keterangan' => fake()->words(5, true),
            'fileName' => 'sertifprogram.pdf',
            'filePath' => 'uploads/sertifprogram.pdf'
        ];
    }
}