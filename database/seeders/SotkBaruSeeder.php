<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StrukturOrganisasi;
use App\Enums\LevelJabatan;

class SotkBaruSeeder extends Seeder
{
    public function run(): void
    {
        $jabatans = [
            'dirut'         => 'Direktur Utama',
            'spi'           => 'bagian SPI',
            'komitetim'     => 'bagian Komite / Tim',
            'dirpelayanan'  => 'Direktur Pelayanan dan Diversifikasi Usaha',
            'dirkeuangan'   => 'Direktur Keuangan, SDI & Umum',
            'manpelayanan'  => 'Manager Pelayanan & Penunjang Medik',
            'manpemasaran'  => 'Manager Pemasaran, Diversifikasi Usaha dan Kerohanian',
            'mankeuangan'   => 'Manager Keuangan, SDI & TI',
            'manumum'       => 'Manager Umum & Penunjang',
            'kabagpelmed'   => 'Kabag Pelayanan Medik',
            'kabagpenmed'   => 'Kabag Penunjang Medik & Diklitbang',
            'kabagperawat'  => 'Kabag Keperawatan',
            'sdinew'             => 'Kabag SDI dan Administrasi',
            'kabagakuntansi'  => 'Kabag Akuntansi & Keuangan',
            'kabagumum'       => 'Kabag Umum, Kerjasama',
            'kabagsapras'     => 'Kabag Sapras',
            'instalrajal'     => 'Instalasi Rawat Jalan',
            'instaligd'       => 'Instalasi IGD',
            'instalicu'       => 'Instalasi ICU',
            'instalhd'        => 'Instalasi Hemodialisis',
            'instalibs'       => 'Instalasi IBS',
            'instalradiologi' => 'Instalasi Radiologi',
            'installab'       => 'Instalasi Laboratorium',
            'instalrm'        => 'Instalasi Pendaftaran & RM',
            'instalgizi'      => 'Instalasi Gizi',
            'instalfarmasi'   => 'Instalasi Farmasi',
            'karanapinap'     => 'KA. Ruang Rawat Inap Rajal dan MPP',
        ];

        foreach ($jabatans as $username => $namaJabatan) {
            User::firstOrCreate(
                ['username' => $username],
                [
                    'nama'        => 'Belum diberi nama',
                    'email'       => 'edisposisisuratmasuk@gmail.com',
                    'namaJabatan' => $namaJabatan,
                    'password'    => Hash::make('rs1s4'),
                ]
            );
        }

        // Ambil semua id user berdasarkan username, supaya gampang direferensikan di bawah
        $userIds = User::whereIn('username', array_keys($jabatans))
            ->pluck('id', 'username'); // ['dirut' => 5, 'spi' => 6, ...]

        // Definisikan struktur: username => [levelJabatan, atasan_username (nullable)]
        $struktur = [
            'dirut'           => [LevelJabatan::DIREKTUR_UTAMA->value, 'dirut'],
            'spi'             => [LevelJabatan::DIREKTUR_PELAKSANA->value, 'dirut'],
            'komitetim'       => [LevelJabatan::DIREKTUR_PELAKSANA->value, 'dirut'],
            'dirpelayanan'    => [LevelJabatan::DIREKTUR_PELAKSANA->value, 'dirut'],
            'dirkeuangan'     => [LevelJabatan::DIREKTUR_PELAKSANA->value, 'dirut'],
            'manpelayanan'    => [LevelJabatan::MANAGER->value, 'dirpelayanan'],
            'manpemasaran'    => [LevelJabatan::MANAGER->value, 'dirpelayanan'],
            'mankeuangan'     => [LevelJabatan::MANAGER->value, 'dirkeuangan'],
            'manumum'         => [LevelJabatan::MANAGER->value, 'dirkeuangan'],
            'kabagpelmed'     => [LevelJabatan::KABAG->value, 'manpelayanan'],
            'kabagpenmed'     => [LevelJabatan::KABAG->value, 'manpelayanan'],
            'kabagperawat'    => [LevelJabatan::KABAG->value, 'manpelayanan'],
            'sdinew'          => [LevelJabatan::KABAG->value, 'mankeuangan'],
            'kabagakuntansi'  => [LevelJabatan::KABAG->value, 'mankeuangan'],
            'kabagumum'       => [LevelJabatan::KABAG->value, 'manumum'],
            'kabagsapras'     => [LevelJabatan::KABAG->value, 'manumum'],
            'instalrajal'     => [LevelJabatan::PELAKSANA->value, 'kabagpelmed'],
            'instaligd'       => [LevelJabatan::PELAKSANA->value, 'kabagpelmed'],
            'instalicu'       => [LevelJabatan::PELAKSANA->value, 'kabagpelmed'],
            'instalhd'        => [LevelJabatan::PELAKSANA->value, 'kabagpelmed'],
            'instalibs'       => [LevelJabatan::PELAKSANA->value, 'kabagpelmed'],
            'instalradiologi' => [LevelJabatan::PELAKSANA->value, 'kabagpenmed'],
            'installab'       => [LevelJabatan::PELAKSANA->value, 'kabagpenmed'],
            'instalrm'        => [LevelJabatan::PELAKSANA->value, 'kabagpenmed'],
            'instalgizi'      => [LevelJabatan::PELAKSANA->value, 'kabagpenmed'],
            'instalfarmasi'   => [LevelJabatan::PELAKSANA->value, 'kabagpenmed'],
            'karanapinap'     => [LevelJabatan::PELAKSANA->value, 'kabagperawat'],
        ];

        foreach ($struktur as $username => [$level, $atasanUsername]) {
            StrukturOrganisasi::updateOrCreate(
                ['idUser' => $userIds[$username]],
                [
                    'idAtasan'     => $atasanUsername ? $userIds[$atasanUsername] : $userIds[$username],
                    'levelJabatan' => $level,
                ]
            );
        }
    }
}