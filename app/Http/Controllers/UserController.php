<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserKepala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function create() {
        // mengambil id kepala dalam bentuk array
        $idKepala = UserKepala::select('idUser')->get();
        $arrIdKepala = [];
        foreach ($idKepala as $ik) {
            array_push($arrIdKepala, $ik->idUser);
        }

        $user = User::where('id', '<>', 2)->get();
        return view('user.index', ['title' => 'User', 'active' => 'data master', 'user' => $user, 'idKepala' => $arrIdKepala]);
    }

    public function tambah() {
        return view('user.tambah', ['title' => 'Tambah User', 'active' => 'data master']);
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming file. 
        $request->validate([
            'namaJabatan' => 'required|unique:users,namaJabatan',
            'nama' => 'required',
            'email' => 'required|email:rfc,dns',
            'username' => 'required|unique:users,username',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        // Store file information in the database
        $user = new User();
        $user->namaJabatan = $request->input('namaJabatan');
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Redirect back to the index page with a success message
        return redirect('/user/index')->with('success', 'Berhasil Menambahkan Tujuan Disposisi');
    }

    public function edit(User $user) {
        // mengambil id kepala dalam bentuk array
        $idKepala = UserKepala::select('idUser')->get();
        $arrIdKepala = [];
        foreach ($idKepala as $ik) {
            array_push($arrIdKepala, $ik->idUser);
        }

        return view('user.edit', ['title' => 'Edit User', 'active' => 'data master', 'user' => $user, 'idKepala' => $arrIdKepala]);
    }

    public function save(Request $request): RedirectResponse
    {
        // Validate the incoming file. 
        // dd($request->input());
        
        $request->validate([
            'namaJabatan' => 'required',
            'nama' => 'required',
            'email' => 'required|email:rfc,dns',
            'username' => 'required',
            'isKepala' => 'required'
        ]);

        

        $user = User::find($request->input('id'));

        if ($user->namaJabatan != $request->input('namaJabatan')) {
            $request->validate([
                'namaJabatan' => 'unique:users,namaJabatan',
            ]);
        }

        if ($user->username != $request->input('username')) {
            $request->validate([
                'username' => 'unique:users,username',
            ]);
        }

        // Store file information in the database
        $user->namaJabatan = $request->input('namaJabatan');
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        // ADD OR DELETE USER_KEPALA
        // mengambil id kepala dalam bentuk array
        $idKepala = UserKepala::select('idUser')->get();
        $arrIdKepala = [];
        foreach ($idKepala as $ik) {
            array_push($arrIdKepala, $ik->idUser);
        }

        if (in_array($request->input('id'), $arrIdKepala)) { // jika user sudah terdaftar menjadi kepala
            if($request->input('isKepala') == 'no') { // dan isian isKepala adalah no, maka hapus di user_kepala
                $userKepala = UserKepala::where('idUser', $request->input('id'))->get()[0];
                $userKepala->delete();
            }
        } else { // jika user belum terdaftar menjadi kepala
            if($request->input('isKepala') == 'yes') { // dan isian isKepala adalah yes, maka tambahkan user ke user_kepala
                $userKepala = new UserKepala();
                $userKepala->idUser = $request->input('id');
                $userKepala->save();
            }
        }

        // Redirect back to the index page with a success message
        return redirect('/user/index')->with('success', 'Berhasil Mengedit Tujuan Disposisi');
    }

    public function akunNs() {
        return view('user.akun-ns', ['title' => 'Akun User', 'active' => 'akun']);
    }

    public function updateInfoProfil(Request $request): RedirectResponse
    {
        // Validate the incoming file. 
        
        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required|email:rfc,dns'
        ]);

        $user = User::find($request->input('id'));

        if ($user->username != $request->input('username')) {
            $request->validate([
                'username' => 'unique:users,username',
            ]);
        }

        // Store file information in the database
        $user->username = $request->input('username');
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->save();

        // Redirect back to the index page with a success message
        return redirect('/user/akun-ns')->with('success', 'Berhasil Mengedit Informasi Profil');
    }

    public function updatePasswordNs(Request $request): RedirectResponse
    {
        // Validate the incoming file. 
        
        $request->validate([
            'passwordSaatIni' => 'required|current_password',
            'passwordBaru' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()]
        ]);

        $user = User::find($request->input('id'));

        // Store file information in the database
        $user->password = Hash::make($request->input('passwordBaru'));
        $user->save();

        // Redirect back to the index page with a success message
        return redirect('/user/akun-ns')->with('success', 'Berhasil Mengubah Password');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        // Validate the incoming file. 
        
        $request->validate([
            'passwordBaru' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()]
        ]);

        $user = User::find($request->input('id'));

        // Store file information in the database
        $user->password = Hash::make($request->input('passwordBaru'));
        $user->save();

        // Redirect back to the index page with a success message
        return redirect('/user/index')->with('success', 'Berhasil Mengubah Password');
    }
}
