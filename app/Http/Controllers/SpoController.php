<?php

namespace App\Http\Controllers;

use App\Models\Spo;
use App\Models\Direksi;
use App\Models\JenisSurat;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SpoController extends Controller
{
    public function create(?string $ket = null) {

        $spo = Spo::orderBy('id', 'desc');
        $direksi = Direksi::all();
        $judul = "Standar Prosedur Operasional";

        if (request('index')) {
            $spo->where('id', '=', request('index'));
        }

        if (request('tanggalAwal')) {
            $spo = $spo->whereDate('tanggalSurat', '>=', request('tanggalAwal'));
        }

        if (request('tanggalAkhir')) {
            $spo = $spo->whereDate('tanggalSurat', '<=', request('tanggalAkhir'));
        }       

        if (request('direksi')) {
            $spo->where('idDireksi', request('direksi'));
        }

        if (request('tujuan')) {
            $spo->where('tujuan', 'like', '%' . request('tujuan') . '%');
        }

        if (request('perihal')) {
            $spo->where('perihal', 'like', '%' . request('perihal') . '%');
        }

        if (request('keterangan')) {
            $spo->where('keterangan', 'like', '%' . request('keterangan') . '%');
        }

        return view('spo.index', ['title' => 'App Surat | ' . $judul, 'active' => 'spo', 'spo' => $spo->with('direksi')->paginate(15), 'direksi' => $direksi, 'judul' => $judul]);
    }

    public function tambah() {
        $direksi = Direksi::all();

        return view('spo.tambah', ['title' => 'App Surat | Tambah Surat Prosedur Operasional', 'active' => 'spo', 'direksi' => $direksi]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 5120 kilobyes (=5MB)
        $request->validate([
            'tanggalSurat' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
            'direksi' => 'required',
            'fileSurat' => 'required|mimes:pdf|max:5120'
        ]);

        // Store the file in storage\app\public folder
        $file = $request->file('fileSurat');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads/surat-keluar', 'public');

        // Store file information in the database
        $suratKeluar = new Spo();
        $suratKeluar->idDireksi = $request->input('direksi');
        $suratKeluar->tanggalSurat = $request->input('tanggalSurat');
        $suratKeluar->tujuan = $request->input('tujuan');
        $suratKeluar->perihal = $request->input('perihal');
        $suratKeluar->keterangan = $request->input('keterangan');
        $suratKeluar->fileName = $fileName;
        $suratKeluar->filePath = $filePath;
        $suratKeluar->save();

        // Redirect back to the index page with a success message
        return redirect('/spo/index')
            ->with('success', 'Berhasil Menambahkan Standar Prosedur Operasional');
    }

    public function edit(Spo $spo) {
        // dd($suratKeluar);
        $direksi = Direksi::all();

        return view('spo.edit', ['title' => 'App Surat | Edit Standar Prosedur Operasional', 'active' => 'spo', 'spo' => $spo, 'direksi' => $direksi]);
    }

    public function save(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 2048 kilobyes (=2MB)
        $request->validate([
            'tanggalSurat' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
            'direksi' => 'required',
            'fileSurat' => 'mimes:pdf|max:5120'
        ]);

        if ($request->file('fileSurat')) {
            // Store the file in storage\app\public folder
            $file = $request->file('fileSurat');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('uploads/surat-keluar', 'public');
        }


        // Store file information in the database
        $spo = Spo::find($request->input('id'));

        $spo->idDireksi = $request->input('direksi');
        $spo->tanggalSurat = $request->input('tanggalSurat');
        $spo->tujuan = $request->input('tujuan');
        $spo->perihal = $request->input('perihal');
        $spo->keterangan = $request->input('keterangan');
        if ($request->file('fileSurat')) {
            $spo->fileName = $fileName;
            $spo->filePath = $filePath;
        }
        $spo->save();

        // Redirect back to the index page with a success message
        return redirect('/spo/index')
            ->with('success', 'Berhasil Mengedit Surat Keluar');
    }

    


    

}
