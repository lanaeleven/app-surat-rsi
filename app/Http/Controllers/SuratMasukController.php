<?php

namespace App\Http\Controllers;

use App\Models\Direksi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\DistribusiSurat;
use Illuminate\Http\RedirectResponse;

class SuratMasukController extends Controller
{
    public function create() {
        $suratMasuk = SuratMasuk::orderBy('id', 'desc');
        $direksi = Direksi::all();

        if (request('index')) {
            $suratMasuk->where('id', '=', request('index'));
        }

        if (request('tahun')) {
            $suratMasuk->whereYear('tanggalSurat', request('tahun'));
        }

        if (request('direksi')) {
            $suratMasuk->where('idDireksi', request('direksi'));
        }

        if (request('pengirim')) {
            $suratMasuk->where('pengirim', 'like', '%' . request('pengirim') . '%');
        }

        if (request('nomorSurat')) {
            $suratMasuk->where('nomorSurat', 'like', '%' . request('nomorSurat') . '%');
        }

        if (request('perihal')) {
            $suratMasuk->where('perihal', 'like', '%' . request('perihal') . '%');
        }

        return view('surat-masuk.index', ['title' => 'App Surat | Surat Masuk', 'active' => 'surat masuk', 'suratMasuk' => $suratMasuk->paginate(15), 'direksi' => $direksi]);
    }

    public function tambah() {
        $direksi = Direksi::all();

        return view('surat-masuk.tambah', ['title' => 'App Surat | Tambah Surat Masuk', 'active' => 'surat masuk', 'direksi' => $direksi]);
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->file());
        // Validate the incoming file. Refuses anything bigger than 5120 kilobyes (=5MB)
        $request->validate([
            'tanggalAgenda' => 'required',
            'sifatSurat' => 'required',
            'nomorSurat' => 'required',
            'tanggalSurat' => 'required',
            'lampiran' => 'required',
            'pengirim' => 'required',
            'direksi' => 'required',
            'perihal' => 'required',
            'fileSurat' => 'required|mimes:pdf|max:5120'
        ]);

        // Store the file in storage\app\public folder
        $file = $request->file('fileSurat');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads/surat-masuk', 'public');

        // Store file information in the database
        $suratMasuk = new SuratMasuk();
        $suratMasuk->tanggalAgenda =$request->input('tanggalAgenda');
        $suratMasuk->sifatSurat =$request->input('sifatSurat');
        $suratMasuk->nomorSurat =$request->input('nomorSurat');
        $suratMasuk->tanggalSurat =$request->input('tanggalSurat');
        $suratMasuk->lampiran =$request->input('lampiran');
        $suratMasuk->pengirim =$request->input('pengirim');
        $suratMasuk->idDireksi =$request->input('direksi');
        $suratMasuk->perihal =$request->input('perihal');
        $suratMasuk->status =$request->input('status');
        $suratMasuk->fileName = $fileName;
        $suratMasuk->filePath = $filePath;
        $suratMasuk->save();

        // Redirect back to the index page with a success message
        return redirect('/surat-masuk/index')
            ->with('success', "File uploaded successfully.");
    }

    public function edit(SuratMasuk $suratMasuk) {
        // dd($suratMasuk);
        $direksi = Direksi::all();

        return view('surat-masuk.edit', ['title' => 'App Surat | Edit Surat Masuk', 'active' => 'surat masuk', 'suratMasuk' => $suratMasuk, 'direksi' => $direksi]);
    }

    public function save(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 5120 kilobyes (=5MB)
        $request->validate([
            'tanggalAgenda' => 'required',
            'sifatSurat' => 'required',
            'nomorSurat' => 'required',
            'tanggalSurat' => 'required',
            'lampiran' => 'required',
            'pengirim' => 'required',
            'direksi' => 'required',
            'perihal' => 'required',
            'fileSurat' => 'mimes:pdf|max:5120'
        ]);

        if ($request->file('fileSurat')) {
            // Store the file in storage\app\public folder
            $file = $request->file('fileSurat');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('uploads/surat-masuk', 'public');
        }

        // Store file information in the database
        $suratMasuk = SuratMasuk::find($request->input('id'));
        $suratMasuk->tanggalAgenda =$request->input('tanggalAgenda');
        $suratMasuk->sifatSurat =$request->input('sifatSurat');
        $suratMasuk->nomorSurat =$request->input('nomorSurat');
        $suratMasuk->tanggalSurat =$request->input('tanggalSurat');
        $suratMasuk->lampiran =$request->input('lampiran');
        $suratMasuk->pengirim =$request->input('pengirim');
        $suratMasuk->idDireksi =$request->input('direksi');
        $suratMasuk->perihal =$request->input('perihal');
        $suratMasuk->status =$request->input('status');
        if ($request->file('fileSurat')) {
            $suratMasuk->fileName = $fileName;
            $suratMasuk->filePath = $filePath;
        }
        $suratMasuk->save();

        // Redirect back to the index page with a success message
        return redirect('/surat-masuk/index')
            ->with('success', "File uploaded successfully.");
    }

    public function disposisi(SuratMasuk $suratMasuk) { 

        return view('surat-masuk.disposisi', ['title' => 'App Surat | Disposisi Surat Masuk', 'active' => 'surat masuk', 'suratMasuk' => $suratMasuk]);
    }

    public function teruskan(Request $request): RedirectResponse
    {
        
        // dd($suratMasuk->status);
        // dd($request->input());
        $request->validate([
            'idTujuanDisposisi' => 'required',
            'idSuratMasuk' => 'required',
            'instruksi' => 'required',
            'statusSuratLanjutan' => 'required'
        ]);

        // Store file information in the database
        $distribusiSurat = new DistribusiSurat();
        $distribusiSurat->idTujuanDisposisi = $request->input('idTujuanDisposisi');
        $distribusiSurat->idSuratMasuk = $request->input('idSuratMasuk');
        $distribusiSurat->instruksi = $request->input('instruksi');
        $distribusiSurat->tanggalDiteruskan = now();
        $distribusiSurat->save();

        $suratMasuk = SuratMasuk::find($request->input('idSuratMasuk'));
        $suratMasuk->status = $request->input('statusSuratLanjutan');
        $suratMasuk->save();

        

        


        

        // Redirect back to the index page with a success message
        return redirect('/surat-masuk/index')
            ->with('success', "File uploaded successfully.");
    }
}
