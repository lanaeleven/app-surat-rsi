<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function create() {
        $belumDiteruskan = null;
        $sudahDiteruskan = null;

        if (auth()->user()->level === 'direktur') {
            $belumDiteruskan = SuratMasuk::where('status', '=', 'Diteruskan ke Direktur')->count();
            $sudahDiteruskan = SuratMasuk::where('status', '=', 'Diteruskan ke Kepala Bagian')->count();
        }

        return view('dashboard', ['title' => 'App Surat | Dashboard', 'active' => 'dashboard', 'belumDiteruskan' => $belumDiteruskan, 'sudahDiteruskan' => $sudahDiteruskan]);
    } 
}
