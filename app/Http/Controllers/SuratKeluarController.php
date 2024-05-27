<?php

namespace App\Http\Controllers;

use App\Models\Direksi;
use App\Models\JenisSurat;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\RedirectResponse;

class SuratKeluarController extends Controller
{
    public function create(?string $ket = null) {

        $suratKeluar = SuratKeluar::orderBy('tahun', 'desc')->orderBy('index', 'desc');
        $jenisSurat = JenisSurat::all();  
        $direksi = Direksi::all();
        $judul = "Surat Keluar";

        if ($ket == 'hari-ini') {
            $suratKeluar = $suratKeluar->whereDate('tanggalSurat', '=', now());
            $judul = "Surat Keluar Hari Ini";
        }

        if ($ket == 'bulan-ini') {
            $suratKeluar = $suratKeluar->whereMonth('tanggalSurat', '=', now()->format('m'))->whereYear('tanggalSurat', '=', now()->format('Y'));
            $judul = "Surat Keluar Bulan Ini";
        }

        if (request('index')) {
            $suratKeluar->where('index', '=', request('index'));
        }

        if (request('tanggalAwal')) {
            $suratKeluar = $suratKeluar->whereDate('tanggalSurat', '>=', request('tanggalAwal'));
        }

        if (request('tanggalAkhir')) {
            $suratKeluar = $suratKeluar->whereDate('tanggalSurat', '<=', request('tanggalAkhir'));
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

        return view('surat-keluar.index', ['title' => $judul, 'active' => 'surat keluar', 'suratKeluar' => $suratKeluar->with(['jenisSurat', 'direksi'])->paginate(15), 'jenisSurat' => $jenisSurat, 'direksi' => $direksi, 'ket' => $ket, 'judul' => $judul]);
    }

    public function edit(SuratKeluar $suratKeluar) {
        $jenisSurat = JenisSurat::all();
        $direksi = Direksi::all();

        return view('surat-keluar.edit', ['title' => 'Edit Surat Keluar', 'active' => 'surat keluar', 'suratKeluar' => $suratKeluar, 'jenisSurat' => $jenisSurat, 'direksi' => $direksi]);
    }

    public function tambah() {
        $jenisSurat = JenisSurat::all();
        $direksi = Direksi::all();

        return view('surat-keluar.tambah', ['title' => 'Tambah Surat Keluar', 'active' => 'surat keluar', 'jenisSurat' => $jenisSurat, 'direksi' => $direksi]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 5120 kilobyes (=5MB)
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
        $filePath = $file->store('uploads/surat-keluar', 'public');

        $tahun = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('Y');
        // Get the maximum id for the given year
        $maxIndex = SuratKeluar::where('tahun', $tahun)->max('index');
        // Determine the new id for the given year
        $newIndex = $maxIndex ? $maxIndex + 1 : 1;

        // Store file information in the database
        $suratKeluar = new SuratKeluar();
        $suratKeluar->index = $newIndex;
        $suratKeluar->tahun = $tahun;
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
            ->with('success', 'Berhasil Menambahkan Surat Keluar');
    }

    public function save(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 5 Mb
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
            $filePath = $file->store('uploads/surat-keluar', 'public');
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
        $tahunInput = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('Y');
        if ($tahunInput != $request->input('tahun')) {
            // Get the maximum id for the given year
            $maxIndex = SuratKeluar::where('tahun', $tahunInput)->max('index');
            // Determine the new id for the given year
            $newIndex = $maxIndex ? $maxIndex + 1 : 1;

            $suratKeluar->tahun = $tahunInput;
            $suratKeluar->index = $newIndex;         
        }
        $suratKeluar->save();

        // Redirect back to the index page with a success message
        return redirect('/surat-keluar/index')
            ->with('success', 'Berhasil Mengedit Surat Keluar');
    }

    public function laporanPerJenisSurat() {
        $suratKeluar = SuratKeluar::orderBy('idJenisSurat', 'asc');
        $suratKeluar->select('idJenisSurat', SuratKeluar::raw('COUNT(idJenisSurat) as total_surat'))->groupBy('idJenisSurat');

        if (request('tanggalAwal')) {
            $suratKeluar = $suratKeluar->whereDate('tanggalSurat', '>=', request('tanggalAwal'));
        }

        if (request('tanggalAkhir')) {
            $suratKeluar = $suratKeluar->whereDate('tanggalSurat', '<=', request('tanggalAkhir'));
        }        

        return view('surat-keluar.laporan-per-jenis-surat', ['title' => 'Surat Keluar Per Jenis Surat', 'active' => 'laporan', 'suratKeluar' => $suratKeluar->get()]);
    }

    public function laporanPerDireksi() {
        $suratKeluar = SuratKeluar::orderBy('idDireksi', 'asc');
        $suratKeluar->select('idDireksi', SuratKeluar::raw('COUNT(idDireksi) as total_surat'))->groupBy('idDireksi');

        if (request('tanggalAwal')) {
            $suratKeluar = $suratKeluar->whereDate('tanggalSurat', '>=', request('tanggalAwal'));
        }

        if (request('tanggalAkhir')) {
            $suratKeluar = $suratKeluar->whereDate('tanggalSurat', '<=', request('tanggalAkhir'));
        }        

        return view('surat-keluar.laporan-per-direksi', ['title' => 'Surat Keluar Per Direksi', 'active' => 'laporan', 'suratKeluar' => $suratKeluar->get()]);
    }
}