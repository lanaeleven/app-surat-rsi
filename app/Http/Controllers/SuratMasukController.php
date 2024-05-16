<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Direksi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DistribusiSurat;
use App\Models\TujuanDisposisi;
use App\Mail\EmailNotifDisposisi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class SuratMasukController extends Controller
{
    public function create(?string $keterangan = null) {
        // dd($keterangan);
        $suratMasuk = SuratMasuk::orderBy('id', 'desc');
        $direksi = Direksi::all();
        $judul = "Surat Masuk";

        if ($keterangan === 'hari-ini') {
            $suratMasuk = $suratMasuk->whereDate('tanggalSurat', '=', now());
            $judul = "Surat Masuk Hari Ini";
        }

        if ($keterangan === 'bulan-ini') {
            $suratMasuk = $suratMasuk->whereMonth('tanggalSurat', '=', now()->format('m'))->whereYear('tanggalSurat', '=', now()->format('Y'));
            $judul = "Surat Masuk Bulan Ini";
        }

        if (request('index')) {
            $suratMasuk->where('id', '=', request('index'));
        }

        // if (request('tahun')) {
        //     $suratMasuk->whereYear('tanggalSurat', request('tahun'));
        // }

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

        return view('surat-masuk.index', ['title' => 'App Surat | ' . $judul, 'active' => 'surat masuk', 'suratMasuk' => $suratMasuk->with('direksi')->paginate(15), 'direksi' => $direksi, 'keterangan' => $keterangan, 'judul' => $judul]);
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
            'idPosisiDisposisi' => 'required',
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
        $suratMasuk->idPosisiDisposisi = $request->input('idPosisiDisposisi');
        $suratMasuk->tanggalAgenda = $request->input('tanggalAgenda');
        $suratMasuk->sifatSurat = $request->input('sifatSurat');
        $suratMasuk->nomorSurat = $request->input('nomorSurat');
        $suratMasuk->tanggalSurat = $request->input('tanggalSurat');
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
            ->with('success', "Berhasil Mengedit Surat Masuk");
    }

    public function disposisi(SuratMasuk $suratMasuk) {
        $terusan = User::where('id', '<>', auth()->user()->id)->get();
        // dd($terusan);
        
        // PENGECEKAN UNTUK USER NON-SEKRE PADA SURAT YANG SUDAH DITERUSKAN
        // PENGECEKAN APAKAH SURAT MASUK SUDAH PERNAH DITERUSKAN ATAU BELUM, JIKA BELUM MAKA TIDAK MELEWATI GATE DISPOSISI-SURAT
        if (DistribusiSurat::where('idSuratMasuk', '=', $suratMasuk->id)->exists()) {
            $cekDS = DistribusiSurat::where('idSuratMasuk', '=', $suratMasuk->id)->orderBy('id', 'desc')->get()[0];
            if ((! Gate::allows('disposisi-surat', $cekDS) || $cekDS->status === "Diarsipkan") && auth()->user()->id !== 1) {
                abort(403);
            }
        }

        // PENGECEKAN UNTUK USER NON-SEKRE PADA SURAT YANG BELUM DITERUSKAN
        // PENGECEKAN APAKAH SURAT MASUK YANG BELUM DITERUSKAN DIAKSES OLEH ADMIN ATAU BUKAN, JIKA BUKAN ADMIN MAKA TIDAK DIPERBOLEHKAN
        if ($suratMasuk->status === "Belum Diteruskan" && auth()->user()->id !== 1) {
            abort(403);
        }

        // JIKA SUDAH MELEWATI SEMUA GATE, KEMUDIAN AMBIL DATA DISTRIBUSI SURAT
        $distribusiSurat = DistribusiSurat::where('idSuratMasuk', '=', $suratMasuk->id)->with(['pengirimDisposisi', 'tujuanDisposisi'])->get();

        return view('surat-masuk.disposisi', ['title' => 'App Surat | Disposisi Surat Masuk', 'active' => 'surat masuk', 'suratMasuk' => $suratMasuk, 'terusan' => $terusan, 'distribusiSurat' => $distribusiSurat]);
    }

    public function teruskan(Request $request): RedirectResponse
    {
        // dd(auth()->user()->namaJabatan);
        if (auth()->user()->id === 1) {
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
        // dd($status);

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
        $suratMasuk->save();

        $penerima = $suratMasuk = User::find($distribusiSurat->idTujuanDisposisi);

        Mail::to($penerima->email)->send(new EmailNotifDisposisi(auth()->user()->namaJabatan, $penerima->namaJabatan, $penerima->nama, \Carbon\Carbon::parse($distribusiSurat->tanggalDiteruskan)->format('d/m/Y'), $distribusiSurat->instruksi));

        // Redirect back to the index page with a success message
        return redirect($redirect)
            ->with('success', "Berhasil Meneruskan Pesan");
    }

    // public function lihatSuratDisposisi(SuratMasuk $suratMasuk) {
    //     $distribusiSurat = DistribusiSurat::where('idSuratMasuk', '=', $suratMasuk->id)->where('status', '=', $suratMasuk->status)->get();
    //     return view('surat-masuk.lihat-disposisi', ['title' => 'App Surat | Disposisi Surat Masuk', 'active' => 'surat masuk', 'suratMasuk' => $suratMasuk, 'distribusiSurat' => $distribusiSurat]);
    // }

    public function lacakDistribusi(SuratMasuk $suratMasuk) {
        $distribusiSurat = DistribusiSurat::where('idSuratMasuk', '=', $suratMasuk->id)->with(['pengirimDisposisi', 'tujuanDisposisi'])->get();
        $daftarPengirim = [];
        foreach ($distribusiSurat as $ds) {
            array_push($daftarPengirim, $ds->idPengirimDisposisi);
        }
        if (! in_array(auth()->user()->id, $daftarPengirim) && auth()->user()->id != 1) {
            abort(403);
        }
        return view('surat-masuk.lacak-distribusi', ['title' => 'App Surat | Disposisi Surat Masuk', 'active' => 'surat masuk', 'suratMasuk' => $suratMasuk, 'distribusiSurat' => $distribusiSurat]);
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
        return view('surat-masuk.laporan-per-direksi', ['title' => 'App Surat | Surat Masuk Per Direksi', 'active' => 'laporan', 'suratMasuk' => $suratMasuk->get()]);
    }

    public function nonSekreBelumDiteruskan() {
        $suratMasuk = SuratMasuk::where('idPosisiDisposisi', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('surat-masuk.surat-disposisi-belum-diteruskan', ['title' => 'App Surat | Surat Masuk', 'active' => 'belum diteruskan', 'suratMasuk' => $suratMasuk]);
    }

    public function nonSekreSudahDiteruskan() {
        $distribusiSurat = User::where('id', '=', auth()->user()->id)->get()[0]->mengirimDS;
        $suratMasuk = collect([]);
        foreach ($distribusiSurat as $ds) {
                $suratMasuk->push($ds->suratMasuk);
        }
        $suratMasuk = $suratMasuk->unique('id');
        return view('surat-masuk.surat-disposisi-sudah-diteruskan', ['title' => 'App Surat | Surat Masuk', 'active' => 'sudah diteruskan', 'suratMasuk' => $suratMasuk]);
    }

    public function arsipkan(Request $request) {
        $request->validate([
            'idTujuanDisposisi' => 'required',
            'idSuratMasuk' => 'required',
            'instruksi' => 'required',
            'idPengirimDisposisi' => 'required'
        ]);

        $redirect = "/";
        if (auth()->user()->id === 1) {
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
        // dd($distribusiSurat);
        $suratMasuk = SuratMasuk::find($request->input('idSuratMasuk'));
        $suratMasuk->statusArsip = 0;
        $suratMasuk->save();
        return redirect('/surat-masuk/disposisi/' . $request->input('idSuratMasuk'));
    }

    public function laporanDistribusiSurat(?string $keterangan = null) {
        // dd(SuratMasuk::where('statusArsip', '=', 0)->get());
        // dd(gettype((int)request('statusArsip')));
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
            // dd($distribusiSurat);
            $idSM = collect([]);
            foreach ($distribusiSurat as $ds) {
                $idSM->push($ds->suratMasuk->id);
            }
            // dd($idSM);
            $idSM = $idSM->unique();
            // dd($idSM);
            $suratMasuk = $suratMasuk->whereIn('id', $idSM);
            // dd($suratMasuk->get());
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

        return view('surat-masuk.laporan-distribusi-surat', ['title' => 'App Surat | ' . $judul, 'active' => 'laporan', 'suratMasuk' => $suratMasuk->paginate(15), 'direksi' => $direksi, 'keterangan' => $keterangan, 'judul' => $judul, 'terusan' => $terusan]);
    }

    public function laporanPerTujuan_LAMA() {

        $user = User::where('id', '<>', 1)->get();
        // dd($user[0]->namaJabatan);
        $coba = collect([]);
        foreach ($user as $u) {
            $coba->push($u->menerimaDS);
        }
        dd($coba);
        // dd($coba[0][0]->suratMasuk->get());
        $rekap = $user->map(function ($item) {
            return 
                (object) [
                    'namaJabatan' => $item->namaJabatan,
                    'surat' => $item->menerimaDS->unique('idSuratMasuk')
                ];
        });
        if (request('tanggalAwal')) {
            // dd($rekap[0]->surat[0]->whereDate('tanggalSurat', '>=', now()));
            // $rekap = $rekap->whereDate('tanggalSurat', '>=', request('tanggalAwal'));
            $idSebelum = [];
            // dd($rekap[0]->surat);
            foreach ($rekap as $r) {
                foreach ($r->surat as $s) {
                    array_push($idSebelum, $s->idSuratMasuk);
                }
            }

            $suratMasuk = SuratMasuk::whereIn('id', $idSebelum)->get();
            // dd($suratMasuk);


            // $rekap->transform(function ($item) {
            //     return $item;
            // });
        }
        if (request('tanggalAkhir')) {
            // $rekap = $rekap->whereDate('tanggalSurat', '<=', request('tanggalAkhir'));
            // $rekap->transform(function ($item) {
            //     return [
            //         'namaJabatan' => $item['namaJabatan'],
            //         'surat' => $item['surat']->whereDate('tanggalSurat', '<=', request('tanggalAkhir'))
            //     ];
            // });
            $rekap->transform(function ($item) {
                return $item;
            });
        }        
        return view('surat-masuk.laporan-per-tujuan', ['title' => 'App Surat | Surat Masuk Per Tujuan Disposisi', 'active' => 'laporan', 'rekap' => $rekap]);
    }

    public function laporanPerTujuan() {

        $user = User::where('id', '<>', 1)->get();
        $rekap = $user->map(function ($item) {
            return 
                (object) [
                    'namaJabatan' => $item->namaJabatan,
                    'surat' => $item->menerimaDS->unique('idSuratMasuk')
                ];
        });

        return view('surat-masuk.laporan-per-tujuan', ['title' => 'App Surat | Surat Masuk Per Direksi', 'active' => 'laporan', 'rekap' => $rekap]);
    }
}