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
            'idPosisiDisposisi' => 1,
            'statusArsip' => 0,
            'nomorSurat' => fake()->word(),
            'tanggalSurat' => fake()->dateTimeThisYear(),
            'tanggalAgenda' => fake()->dateTimeThisYear(),
            'sifatSurat' => fake()->randomElement(['Biasa', 'Rahasia', 'Segera']),
            'pengirim' => fake()->word(),
            'perihal' => fake()->words(2, true),
            'lampiran' => fake()->randomElement(['Ada', 'Tidak Ada']),
            'status' => 'Belum Diteruskan',
            // 'status' => fake()->randomElement(['Belum Diteruskan', 'Diteruskan ke Direktur', 'Diteruskan ke Kepala Bagian', 'Diteruskan ke Penanggung Jawab', 'Diarsipkan']),
            'fileName' => 'sertifprogram.pdf',
            'filePath' => 'uploads/sertifprogram.pdf'
        ];
    }
}
