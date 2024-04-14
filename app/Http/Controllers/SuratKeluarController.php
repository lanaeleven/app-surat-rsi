<?php

namespace App\Http\Controllers;

use App\Models\Direksi;
use App\Models\JenisSurat;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SuratKeluarController extends Controller
{
    public function create() {
        // dd(request('index'));
        $suratKeluar = SuratKeluar::orderBy('id', 'desc');
        $jenisSurat = JenisSurat::all();
        $direksi = Direksi::all();

        if (request('index')) {
            $suratKeluar->where('id', '=', request('index'));
        }

        if (request('tahun')) {
            $suratKeluar->whereYear('tanggalSurat', request('tahun'));
        }

        if (request('jenisSurat')) {
            $suratKeluar->where('idJenisSurat', request('jenisSurat'));
        }

        if (request('direksi')) {
            $suratKeluar->where('idDireksi', request('direksi'));
        }

        if (request('tujuan')) {
            $suratKeluar->where('tujuan', 'like', '%' . request('tujuan') . '%');
        }

        if (request('perihal')) {
            $suratKeluar->where('perihal', 'like', '%' . request('perihal') . '%');
        }

        if (request('keterangan')) {
            $suratKeluar->where('keterangan', 'like', '%' . request('keterangan') . '%');
        }

        

        return view('surat-keluar.index', ['title' => 'App Surat | Surat Keluar', 'active' => 'surat keluar', 'suratKeluar' => $suratKeluar->paginate(15), 'jenisSurat' => $jenisSurat, 'direksi' => $direksi]);
    }

    public function edit(SuratKeluar $suratKeluar) {
        // dd($suratKeluar);
        $jenisSurat = JenisSurat::all();
        $direksi = Direksi::all();

        return view('surat-keluar.edit', ['title' => 'App Surat | Tambah Surat Keluar', 'active' => 'surat keluar', 'suratKeluar' => $suratKeluar, 'jenisSurat' => $jenisSurat, 'direksi' => $direksi]);
    }

    public function tambah() {
        $jenisSurat = JenisSurat::all();
        $direksi = Direksi::all();

        return view('surat-keluar.tambah', ['title' => 'App Surat | Tambah Surat Keluar', 'active' => 'surat keluar', 'jenisSurat' => $jenisSurat, 'direksi' => $direksi]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 2048 kilobyes (=2MB)
        $request->validate([
            'jenisSurat' => 'required',
            'tanggalSurat' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
            'direksi' => 'required',
            'fileSurat' => 'required|mimes:pdf|max:5120'
        ]);

        // Store the file in storage\app\public folder
        $file = $request->file('fileSurat');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads', 'public');

        // Store file information in the database
        $suratKeluar = new SuratKeluar();
        $suratKeluar->idJenisSurat = $request->input('jenisSurat');
        $suratKeluar->idDireksi = $request->input('direksi');
        $suratKeluar->tanggalSurat = $request->input('tanggalSurat');
        $suratKeluar->tujuan = $request->input('tujuan');
        $suratKeluar->perihal = $request->input('perihal');
        $suratKeluar->keterangan = $request->input('keterangan');
        $suratKeluar->fileName = $fileName;
        $suratKeluar->filePath = $filePath;
        $suratKeluar->save();

        // Redirect back to the index page with a success message
        return redirect('/surat-keluar/index')
            ->with('success', "File `{$suratKeluar->fileName}` uploaded successfully.");
    }

    public function save(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 2048 kilobyes (=2MB)
        $request->validate([
            'jenisSurat' => 'required',
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
            $filePath = $file->store('uploads', 'public');
            
        }


        // Store file information in the database
        $suratKeluar = SuratKeluar::find($request->input('id'));

        $suratKeluar->idJenisSurat = $request->input('jenisSurat');
        $suratKeluar->idDireksi = $request->input('direksi');
        $suratKeluar->tanggalSurat = $request->input('tanggalSurat');
        $suratKeluar->tujuan = $request->input('tujuan');
        $suratKeluar->perihal = $request->input('perihal');
        $suratKeluar->keterangan = $request->input('keterangan');
        if ($request->file('fileSurat')) {
            $suratKeluar->fileName = $fileName;
            $suratKeluar->filePath = $filePath;
        }
        $suratKeluar->save();

        // Redirect back to the index page with a success message
        return redirect('/surat-keluar/index')
            ->with('success', "File `{$suratKeluar->fileName}` uploaded successfully.");
    }
}