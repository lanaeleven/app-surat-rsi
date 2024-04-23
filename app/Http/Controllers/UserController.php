<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function create() {
        $user = User::all();
        return view('user.index', ['title' => 'App Surat | User', 'active' => 'data master', 'user' => $user]);
    }

    public function tambah() {
        return view('user.tambah', ['title' => 'App Surat | Tambah User', 'active' => 'data master']);
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->input());
        // Validate the incoming file. 
        $request->validate([
            'divisi' => 'required',
            'level' => 'required',
            'namaJabatan' => 'required|unique:users,namaJabatan',
            'username' => 'required|unique:users,username',
            'password' => 'required',
        ]);

        // Store file information in the database
        $user = new User();
        $user->divisi = $request->input('divisi');
        $user->level = $request->input('level');
        $user->namaJabatan = $request->input('namaJabatan');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Redirect back to the index page with a success message
        return redirect('/user/index');
    }

    public function edit(User $user) {
        return view('user.edit', ['title' => 'App Surat | Edit User', 'active' => 'data master', 'user' => $user]);
    }

    public function save(Request $request): RedirectResponse
    {
        // Validate the incoming file. 
        
        $request->validate([
            'divisi' => 'required',
            'level' => 'required',
            'namaJabatan' => 'required',
            'username' => 'required'
        ]);

        $user = User::find($request->input('id'));

        if ($user->namaJabatan !== $request->input('namaJabatan')) {
            $request->validate([
                'namaJabatan' => 'unique:users,namaJabatan',
            ]);
        }

        if ($user->username !== $request->input('username')) {
            $request->validate([
                'username' => 'unique:users,username',
            ]);
        }

        // Store file information in the database
        
        $user->divisi = $request->input('divisi');
        $user->level = $request->input('level');
        $user->namaJabatan = $request->input('namaJabatan');
        $user->username = $request->input('username');
        $user->save();

        // Redirect back to the index page with a success message
        return redirect('/user/index');
    }
}
