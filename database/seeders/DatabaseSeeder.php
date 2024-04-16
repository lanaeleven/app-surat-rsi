<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Direksi;
use App\Models\JenisSurat;
use App\Models\TujuanDisposisi;
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
            'namaJabatan' => 'Administrator',
            'password' => Hash::make('rahasia'),
            'level' => 'admin'
        ]);

        User::create([
            'username' => 'direktur',
            'namaJabatan' => 'Direktur Rumah Sakit',
            'password' => Hash::make('rahasia'),
            'level' => 'direktur'
        ]);

        User::create([
            'username' => 'kepala umum dakwah',
            'namaJabatan' => 'Kepala Bagian Umum dan Dakwah',
            'password' => Hash::make('rahasia'),
            'level' => 'kepala'
        ]);

        User::create([
            'username' => 'kepala sdi keuangan',
            'namaJabatan' => 'Kepala Bagian SDI dan Keuangan',
            'password' => Hash::make('rahasia'),
            'level' => 'kepala'
        ]);
        
        User::create([
            'username' => 'penjab umum',
            'namaJabatan' => 'Penanggung Jawab Umum dan PKRS',
            'password' => Hash::make('rahasia'),
            'level' => 'penjab'
        ]);

        User::create([
            'username' => 'penjab dakwah',
            'namaJabatan' => 'Penanggung Jawab Dakwah dan PKRS',
            'password' => Hash::make('rahasia'),
            'level' => 'penjab'
        ]);

        User::create([
            'username' => 'penjab sdi',
            'namaJabatan' => 'Penannggung Jawab SDI dan Administrasi',
            'password' => Hash::make('rahasia'),
            'level' => 'penjab'
        ]);

        User::create([
            'username' => 'penjab keuangan',
            'namaJabatan' => 'Penannggung Jawab Keuangan dan Akuntansi',
            'password' => Hash::make('rahasia'),
            'level' => 'penjab'
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

        //SEEDING UNTUK TABEL TUJUAN DISPOSISI

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Direktur',
            'divisiTujuanDisposisi' => 'direktur',
            'levelTujuanDisposisi' => 'direktur'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Kepala Bagian Umum dan Dakwah',
            'divisiTujuanDisposisi' => 'umum dan dakwah',
            'levelTujuanDisposisi' => 'kepala'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Kepala Bagian  SDI dan Keuangan',
            'divisiTujuanDisposisi' => 'sdi dan keuangan',
            'levelTujuanDisposisi' => 'kepala'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Penjab Umum dan PKRS',
            'divisiTujuanDisposisi' => 'umum dan dakwah',
            'levelTujuanDisposisi' => 'penjab'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Penjab Dakwah dan Kemitraan',
            'divisiTujuanDisposisi' => 'umum dan dakwah',
            'levelTujuanDisposisi' => 'penjab'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Penjab SDI dan Administrasi',
            'divisiTujuanDisposisi' => 'sdi dan keuangan',
            'levelTujuanDisposisi' => 'penjab'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Penjab Keuangan dan Akuntansi',
            'divisiTujuanDisposisi' => 'sdi dan keuangan',
            'levelTujuanDisposisi' => 'penjab'
        ]);

        

        // SEEDING UNTUK TABEL DIREKSI

        Direksi::create([
            'namaDireksi' => 'Direktur'
        ]);

        \App\Models\SuratKeluar::factory(50)->create();

        \App\Models\SuratMasuk::factory(50)->create();
    }
}
