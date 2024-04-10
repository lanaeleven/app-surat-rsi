<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratKeluarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard', ['title' => 'App Surat | Dashboard', 'active' => 'dashboard']);
})->middleware('auth');

Route::get('/surat-masuk', function () {
    return view('suratmasuk', ['title' => 'App Surat | Surat Masuk', 'active' => 'surat masuk']);
})->middleware('auth');

Route::get('/surat-keluar/index', [SuratKeluarController::class, 'create'])->middleware('auth');

Route::get('/surat-keluar/tambah', [SuratKeluarController::class, 'tambah'])->middleware('auth');

Route::post('/surat-keluar/tambah', [SuratKeluarController::class, 'store']);

Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);


