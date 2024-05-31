<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function create() {
        $user = User::all();
        return view('user.index', ['title' => 'User', 'active' => 'data master', 'user' => $user]);
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
        return view('user.edit', ['title' => 'Edit User', 'active' => 'data master', 'user' => $user]);
    }

    public function save(Request $request): RedirectResponse
    {
        // Validate the incoming file. 
        
        $request->validate([
            'namaJabatan' => 'required',
            'nama' => 'required',
            'email' => 'required|email:rfc,dns',
            'username' => 'required'
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
