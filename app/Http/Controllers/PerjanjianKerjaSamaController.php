<?php

namespace App\Http\Controllers;

use App\Models\Direksi;
use App\Models\PerjanjianKerjaSama;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class PerjanjianKerjaSamaController extends Controller
{
    public function create() {

        $pks = PerjanjianKerjaSama::orderBy('tahun', 'desc')->orderBy('index', 'desc');
        $direksi = Direksi::all();
        $judul = "Perjanjian Kerja Sama";

        if (request('index')) {
            $pks->where('index', '=', request('index'));
        }

        if (request('tanggalAwal')) {
            $pks = $pks->whereDate('tanggalSurat', '>=', request('tanggalAwal'));
        }

        if (request('tanggalAkhir')) {
            $pks = $pks->whereDate('tanggalSurat', '<=', request('tanggalAkhir'));
        }        

        if (request('direksi')) {
            $pks->where('idDireksi', request('direksi'));
        }

        if (request('tujuan')) {
            $pks->where('tujuan', 'like', '%' . request('tujuan') . '%');
        }

        if (request('perihal')) {
            $pks->where('perihal', 'like', '%' . request('perihal') . '%');
        }

        if (request('keterangan')) {
            $pks->where('keterangan', 'like', '%' . request('keterangan') . '%');
        }

        if (request('tahun')) {
            $pks->where('tahun', request('tahun'));
        }

        session([
            'search_tahun' => request('tahun')
        ]);

        return view('pks.index', ['title' => $judul, 'active' => 'pks', 'pks' => $pks->with(['direksi'])->paginate(15), 'direksi' => $direksi, 'judul' => $judul]);
    }

    public function tambah() {
        $direksi = Direksi::all();
        $units = Unit::all();

        return view('pks.tambah', ['title' => 'Tambah Perjanjian Kerja Sama', 'active' => 'pks', 'direksi' => $direksi, 'units' => $units]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->id == 1) {
            $redirect = '/pks/index'
                    . '?tahun=' . urlencode(session('search_tahun', ''))
            ;
        } else {
            $redirect = '/';
        } 
        session()->forget('search_tahun');
        
        $request->validate([
            'tanggalSurat' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
            'direksi' => 'required',
            'units' => 'required|array',
            'fileSurat' => 'required|mimes:pdf,jpg,png|max:12288'
        ]);

        
        
        $tahun = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('Y');
        $bulan = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('m');
        $maxIndex = PerjanjianKerjaSama::where('tahun', $tahun)->max('index');
        $newIndex = $maxIndex ? $maxIndex + 1 : 1;

        $file = $request->file('fileSurat');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads/pks/' . $tahun . '/' . $bulan, 'public');


        $pks = new PerjanjianKerjaSama();
        $pks->index = $newIndex;
        $pks->tahun = $tahun;
        $pks->idDireksi = $request->input('direksi');
        $pks->tanggalSurat = $request->input('tanggalSurat');
        $pks->tujuan = $request->input('tujuan');
        $pks->perihal = $request->input('perihal');
        $pks->keterangan = $request->input('keterangan');
        $pks->fileName = $fileName;
        $pks->filePath = $filePath;
        $pks->save();

        $pks->units()->attach($request->input('units'));

        // $userUnit = User::whereHas('units', function ($query) use ($request) {
        //     $query->whereIn('unit_id', $request->input('units'));
        // })->get();

        // foreach ($userUnit as $un) {
        //     $job = new ProcessNotifRegulasiBaru($un->email, $un->namaJabatan, $request->input('perihal'));
        //     dispatch($job);
        // }

        return redirect($redirect)
            ->with('success', 'Berhasil Menambahkan Perjanjian Kerja Sama');
    }
}
