<?php

namespace App\Http\Controllers;

use App\Models\Spo;
use App\Models\Direksi;
use App\Models\JenisSurat;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SpoController extends Controller
{
    public function create() {

        $spo = Spo::orderBy('tahun', 'desc')->orderBy('index', 'desc');
        $direksi = Direksi::all();
        $judul = "Standar Prosedur Operasional";

        if (request('index')) {
            $spo->where('index', '=', request('index'));
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

        return view('spo.index', ['title' =>  $judul, 'active' => 'spo', 'spo' => $spo->with('direksi')->paginate(15), 'direksi' => $direksi, 'judul' => $judul]);
    }

    public function tambah() {
        $direksi = Direksi::all();

        return view('spo.tambah', ['title' => 'Tambah Surat Prosedur Operasional', 'active' => 'spo', 'direksi' => $direksi]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 5120 kilobyes (=5MB)
        $request->validate([
            'tanggalSurat' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
            'direksi' => 'required',
            'fileSurat' => 'required|mimes:pdf,jpg,png|max:5120'
        ]);
        
        $tahun = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('Y');
        $bulan = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('m');
        // Get the maximum id for the given year
        $maxIndex = Spo::where('tahun', $tahun)->max('index');
        // Determine the new id for the given year
        $newIndex = $maxIndex ? $maxIndex + 1 : 1;

        // Store the file in storage\app\public folder
        $file = $request->file('fileSurat');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads/spo/' . $tahun . '/' . $bulan, 'public');


        // Store file information in the database
        $spo = new Spo();
        $spo->index = $newIndex;
        $spo->tahun = $tahun;
        $spo->idDireksi = $request->input('direksi');
        $spo->tanggalSurat = $request->input('tanggalSurat');
        $spo->tujuan = $request->input('tujuan');
        $spo->perihal = $request->input('perihal');
        $spo->keterangan = $request->input('keterangan');
        $spo->fileName = $fileName;
        $spo->filePath = $filePath;
        $spo->save();

        // Redirect back to the index page with a success message
        return redirect('/spo/index')
            ->with('success', 'Berhasil Menambahkan Standar Prosedur Operasional');
    }

    public function edit(Spo $spo) {
        $direksi = Direksi::all();

        return view('spo.edit', ['title' => 'Edit Standar Prosedur Operasional', 'active' => 'spo', 'spo' => $spo, 'direksi' => $direksi]);
    }

    public function save(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 2048 kilobyes (=2MB)
        $request->validate([
            'tanggalSurat' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
            'direksi' => 'required',
            'fileSurat' => 'mimes:pdf,jpg,png|max:5120'
        ]);

        $tahunInput = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('Y');
        $bulan = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('m');

        if ($request->file('fileSurat')) {
            // Store the file in storage\app\public folder
            $file = $request->file('fileSurat');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('uploads/spo/' . $tahunInput . '/' . $bulan, 'public');
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
        
        if ($tahunInput != $request->input('tahun')) {
            // Get the maximum id for the given year
            $maxIndex = Spo::where('tahun', $tahunInput)->max('index');
            // Determine the new id for the given year
            $newIndex = $maxIndex ? $maxIndex + 1 : 1;

            $spo->tahun = $tahunInput;
            $spo->index = $newIndex;         
        }
        $spo->save();

        // Redirect back to the index page with a success message
        return redirect('/spo/index')
            ->with('success', 'Berhasil Mengedit Surat Keluar');
    }

    


    

}
