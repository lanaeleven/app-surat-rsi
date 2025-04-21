<?php

namespace App\Http\Controllers;

use App\Models\Undangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class UndanganController extends Controller
{
    public function create()
    {
        $undangan = Undangan::orderBy('waktuKegiatan', 'desc');
        $judul = "Undangan";

        return view('undangan.index', ['title' => $judul, 'active' => 'undangan', 'undangan' => $undangan->paginate(15), 'judul' => $judul]);
    }

    public function tambah()
    {
        $users = User::where('id', '<>', 2)->get();

        return view('undangan.tambah', [
            'title' => 'Tambah Undangan',
            'active' => 'undangan',
            'users' => $users
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->id == 1) {
            $redirect = '/undangan/index';
        } else {
            $redirect = '/';
        }


        $request->validate([
            'isi' => 'required',
            'waktuKegiatan' => 'required',
            'judul' => 'required',
            'tempatKegiatan' => 'required',
            'users' => 'required|array',
            'fileSurat' => 'mimes:pdf,jpg,png|max:12288'
        ]);

        $tahun = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('waktuKegiatan'))->format('Y');
        $bulan = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('waktuKegiatan'))->format('m');

        $maxIndex = Undangan::where('tahun', $tahun)->max('index');
        $newIndex = $maxIndex ? $maxIndex + 1 : 1;

        if ($request->file('fileSurat')) {
            $file = $request->file('fileSurat');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('uploads/undangan/' . $tahun . '/' . $bulan, 'public');
        }

        $undangan = new Undangan();
        $undangan->index = $newIndex;
        $undangan->tahun = $tahun;
        $undangan->waktuKegiatan = $request->input('waktuKegiatan');
        $undangan->judul = $request->input('judul');
        $undangan->tempatKegiatan = $request->input('tempatKegiatan');
        $undangan->isi = $request->input('isi');
        if ($request->file('fileSurat')) {
            $undangan->fileName = $fileName;
            $undangan->filePath = $filePath;
        }
        $undangan->save();

        $undangan->users()->attach($request->input('users'));

        // $recipientUser = User::whereIn('id', $request->input('users'))->get();

        // $namaJenisInformasi = JenisInformasi::find($request->input('jenisInformasi'))->nama;

        // foreach ($recipientUser as $ru) {
        //     $job = new ProcessNotifInformasiBaru($ru->email, $ru->namaJabatan, $namaJenisInformasi, $request->input('judul'));
        //     dispatch($job);
        // }

        return redirect($redirect)
            ->with('success', 'Berhasil Menambahkan Undangan');
    }

    public function edit(Undangan $undangan)
    {
        $users = User::where('id', '<>', 2)->get();

        return view('undangan.edit', [
            'title' => 'Edit Undangan',
            'active' => 'undangan',
            'undangan' => $undangan,
            'users' => $users
        ]);
    }

    public function save(Request $request): RedirectResponse
    {
        if (auth()->user()->id == 1) {
            $redirect = '/undangan/index';
        } else {
            $redirect = '/';
        }

        $request->validate([
            'isi' => 'required',
            'waktuKegiatan' => 'required',
            'judul' => 'required',
            'tempatKegiatan' => 'required',
            'users' => 'required|array',
            'fileSurat' => 'mimes:pdf,jpg,png|max:12288'
        ]);

        $tahunInput = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('waktuKegiatan'))->format('Y');
        $bulan = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('waktuKegiatan'))->format('m');

        if ($request->file('fileSurat')) {
            $file = $request->file('fileSurat');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('uploads/undangan/' . $tahunInput . '/' . $bulan, 'public');
        }


        // Store file information in the database
        $undangan = Undangan::find($request->input('id'));

        $undangan->judul = $request->input('judul');
        $undangan->tempatKegiatan = $request->input('tempatKegiatan');
        $undangan->waktuKegiatan = $request->input('waktuKegiatan');
        $undangan->isi = $request->input('isi');
        if ($request->file('fileSurat')) {
            $undangan->fileName = $fileName;
            $undangan->filePath = $filePath;
        }
        if ($tahunInput != $request->input('tahun')) {
            $maxIndex = Undangan::where('tahun', $tahunInput)->max('index');
            $newIndex = $maxIndex ? $maxIndex + 1 : 1;

            $undangan->tahun = $tahunInput;
            $undangan->index = $newIndex;
        }
        $undangan->save();

        $undangan->users()->sync($request->input('users'));

        return redirect($redirect)
            ->with('success', 'Berhasil Mengedit Undangan');
    }
}
