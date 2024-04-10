<?php

namespace App\Http\Controllers;

use App\Models\Direksi;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function create() {
        return view('surat-keluar.index', ['title' => 'App Surat | Surat Keluar', 'active' => 'surat keluar']);
    }

    public function tambah() {
        $jenisSurat = JenisSurat::all();
        $direksi = Direksi::all();

        return view('surat-keluar.tambah', ['title' => 'App Surat | Tambah Surat Keluar', 'active' => 'surat keluar', 'jenisSurat' => $jenisSurat, 'direksi' => $direksi]);
    }

    public function store(Request $request) {
        dd($request->input());
    }
}
