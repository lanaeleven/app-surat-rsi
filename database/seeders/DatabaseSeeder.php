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
        // 'email' => 'test@example.com',
        // ]);

        

        


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

        // JenisSurat::create([
        //     'kodeJenisSurat' => 'SPO',
        //     'keterangan' => 'Prosedur'
        // ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'TAG',
            'keterangan' => 'Tagihan'
        ]);

        JenisSurat::create([
            'kodeJenisSurat' => 'SE',
            'keterangan' => 'Surat Edaran'
        ]);

        // SEEDING UNTUK TABEL USER

        User::create([
            'username' => 'sekre',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Sekretariat',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'direktur',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Direktur Rumah Sakit',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kabid pelayanan dan penunjang medik',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Bidang Pelayanan dan Penunjang Medik',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kasi pelayanan medik',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Seksi Pelayanan Medik',
            'password' => Hash::make('Rahasia123!')
        ]);
        
        User::create([
            'username' => 'kasi penunjang medik',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Seksi Penunjang Medik dan Diklitbang',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kabid perawatan',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Bidang Perawatan',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kasi keperawatan',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Seksi Keperawatan',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kabag sdi dan keuangan',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Bagian SDI dan Keuangan',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kasubag sdi dan administrasi',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Sub Bagian SDI dan Administrasi',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kasubag akuntansi dan keuangan',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Sub Bagian Akuntansi dan Keuangan',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kepala umum dakwah dan kemitraan',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Bagian Umum, Dakwah, dan Kemitraan',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kasubag dakwah',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Sub Bagian Dakwah',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kasubag kemitraan dan pkrs',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Sub Bagian Kemitraan dan PKRS',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'penjab umum',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Penanggung Jawab Umum',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains farmasi',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi Farmasi',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'penjab farmasi',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Penanggung Jawab Farmasi',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains psrs',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi PSRS',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'penjab psrs',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Penanggung Jawab PSRS',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains rekam medis dan pendaftaran',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi Rekam Medis dan Pendaftaran',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'penjab pendaftaran dan rekam medis',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Penanggung Jawab Pendaftaran dan Rekam Medis',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains gizi',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi Gizi',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'penjab gizi',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Penanggung Jawab Gizi',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains ranap dan rajal',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi Rawat Inap dan Rawat Jalan',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'penjab rajal',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Penanggung Jawab Rawat Jalan',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'penjab ranap',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Penanggung Jawab Rawat Inap',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains igd',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi Gawat Darurat',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'karu igd',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Ruang Instalasi Gawat Darurat',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains icu',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi Intensive Care Unit',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'karu icu',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Ruang Intensive Care Unit',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains radiologi',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi Radiologi',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'penjab radiologi',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Penanggung Jawab Radiologi',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains ibs',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi Bedah Sentral',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'karu ibs',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Ruang Instalasi Bedah Sentral',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains lab',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi Laboratorium',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'penjab lab',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Penanggung Jawab Instalasi Laboratorium',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains dialis',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi Dialis',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'penjab dialis',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Penanggung Jawab Dialis',
            'password' => Hash::make('Rahasia123!')
        ]);

        User::create([
            'username' => 'kains mcu',
            'nama' => 'Mr. X',
            'email' => 'maulanaelvn@gmail.com',
            'namaJabatan' => 'Kepala Instalasi MCU',
            'password' => Hash::make('Rahasia123!')
        ]);


        // SEEDING UNTUK TABEL DIREKSI

        Direksi::create([
            'namaDireksi' => 'Direktur'
        ]);

        \App\Models\SuratKeluar::factory(50)->create();

        // \App\Models\SuratMasuk::factory(100)->create();

        \App\Models\Spo::factory(50)->create();
    }
}
