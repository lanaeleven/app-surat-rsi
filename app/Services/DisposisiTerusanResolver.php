<?php

namespace App\Services;

use App\Enums\LevelJabatan;
use App\Models\PengirimKhusus;
use App\Models\PenerimaKhusus;
use App\Models\PenggunaPenerusSuratSekretariat;
use App\Models\StrukturOrganisasi;
use App\Models\User;
use Illuminate\Support\Collection;

class DisposisiTerusanResolver
{

    public function resolve(User $user): Collection|string
    {
        if ($user->isKhusus) {
            return $this->resolveUntukKhusus($user->id);
        }

        return $this->resolveUntukNonKhusus($user->id);
    }

    private function resolveUntukKhusus(int $idUser): Collection
    {
        $penerimaTerusanKhusus = PengirimKhusus::where('idUser', $idUser)->get();

        return User::whereIn('id', $penerimaTerusanKhusus->pluck('bisaMengirimKe'))->get();
    }

    private function resolveUntukNonKhusus(int $idUser): Collection|string
    {
        $terusanKhusus = $this->getTerusanKhusus($idUser);
        $levelJabatan = StrukturOrganisasi::where('idUser', $idUser)->value('levelJabatan')->value;

        if (! $levelJabatan) {
            return 'Maaf, posisi Jabatan Akun Anda belum disetting oleh Sekretariat, Silakan hubungi Sekretariat';
        }

        $terusan = match ($levelJabatan) {
            LevelJabatan::SEKRETARIAT->value => $this->resolveSekretariat($idUser),
            LevelJabatan::DIREKTUR_OLD->value => $this->resolveDirekturOld($idUser),
            LevelJabatan::KABAG_KABID_OLD->value => $this->resolveKabagKabidOld($idUser),
            LevelJabatan::KASUBAG_OLD->value => $this->resolveKasubagLama($idUser),
            LevelJabatan::KOMITE_TIM_OLD->value => $this->resolveKomiteTimLama($idUser),
            LevelJabatan::DIREKTUR_UTAMA->value => $this->resolveCommonFlow($idUser, $levelJabatan),
            LevelJabatan::DIREKTUR_PELAKSANA->value => $this->resolveCommonFlow($idUser, $levelJabatan),
            LevelJabatan::MANAGER->value => $this->resolveCommonFlow($idUser, $levelJabatan),
            LevelJabatan::KABAG->value => $this->resolveCommonFlow($idUser, $levelJabatan),
            LevelJabatan::PELAKSANA->value => $this->resolveCommonFlow($idUser, $levelJabatan),
            default => 'Maaf, posisi Jabatan Akun Anda belum disetting oleh Sekretariat, Silakan hubungi Sekretariat',
        };

        if (! $terusan instanceof Collection) {
            return $terusan; // pesan error, langsung return
        }

        $terusanSekre = PenggunaPenerusSuratSekretariat::pluck('idUser');

        if ($terusanSekre->contains($idUser)) {
            $terusan = $terusan->merge($this->getUserSekretariat());
        }

        return $terusan->merge($terusanKhusus);
    }

    private function getTerusanKhusus(int $idUser): Collection
    {
        $pengirimTerusanKhusus = PenerimaKhusus::where('bisaMenerimaDari', $idUser)->get();

        return User::whereIn('id', $pengirimTerusanKhusus->pluck('idUser'))->get();
    }

    private function baseQuery(int $idUser)
    {
        return User::where('isKhusus', false)
            ->where('id', '!=', $idUser)
            ->where('isAktif', true);
    }

    private function getUserSekretariat(): Collection
    {
        return User::whereIn('id', function ($q) {
            $q->select('idUser')
                ->from('struktur_organisasi')
                ->where('levelJabatan', LevelJabatan::SEKRETARIAT->value);
        })->get();
    }

    private function resolveSekretariat(int $idUser): Collection
    {
        return $this->baseQuery($idUser)
            ->whereIn('id', function ($q) {
                $q->select('idUser')
                    ->from('struktur_organisasi')
                    ->whereIn('levelJabatan', [
                        LevelJabatan::DIREKTUR_OLD->value,
                        LevelJabatan::KABAG_KABID_OLD->value,
                        LevelJabatan::KASUBAG_OLD->value,
                        LevelJabatan::KOMITE_TIM_OLD->value,
                        LevelJabatan::DIREKTUR_UTAMA->value,
                        LevelJabatan::DIREKTUR_PELAKSANA->value,
                        LevelJabatan::MANAGER->value,
                        LevelJabatan::KABAG->value,
                        LevelJabatan::PELAKSANA->value,
                    ]);
            })
            ->get();
    }

    private function resolveDirekturOld(int $idUser): Collection
    {
        return $this->baseQuery($idUser)
            ->whereIn('id', function ($q) {
                $q->select('idUser')
                    ->from('struktur_organisasi')
                    ->whereIn('levelJabatan', [
                        LevelJabatan::DIREKTUR_OLD->value,
                        LevelJabatan::KABAG_KABID_OLD->value,
                        LevelJabatan::KOMITE_TIM_OLD->value
                    ]);
            })
            ->get();
    }

    private function resolveKabagKabidOld(int $idUser): Collection
    {
        return $this->baseQuery($idUser)
            ->whereIn('id', function ($q) use ($idUser) {
                $q->select('idUser')
                    ->from('struktur_organisasi')
                    ->whereIn('levelJabatan', [
                        LevelJabatan::DIREKTUR_OLD->value,
                        LevelJabatan::KABAG_KABID_OLD->value,
                        LevelJabatan::KOMITE_TIM_OLD->value
                    ])
                    ->orWhere('idAtasan', $idUser);
            })
            ->get();
    }

    private function resolveKasubagLama(int $idUser): Collection
    {
        $idAtasan = StrukturOrganisasi::where('idUser', $idUser)->value('idAtasan');

        return $this->baseQuery($idUser)
            ->where(function ($q) use ($idAtasan) {
                $q->whereIn('id', function ($sub) {
                    $sub->select('idUser')
                        ->from('struktur_organisasi')
                        ->whereIn('levelJabatan', [
                            LevelJabatan::KASUBAG_OLD->value,
                            LevelJabatan::KOMITE_TIM_OLD->value
                        ]);
                });

                if ($idAtasan !== null) {
                    $q->orWhere('id', $idAtasan);
                }
            })
            ->get();
    }

    private function resolveKomiteTimLama(int $idUser): Collection
    {
        return $this->baseQuery($idUser)
            ->whereIn('id', function ($q) {
                $q->select('idUser')
                    ->from('struktur_organisasi')
                    ->whereIn('levelJabatan', [
                        LevelJabatan::DIREKTUR_OLD->value,
                        LevelJabatan::KABAG_KABID_OLD->value,
                        LevelJabatan::KASUBAG_OLD->value,
                        LevelJabatan::KOMITE_TIM_OLD->value
                    ]);
            })
            ->get();
    }

    private function resolveCommonFlow(int $idUser, int $levelJabatan): Collection
    {
        $idAtasan = StrukturOrganisasi::where('idUser', $idUser)->value('idAtasan');

        return $this->baseQuery($idUser)
            ->whereIn('id', function ($q) use ($idUser, $levelJabatan, $idAtasan) {
                $q->select('idUser')
                    ->from('struktur_organisasi')
                    ->where('levelJabatan', $levelJabatan)
                    ->orWhere('idAtasan', $idUser);

                if ($idAtasan !== null) {
                    $q->orWhere('id', $idAtasan);
                }
            })
            ->get();
    }
}
