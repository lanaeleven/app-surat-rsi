<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\User;
use App\Models\Direksi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DistribusiSurat;
use App\Models\TujuanDisposisi;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\EmailNotifDisposisi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class SuratMasukController extends Controller
{
    public function create(?string $keterangan = null) {
        $suratMasuk = SuratMasuk::orderBy('tahun', 'desc')->orderBy('index', 'desc');
        $direksi = Direksi::all();
        $judul = "Surat Masuk";

        if ($keterangan == 'hari-ini') {
            $suratMasuk = $suratMasuk->whereDate('tanggalSurat', '=', now());
            $judul = "Surat Masuk Hari Ini";
        }

        if ($keterangan == 'bulan-ini') {
            $suratMasuk = $suratMasuk->whereMonth('tanggalSurat', '=', now()->format('m'))->whereYear('tanggalSurat', '=', now()->format('Y'));
            $judul = "Surat Masuk Bulan Ini";
        }

        if (request('index')) {
            $suratMasuk->where('index', '=', request('index'));
        }

        if (request('tanggalAwal')) {
            $suratMasuk = $suratMasuk->whereDate('tanggalSurat', '>=', request('tanggalAwal'));
        }

        if (request('tanggalAkhir')) {
            $suratMasuk = $suratMasuk->whereDate('tanggalSurat', '<=', request('tanggalAkhir'));
        }        

        if (request('direksi')) {
            $suratMasuk->where('idDireksi', request('direksi'));
        }

        if (request('status')) {
            $suratMasuk->where('status', request('status'));
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

        return view('surat-masuk.index', ['title' => $judul, 'active' => 'surat masuk', 'suratMasuk' => $suratMasuk->with('direksi')->paginate(15), 'direksi' => $direksi, 'keterangan' => $keterangan, 'judul' => $judul]);
    }

    public function tambah() {
        $direksi = Direksi::all();
        
        return view('surat-masuk.tambah', ['title' => 'Tambah Surat Masuk', 'active' => 'surat masuk', 'direksi' => $direksi]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 5120 kilobyes (=5MB)
        $request->validate([
            'idPosisiDisposisi' => 'required',
            'tanggalAgenda' => 'required',
            'sifatSurat' => 'required',
            'nomorSurat' => 'required',
            'tanggalSurat' => 'required',
            'lampiran' => 'required',
            'pengirim' => 'required',
            'direksi' => 'required',
            'perihal' => 'required',
            'fileSurat' => 'required|mimes:pdf,jpg,png|max:5120'
        ]);
        
        $tahun = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('Y');
        $bulan = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('m');
        // Get the maximum id for the given year
        $maxIndex = SuratMasuk::where('tahun', $tahun)->max('index');
        // Determine the new id for the given year
        $newIndex = $maxIndex ? $maxIndex + 1 : 1;

        // Store the file in storage\app\public folder
        $file = $request->file('fileSurat');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads/surat-masuk/' . $tahun . '/' . $bulan, 'public');


        // Store file information in the database
        $suratMasuk = new SuratMasuk();
        $suratMasuk->index = $newIndex;
        $suratMasuk->idPosisiDisposisi = $request->input('idPosisiDisposisi');
        $suratMasuk->tanggalAgenda = $request->input('tanggalAgenda');
        $suratMasuk->sifatSurat = $request->input('sifatSurat');
        $suratMasuk->nomorSurat = $request->input('nomorSurat');
        $suratMasuk->tanggalSurat = $request->input('tanggalSurat');
        $suratMasuk->tahun = $tahun;
        $suratMasuk->lampiran = $request->input('lampiran');
        $suratMasuk->pengirim = $request->input('pengirim');
        $suratMasuk->idDireksi = $request->input('direksi');
        $suratMasuk->perihal = $request->input('perihal');
        $suratMasuk->status = $request->input('status');
        $suratMasuk->statusArsip = 0;
        $suratMasuk->fileName = $fileName;
        $suratMasuk->filePath = $filePath;
        $suratMasuk->save();

        // Redirect back to the index page with a success message
        return redirect('/surat-masuk/index')
            ->with('success', "Berhasil Menambahkan Surat Masuk");
    }

    public function edit(SuratMasuk $suratMasuk) {
        $direksi = Direksi::all();

        return view('surat-masuk.edit', ['title' => 'Edit Surat Masuk', 'active' => 'surat masuk', 'suratMasuk' => $suratMasuk, 'direksi' => $direksi]);
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
            'fileSurat' => 'mimes:pdf,jpg,png|max:5120'
        ]);

        $tahunInput = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('Y');
        $bulan = Carbon::createFromFormat('Y-m-d', $request->input('tanggalSurat'))->format('m');

        if ($request->file('fileSurat')) {
            // Store the file in storage\app\public folder
            $file = $request->file('fileSurat');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('uploads/surat-masuk/' . $tahunInput . '/' . $bulan, 'public');
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
        
        if ($tahunInput != $request->input('tahun')) {
            // Get the maximum id for the given year
            $maxIndex = SuratMasuk::where('tahun', $tahunInput)->max('index');
            // Determine the new id for the given year
            $newIndex = $maxIndex ? $maxIndex + 1 : 1;

            $suratMasuk->tahun = $tahunInput;
            $suratMasuk->index = $newIndex;         
        }
        $suratMasuk->save();

        // Redirect back to the index page with a success message
        return redirect('/surat-masuk/index')
            ->with('success', "Berhasil Mengedit Surat Masuk");
    }

    public function disposisi(SuratMasuk $suratMasuk) {
        $terusan = User::where('id', '<>', auth()->user()->id)->get();
        
        // PENGECEKAN UNTUK USER NON-SEKRE PADA SURAT YANG SUDAH DITERUSKAN
        // PENGECEKAN APAKAH SURAT MASUK SUDAH PERNAH DITERUSKAN ATAU BELUM, JIKA BELUM MAKA TIDAK MELEWATI GATE DISPOSISI-SURAT
        if (DistribusiSurat::where('idSuratMasuk', '=', $suratMasuk->id)->exists()) {
            $cekDS = DistribusiSurat::where('idSuratMasuk', '=', $suratMasuk->id)->orderBy('id', 'desc')->get()[0];
            if ((! Gate::allows('disposisi-surat', $cekDS) || $cekDS->status == "Diarsipkan") && auth()->user()->id != 1) {
                abort(403);
            }
        }

        // PENGECEKAN UNTUK USER NON-SEKRE PADA SURAT YANG BELUM DITERUSKAN
        // PENGECEKAN APAKAH SURAT MASUK YANG BELUM DITERUSKAN DIAKSES OLEH ADMIN ATAU BUKAN, JIKA BUKAN ADMIN MAKA TIDAK DIPERBOLEHKAN
        if ($suratMasuk->status == "Belum Diteruskan" && auth()->user()->id != 1) {
            abort(403);
        }

        // JIKA SUDAH MELEWATI SEMUA GATE, KEMUDIAN AMBIL DATA DISTRIBUSI SURAT
        $distribusiSurat = DistribusiSurat::where('idSuratMasuk', '=', $suratMasuk->id)->with(['pengirimDisposisi', 'tujuanDisposisi'])->get();

        return view('surat-masuk.disposisi', ['title' => 'Disposisi Surat Masuk', 'active' => 'surat masuk', 'suratMasuk' => $suratMasuk, 'terusan' => $terusan, 'distribusiSurat' => $distribusiSurat]);
    }

    public function teruskan(Request $request): RedirectResponse
    {
        if (auth()->user()->id == 1) {
            $redirect = '/surat-masuk/index';
        } else {
            $redirect = '/';
        }        
        
        $request->validate([
            'idTujuanDisposisi' => 'required',
            'idSuratMasuk' => 'required',
            'instruksi' => 'required',
            'idPengirimDisposisi' => 'required'
        ]);

        $tujuanDisposisi = User::find($request->input('idTujuanDisposisi'));
        $status = "Diteruskan ke " . $tujuanDisposisi->namaJabatan;

        // Store file information in the database
        $distribusiSurat = new DistribusiSurat();
        $distribusiSurat->idTujuanDisposisi = $request->input('idTujuanDisposisi');
        $distribusiSurat->idPengirimDisposisi = $request->input('idPengirimDisposisi');
        $distribusiSurat->idSuratMasuk = $request->input('idSuratMasuk');
        $distribusiSurat->instruksi = $request->input('instruksi');
        $distribusiSurat->tanggalDiteruskan = now();
        $distribusiSurat->status = $status;
        $distribusiSurat->save();

        $suratMasuk = SuratMasuk::find($request->input('idSuratMasuk'));
        $suratMasuk->idPosisiDisposisi = $request->input('idTujuanDisposisi');
        $suratMasuk->status = $status;
        $sifatSurat = $suratMasuk->sifatSurat;
        $nomorSurat = $suratMasuk->nomorSurat;
        $suratMasuk->save();

        $penerima = $suratMasuk = User::find($distribusiSurat->idTujuanDisposisi);

        Mail::to($penerima->email)->send(new EmailNotifDisposisi($sifatSurat, $nomorSurat, auth()->user()->namaJabatan, $penerima->namaJabatan, $penerima->nama, \Carbon\Carbon::parse($distribusiSurat->tanggalDiteruskan)->format('d/m/Y'), $distribusiSurat->instruksi));

        // Redirect back to the index page with a success message
        return redirect($redirect)
            ->with('success', "Berhasil Meneruskan Pesan");
    }

    public function lacakDistribusi(SuratMasuk $suratMasuk) {
        $distribusiSurat = DistribusiSurat::where('idSuratMasuk', '=', $suratMasuk->id)->with(['pengirimDisposisi', 'tujuanDisposisi'])->get();
        $daftarPengirim = [];
        foreach ($distribusiSurat as $ds) {
            array_push($daftarPengirim, $ds->idPengirimDisposisi);
        }
        if (! in_array(auth()->user()->id, $daftarPengirim) && auth()->user()->id != 1) {
            abort(403);
        }
        // dd($distribusiSurat);
        return view('surat-masuk.lacak-distribusi', ['title' => 'Disposisi Surat Masuk', 'active' => 'surat masuk', 'suratMasuk' => $suratMasuk, 'distribusiSurat' => $distribusiSurat]);
    }

    public function unduhDisposisi(Request $request) {
        // $distribusiSurat = DistribusiSurat::where('idSuratMasuk', '=', $request->input('idSuratMasuk'))->with(['pengirimDisposisi', 'tujuanDisposisi'])->get();
        $distribusiSurat = DistribusiSurat::where('idSuratMasuk', '=', $request->input('idSuratMasuk'))->get();
        $suratMasuk = SuratMasuk::where('id', '=', $request->input('idSuratMasuk'))->get();
        $daftarPengirim = [];
        foreach ($distribusiSurat as $ds) {
            array_push($daftarPengirim, $ds->idPengirimDisposisi);
        }
        $user = User::all()->keyBy('id');

        $distribusiSurat = $distribusiSurat->map(function($item) use ($user) {
            $namaPengirim = isset($user[$item['idPengirimDisposisi']]) ? $user[$item['idPengirimDisposisi']]->namaJabatan : 'Unknown';
            $namaPenerima = isset($user[$item['idTujuanDisposisi']]) ? $user[$item['idTujuanDisposisi']]->namaJabatan : 'Unknown';
        
            // Mengembalikan item dengan tambahan field namaPengirim dan namaPenerima
            return array_merge($item->toArray(), [
                'namaPengirim' => $namaPengirim,
                'namaPenerima' => $namaPenerima
            ]);
        });
        // dd($distribusiSurat);

        $pdf = Pdf::loadView('surat-masuk.lembar-disposisi', ['suratMasuk' => $suratMasuk[0], 'distribusiSurat' => $distribusiSurat]);
        return $pdf->stream();
    }

    public function rekapSuratMasuk(Request $request) {
        $tanggal = $request->input('bulanRekap');
        $tahun = Carbon::createFromFormat('Y-m', $tanggal)->format('Y');
        $bulan = Carbon::createFromFormat('Y-m', $tanggal)->format('m');
        $suratMasuk = SuratMasuk::whereMonth('tanggalSurat', '=', $bulan)->whereYear('tanggalSurat', '=', $tahun)->get();

        // dd($suratMasuk);

        $zip = new ZipArchive();
        $zipFilePath = storage_path('app/' . 'rekap_suratmasuk_' . $tahun . '_' . $bulan . '.zip') ;

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($suratMasuk as $sm) {
                $fileToAdd = storage_path('app/public/' . $sm->filePath);
                $zip->addFile($fileToAdd, 'suratmasuk_' . $sm->tahun . '_' . $sm->index . '.' . pathinfo($fileToAdd, PATHINFO_EXTENSION));

                // GENERATE DISPOSISI
                $distribusiSurat = DistribusiSurat::where('idSuratMasuk', '=', $sm->id)->get();
                $suratMasuk = SuratMasuk::where('id', '=', $sm->id)->get();
                $daftarPengirim = [];
                foreach ($distribusiSurat as $ds) {
                    array_push($daftarPengirim, $ds->idPengirimDisposisi);
                }
                $user = User::all()->keyBy('id');

                $distribusiSurat = $distribusiSurat->map(function($item) use ($user) {
                    $namaPengirim = isset($user[$item['idPengirimDisposisi']]) ? $user[$item['idPengirimDisposisi']]->namaJabatan : 'Unknown';
                    $namaPenerima = isset($user[$item['idTujuanDisposisi']]) ? $user[$item['idTujuanDisposisi']]->namaJabatan : 'Unknown';
                
                    // Mengembalikan item dengan tambahan field namaPengirim dan namaPenerima
                    return array_merge($item->toArray(), [
                        'namaPengirim' => $namaPengirim,
                        'namaPenerima' => $namaPenerima
                    ]);
                });
                // dd($distribusiSurat);

                $pdf = Pdf::loadView('surat-masuk.lembar-disposisi', ['suratMasuk' => $suratMasuk[0], 'distribusiSurat' => $distribusiSurat]);
                $lembarDisposisi = $pdf->output();

                $zip->addFromString('suratmasuk_' . $sm->tahun . '_' . $sm->index . '_disposisi' . '.' . '.pdf', $lembarDisposisi);
            }
            $zip->close();
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            dd('gagal membuka file zip');
        }
        
    }

    public function laporanPerDireksi() {
        $suratMasuk = SuratMasuk::orderBy('idDireksi', 'asc');
        $suratMasuk->select('idDireksi', SuratMasuk::raw('COUNT(idDireksi) as total_surat'))->groupBy('idDireksi');
        if (request('tanggalAwal')) {
            $suratMasuk = $suratMasuk->whereDate('tanggalSurat', '>=', request('tanggalAwal'));
        }
        if (request('tanggalAkhir')) {
            $suratMasuk = $suratMasuk->whereDate('tanggalSurat', '<=', request('tanggalAkhir'));
        }        
        return view('surat-masuk.laporan-per-direksi', ['title' => 'Surat Masuk Per Direksi', 'active' => 'laporan', 'suratMasuk' => $suratMasuk->get()]);
    }

    public function nonSekreBelumDiteruskan() {
        $suratMasuk = SuratMasuk::where('idPosisiDisposisi', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('surat-masuk.surat-disposisi-belum-diteruskan', ['title' => 'Surat Masuk Belum Diteruskan', 'active' => 'belum diteruskan', 'suratMasuk' => $suratMasuk]);
    }

    public function nonSekreSudahDiteruskan() {
        $distribusiSurat = User::where('id', '=', auth()->user()->id)->get()[0]->mengirimDS;
        $suratMasuk = collect([]);
        foreach ($distribusiSurat as $ds) {
                $suratMasuk->push($ds->suratMasuk);
        }
        $suratMasuk = $suratMasuk->unique('id');
        return view('surat-masuk.surat-disposisi-sudah-diteruskan', ['title' => 'Surat Masuk Sudah Diteruskan', 'active' => 'sudah diteruskan', 'suratMasuk' => $suratMasuk]);
    }

    public function arsipkan(Request $request) {
        $request->validate([
            'idTujuanDisposisi' => 'required',
            'idSuratMasuk' => 'required',
            'instruksi' => 'required',
            'idPengirimDisposisi' => 'required'
        ]);

        $redirect = "/";
        if (auth()->user()->id == 1) {
            $redirect = "/surat-masuk/index";
        }

        $suratMasuk = SuratMasuk::find($request->input('idSuratMasuk'));
        $suratMasuk->statusArsip = 1;
        $suratMasuk->idPosisiDisposisi = 1;
        $suratMasuk->status = "Diarsipkan";
        $suratMasuk->save();

        $distribusiSurat = new DistribusiSurat();
        $distribusiSurat->idTujuanDisposisi = $request->input('idTujuanDisposisi');
        $distribusiSurat->idPengirimDisposisi = $request->input('idPengirimDisposisi');
        $distribusiSurat->idSuratMasuk = $request->input('idSuratMasuk');
        $distribusiSurat->instruksi = $request->input('instruksi');
        $distribusiSurat->tanggalDiteruskan = now();
        $distribusiSurat->status = "Diarsipkan";
        $distribusiSurat->save();
        return redirect($redirect)->with('success', 'Berhasil Mengarsipkan Surat');
    }

    public function bukaArsip(Request $request) {
        $distribusiSurat = DistribusiSurat::where("idSuratMasuk", $request->input('idSuratMasuk'))->get();
        $suratMasuk = SuratMasuk::find($request->input('idSuratMasuk'));
        $suratMasuk->statusArsip = 0;
        $suratMasuk->save();
        return redirect('/surat-masuk/disposisi/' . $request->input('idSuratMasuk'));
    }

    public function laporanDistribusiSurat(?string $keterangan = null) {
        $suratMasuk = SuratMasuk::orderBy('id', 'desc');
        $direksi = Direksi::all();
        $judul = "Laporan Surat Masuk";
        $terusan = User::where('id', '<>', 1)->get();

        if ($keterangan == "posisi-terakhir") {
            $suratMasuk->where('statusArsip', '=', 0);
            $judul = "Laporan Distribusi Surat Berdasarkan Tujuan Disposisi Terakhir";
        }

        if ($keterangan == "sudah-selesai") {
            $judul = "Laporan Distribusi Surat yang Sudah Selesai";
        }

        if ($keterangan == "pernah-distribusi") {
            $judul = "Laporan Distribusi Surat yang Pernah Didistribusikan";
        }

        if (request('disposisiTerakhir')) {
            if (request('disposisiTerakhir') == "Belum Diteruskan") {
                $suratMasuk->where('status', '=', 'Belum Diteruskan');
            } else {
                $suratMasuk->where('idPosisiDisposisi', '=', request('disposisiTerakhir'));
            }
        }

        if (request('statusArsip')) {
            if (request('statusArsip') == "Belum") {
                $suratMasuk = $suratMasuk->where('statusArsip', '=', 0);
            }elseif (request('statusArsip') == "Arsip") {
                $suratMasuk = $suratMasuk->where('statusArsip', '=', 1);
            }
        }

        if (request('tujuanDisposisi')) {
            $distribusiSurat = User::where('id', '=', request('tujuanDisposisi'))->get()[0]->menerimaDS;
            $idSM = collect([]);
            foreach ($distribusiSurat as $ds) {
                $idSM->push($ds->suratMasuk->id);
            }
            $idSM = $idSM->unique();
            $suratMasuk = $suratMasuk->whereIn('id', $idSM);
        }

        if (request('tanggalAwal')) {
            $suratMasuk = $suratMasuk->whereDate('tanggalSurat', '>=', request('tanggalAwal'));
        }

        if (request('tanggalAkhir')) {
            $suratMasuk = $suratMasuk->whereDate('tanggalSurat', '<=', request('tanggalAkhir'));
        }     

        if (request('index')) {
            $suratMasuk->where('id', '=', request('index'));
        }

        if (request('tahun')) {
            $suratMasuk->whereYear('tanggalSurat', request('tahun'));
        }

        if (request('direksi')) {
            $suratMasuk->where('idDireksi', request('direksi'));
        }

        if (request('status')) {
            $suratMasuk->where('status', request('status'));
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

        return view('surat-masuk.laporan-distribusi-surat', ['title' => $judul, 'active' => 'laporan', 'suratMasuk' => $suratMasuk->paginate(15), 'direksi' => $direksi, 'keterangan' => $keterangan, 'judul' => $judul, 'terusan' => $terusan]);
    }

    public function laporanPerTujuan() {

        // Mendapatkan jumlah surat masuk yang diteruskan ke masing-masing user
        $rekap = DB::table('surat_masuk')
        ->join('distribusi_surat', 'surat_masuk.id', '=', 'distribusi_surat.idSuratMasuk')
        ->join('users', 'distribusi_surat.idTujuanDisposisi', '=', 'users.id')
        ->select('users.namaJabatan', DB::raw('COUNT(DISTINCT surat_masuk.id) as jumlah_surat_masuk'))
        ->where('users.id', '<>', 1)
        ->groupBy('users.namaJabatan')
        ->orderBy('users.id', 'asc');

        if (request('tanggalAwal')) {
            $rekap = $rekap->whereDate('surat_masuk.tanggalSurat', '>=', request('tanggalAwal'));
        }

        if (request('tanggalAkhir')) {
            $rekap = $rekap->whereDate('surat_masuk.tanggalSurat', '<=', request('tanggalAkhir'));
        }

        return view('surat-masuk.laporan-per-tujuan', ['title' => 'Surat Masuk Per Tujuan Disposisi', 'active' => 'laporan', 'rekap' => $rekap->get()]);
    }
}