<?php

namespace App\Enums;

enum LevelJabatan: int
{
    case DEVELOPER = 0;
    case SEKRETARIAT = 1;
    case DIREKTUR_OLD = 2;
    case KABAG_KABID_OLD = 3;
    case KASUBAG_OLD = 4;
    case KOMITE_TIM_OLD = 5;
    case DIREKTUR_UTAMA = 6;
    case DIREKTUR_PELAKSANA = 7;
    case MANAGER = 8;
    case KABAG = 9;
    case PELAKSANA = 10;

    public function label(): string
    {
        return match ($this) {
            self::SEKRETARIAT => 'Sekretariat',
            self::DIREKTUR_OLD => 'Direktur (21-26)',
            self::KABAG_KABID_OLD => 'Kabag/Kabid (21-26)',
            self::KASUBAG_OLD => 'Kains/Kasubbag/Kasi/Penjab (21-26)',
            self::KOMITE_TIM_OLD => 'Komite/Tim (21-26)',
            self::DIREKTUR_UTAMA => 'Direktur Utama',
            self::DIREKTUR_PELAKSANA => 'Direktur Pelaksana',
            self::MANAGER => 'Manager',
            self::KABAG => 'Kabag',
            self::PELAKSANA => 'Pelaksana',
        };
    }
}