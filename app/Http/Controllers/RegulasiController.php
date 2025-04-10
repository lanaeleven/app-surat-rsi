<?php

namespace App\Http\Controllers;

use App\Models\Direksi;
use App\Models\JenisRegulasi;
use App\Models\Regulasi;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RegulasiController extends Controller
{
    public function create() {

        $regulasi = Regulasi::orderBy('tahun', 'desc')->orderBy('index', 'desc');
        $jenisRegulasi = JenisRegulasi::all();  
        $direksi = Direksi::all();
        $judul = "Regulasi";

        if (request('index')) {
            $regulasi->where('index', '=', request('index'));
        }

        if (request('tanggalAwal')) {
            $regulasi = $regulasi->whereDate('tanggalSurat', '>=', request('tanggalAwal'));
        }

        if (request('tanggalAkhir')) {
            $regulasi = $regulasi->whereDate('tanggalSurat', '<=', request('tanggalAkhir'));
        }        

        if (request('jenisRegulasi')) {
            $regulasi->where('idJenisRegulasi', request('jenisRegulasi'));
        }

        if (request('direksi')) {
            $regulasi->where('idDireksi', request('direksi'));
        }

        if (request('tujuan')) {
            $regulasi->where('tujuan', 'like', '%' . request('tujuan') . '%');
        }

        if (request('perihal')) {
            $regulasi->where('perihal', 'like', '%' . request('perihal') . '%');
        }

        if (request('keterangan')) {
            $regulasi->where('keterangan', 'like', '%' . request('keterangan') . '%');
        }

        if (request('tahun')) {
            $regulasi->where('tahun', request('tahun'));
        }

        session([
            'search_tahun' => request('tahun')
        ]);

        return view('regulasi.index', ['title' => $judul, 'active' => 'regulasi', 'regulasi' => $regulasi->with(['jenisRegulasi', 'direksi'])->paginate(15), 'jenisRegulasi' => $jenisRegulasi, 'direksi' => $direksi, 'judul' => $judul]);
    }

    public function tambah() {
        $jenisRegulasi = JenisRegulasi::all();
        $direksi = Direksi::all();

        return view('regulasi.tambah', ['title' => 'Tambah Regulasi', 'active' => 'regulasi', 'jenisRegulasi' => $jenisRegulasi, 'direksi' => $direksi]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->id == 1) {
            $redirect = '/regulasi/index'
                    . '?tahun=' . urlencode(session('search_tahun', ''))
            ;
        } else {
            $redirect = '/';
        } 
        session()->forget('search_tahun');
        
        $request->validate([
            'jenisRegulasi' => 'required',
            'tanggalSurat' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
            'direksi' => 'required',
            'fileSurat' => 'required|mimes:pdf,jpg,png|max:12288'
        ]);
        
        $tahun = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('Y');
        $bulan = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('m');
        $maxIndex = Regulasi::where('tahun', $tahun)->max('index');
        $newIndex = $maxIndex ? $maxIndex + 1 : 1;

        $file = $request->file('fileSurat');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads/regulasi/' . $tahun . '/' . $bulan, 'public');


        $regulasi = new Regulasi();
        $regulasi->index = $newIndex;
        $regulasi->tahun = $tahun;
        $regulasi->idJenisRegulasi = $request->input('jenisRegulasi');
        $regulasi->idDireksi = $request->input('direksi');
        $regulasi->tanggalSurat = $request->input('tanggalSurat');
        $regulasi->tujuan = $request->input('tujuan');
        $regulasi->perihal = $request->input('perihal');
        $regulasi->keterangan = $request->input('keterangan');
        $regulasi->fileName = $fileName;
        $regulasi->filePath = $filePath;
        $regulasi->save();

        return redirect($redirect)
            ->with('success', 'Berhasil Menambahkan Regulasi');
    }

    public function edit(Regulasi $regulasi) {
        $jenisRegulasi = JenisRegulasi::all();
        $direksi = Direksi::all();

        return view('regulasi.edit', ['title' => 'Edit Regulasi', 'active' => 'regulasi', 'regulasi' => $regulasi, 'jenisRegulasi' => $jenisRegulasi, 'direksi' => $direksi]);
    }

    public function save(Request $request): RedirectResponse
    {
        if (auth()->user()->id == 1) {
            $redirect = '/regulasi/index'
                    . '?tahun=' . urlencode(session('search_tahun', ''))
            ;
        } else {
            $redirect = '/';
        } 
        session()->forget('search_tahun');
        
        $request->validate([
            'jenisRegulasi' => 'required',
            'tanggalSurat' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
            'direksi' => 'required',
            'fileSurat' => 'mimes:pdf,jpg,png|max:12288'
        ]);

        $tahunInput = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('Y');
        $bulan = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('m');

        if ($request->file('fileSurat')) {
            $file = $request->file('fileSurat');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('uploads/regulasi/' . $tahunInput . '/' . $bulan, 'public');
        }


        // Store file information in the database
        $regulasi = Regulasi::find($request->input('id'));

        $regulasi->idJenisRegulasi = $request->input('jenisRegulasi');
        $regulasi->idDireksi = $request->input('direksi');
        $regulasi->tanggalSurat = $request->input('tanggalSurat');
        $regulasi->tujuan = $request->input('tujuan');
        $regulasi->perihal = $request->input('perihal');
        $regulasi->keterangan = $request->input('keterangan');
        if ($request->file('fileSurat')) {
            $regulasi->fileName = $fileName;
            $regulasi->filePath = $filePath;
        }
        
        if ($tahunInput != $request->input('tahun')) {
            $maxIndex = Regulasi::where('tahun', $tahunInput)->max('index');
            $newIndex = $maxIndex ? $maxIndex + 1 : 1;

            $regulasi->tahun = $tahunInput;
            $regulasi->index = $newIndex;         
        }
        $regulasi->save();

        return redirect($redirect)
            ->with('success', 'Berhasil Mengedit Regulasi');
    }
}
