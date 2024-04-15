<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Direksi;
use App\Models\JenisSurat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        

        // SEEDING UNTUK TABEL USER

        User::create([
            'username' => 'admin',
            'password' => Hash::make('rahasia'),
            'level' => 'admin'
        ]);

        // SEEDING UNTUK TABEL JENIS SURAT 

        JenisSurat::create([
            'kodeJenisSurat' => 'B',
            'keterangan' => 'Umum'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'K',
            'keterangan' => 'Kepegawaian'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'Y',
            'keterangan' => 'YBWSA dan Lingkungannya'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'URT',
            'keterangan' => 'Internal Umum'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'KPTS',
            'keterangan' => 'Surat Keputusan'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'PKS',
            'keterangan' => 'Perjanjian Kerja Sama'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'ST',
            'keterangan' => 'Surat Tugas'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'PER',
            'keterangan' => 'Peraturan'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'KBJ',
            'keterangan' => 'Kebijakan'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'SPO',
            'keterangan' => 'Prosedur'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'TAG',
            'keterangan' => 'Tagihan'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'SE',
            'keterangan' => 'Surat Edaran'
        ]);

        // SEEDING UNTUK TABEL DIREKSI

        Direksi::create([
            'namaDireksi' => 'Direktur'
        ]);

        \App\Models\SuratKeluar::factory(50)->create();

        \App\Models\SuratMasuk::factory(50)->create();
    }
}
