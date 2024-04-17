<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\TujuanDisposisi;

class DashboardController extends Controller
{
    public function create() {
        $belumDiteruskan = 0;
        $sudahDiteruskan = 0;

        if (auth()->user()->level === 'direktur') {
            $belumDiteruskan = SuratMasuk::where('status', '=', 'Diteruskan ke Direktur')->count();
            $sudahDiteruskan = SuratMasuk::where('status', '=', 'Diteruskan ke Kepala Bagian')->count();
        }

        if (auth()->user()->level === 'kepala') {
            $distribusiSuratBelumDiteruskan = TujuanDisposisi::where('id', '=', auth()->user()->id)->get()[0]->tujuanDisposisi;
            foreach ($distribusiSuratBelumDiteruskan as $dsbd) {
                if ($dsbd->suratMasuk->status === 'Diteruskan ke Kepala Bagian') {
                    $belumDiteruskan++;
                }
            }
            $sudahDiteruskan = TujuanDisposisi::where('id', '=', auth()->user()->id)->get()[0]->pengirimDisposisi->count();
        }

        return view('dashboard', ['title' => 'App Surat | Dashboard', 'active' => 'dashboard', 'belumDiteruskan' => $belumDiteruskan, 'sudahDiteruskan' => $sudahDiteruskan]);
    } 
}
