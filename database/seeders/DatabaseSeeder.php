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

        // SEEDING UNTUK TABEL USER

        // User::create([
        //     'username' => 'admin',
        //     'namaJabatan' => 'Sekretariat',
        //     'password' => Hash::make('rahasia'),
        //     'level' => 'admin',
        //     'divisi' => 'admin'
        // ]);

        // User::create([
        //     'username' => 'direktur',
        //     'namaJabatan' => 'Direktur Rumah Sakit',
        //     'password' => Hash::make('rahasia'),
        //     'level' => 'direktur',
        //     'divisi' => 'direktur'
        // ]);

        // User::create([
        //     'username' => 'kepala umum dakwah',
        //     'namaJabatan' => 'Kepala Bagian Umum dan Dakwah',
        //     'password' => Hash::make('rahasia'),
        //     'level' => 'kepala',
        //     'divisi' => 'umum dan dakwah'
        // ]);

        // User::create([
        //     'username' => 'kepala sdi keuangan',
        //     'namaJabatan' => 'Kepala Bagian SDI dan Keuangan',
        //     'password' => Hash::make('rahasia'),
        //     'level' => 'kepala',
        //     'divisi' => 'sdi dan keuangan'
        // ]);
        
        // User::create([
        //     'username' => 'penjab umum',
        //     'namaJabatan' => 'Penanggung Jawab Umum dan PKRS',
        //     'password' => Hash::make('rahasia'),
        //     'level' => 'penjab',
        //     'divisi' => 'umum dan dakwah'
        // ]);

        // User::create([
        //     'username' => 'penjab dakwah',
        //     'namaJabatan' => 'Penanggung Jawab Dakwah dan Kemritraan',
        //     'password' => Hash::make('rahasia'),
        //     'level' => 'penjab',
        //     'divisi' => 'umum dan dakwah'
        // ]);

        // User::create([
        //     'username' => 'penjab sdi',
        //     'namaJabatan' => 'Penanggung Jawab SDI dan Administrasi',
        //     'password' => Hash::make('rahasia'),
        //     'level' => 'penjab',
        //     'divisi' => 'sdi dan keuangan'
        // ]);

        // User::create([
        //     'username' => 'penjab keuangan',
        //     'namaJabatan' => 'Penanggung Jawab Keuangan dan Akuntansi',
        //     'password' => Hash::make('rahasia'),
        //     'level' => 'penjab',
        //     'divisi' => 'sdi dan keuangan'
        // ]);

        User::create([
            'username' => 'sekre',
            'namaJabatan' => 'Sekretariat',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'direktur',
            'namaJabatan' => 'Direktur Rumah Sakit',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kabid pelayanan dan penunjang medik',
            'namaJabatan' => 'Kepala Bidang Pelayanan dan Penunjang Medik',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kasi pelayanan medik',
            'namaJabatan' => 'Kepala Seksi Pelayanan Medik',
            'password' => Hash::make('rahasia')
        ]);
        
        User::create([
            'username' => 'kasi penunjang medik',
            'namaJabatan' => 'Kepala Seksi Penunjang Medik dan Diklitbang',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kabid perawatan',
            'namaJabatan' => 'Kepala Bidang Perawatan',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kasi keperawatan',
            'namaJabatan' => 'Kepala Seksi Keperawatan',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kabag sdi dan keuangan',
            'namaJabatan' => 'Kepala Bagian SDI dan Keuangan',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kabag sdi dan keuangan',
            'namaJabatan' => 'Kepala Bagian SDI dan Keuangan',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kasubag sdi dan administrasi',
            'namaJabatan' => 'Kepala Sub Bagian SDI dan Administrasi',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kasubag akuntansi dan keuangan',
            'namaJabatan' => 'Kepala Sub Bagian Akuntansi dan Keuangan',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kepala umum dakwah dan kemitraan',
            'namaJabatan' => 'Kepala Bagian Umum, Dakwah, dan Kemitraan',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kasubag dakwah',
            'namaJabatan' => 'Kepala Sub Bagian Dakwah',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kasubag kemitraan dan pkrs',
            'namaJabatan' => 'Kepala Sub Bagian Kemitraan dan PKRS',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'penjab umum',
            'namaJabatan' => 'Penanggung Jawab Umum',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains farmasi',
            'namaJabatan' => 'Kepala Instalasi Farmasi',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'penjab farmasi',
            'namaJabatan' => 'Penanggung Jawab Farmasi',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains psrs',
            'namaJabatan' => 'Kepala Instalasi PSRS',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'penjab psrs',
            'namaJabatan' => 'Penanggung Jawab PSRS',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains rekam medis dan pendaftaran',
            'namaJabatan' => 'Kepala Instalasi Rekam Medis dan Pendaftaran',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'penjab pendaftaran dan rekam medis',
            'namaJabatan' => 'Penanggung Jawab Pendaftaran dan Rekam Medis',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains gizi',
            'namaJabatan' => 'Kepala Instalasi Gizi',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'penjab gizi',
            'namaJabatan' => 'Penanggung Jawab Gizi',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains ranap dan rajal',
            'namaJabatan' => 'Kepala Instalasi Rawat Inap dan Rawat Jalan',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'penjab rajal',
            'namaJabatan' => 'Penanggung Jawab Rawat Jalan',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'penjab ranap',
            'namaJabatan' => 'Penanggung Jawab Rawat Inap',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains igd',
            'namaJabatan' => 'Kepala Instalasi Gawat Darurat',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'karu igd',
            'namaJabatan' => 'Kepala Ruang Instalasi Gawat Darurat',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains icu',
            'namaJabatan' => 'Kepala Instalasi Intensive Care Unit',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'karu icu',
            'namaJabatan' => 'Kepala Ruang Intensive Care Unit',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains radiologi',
            'namaJabatan' => 'Kepala Instalasi Radiologi',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'penjab radiologi',
            'namaJabatan' => 'Penanggung Jawab Radiologi',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains ibs',
            'namaJabatan' => 'Kepala Instalasi Bedah Sentral',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'karu ibs',
            'namaJabatan' => 'Kepala Ruang Instalasi Bedah Sentral',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains lab',
            'namaJabatan' => 'Kepala Instalasi Laboratorium',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'penjab lab',
            'namaJabatan' => 'Penanggung Jawab Instalasi Laboratorium',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains dialis',
            'namaJabatan' => 'Kepala Instalasi Dialis',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'penjab dialis',
            'namaJabatan' => 'Penanggung Jawab Dialis',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'username' => 'kains mcu',
            'namaJabatan' => 'Kepala Instalasi MCU',
            'password' => Hash::make('rahasia')
        ]);

        //SEEDING UNTUK TABEL TUJUAN DISPOSISI

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Administrator',
            'idUser' => 1,
            'divisiTujuanDisposisi' => 'admin',
            'levelTujuanDisposisi' => 'admin'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Direktur',
            'idUser' => 2,
            'divisiTujuanDisposisi' => 'direktur',
            'levelTujuanDisposisi' => 'direktur'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Kepala Bagian Umum dan Dakwah',
            'idUser' => 3,
            'divisiTujuanDisposisi' => 'umum dan dakwah',
            'levelTujuanDisposisi' => 'kepala'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Kepala Bagian  SDI dan Keuangan',
            'idUser' => 4,
            'divisiTujuanDisposisi' => 'sdi dan keuangan',
            'levelTujuanDisposisi' => 'kepala'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Penjab Umum dan PKRS',
            'idUser' => 5,
            'divisiTujuanDisposisi' => 'umum dan dakwah',
            'levelTujuanDisposisi' => 'penjab'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Penjab Dakwah dan Kemitraan',
            'idUser' => 6,
            'divisiTujuanDisposisi' => 'umum dan dakwah',
            'levelTujuanDisposisi' => 'penjab'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Penjab SDI dan Administrasi',
            'idUser' => 7,
            'divisiTujuanDisposisi' => 'sdi dan keuangan',
            'levelTujuanDisposisi' => 'penjab'
        ]);

        TujuanDisposisi::create([
            'namaTujuanDisposisi' => 'Penjab Keuangan dan Akuntansi',
            'idUser' => 8,
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
