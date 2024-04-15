<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratMasukController;
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

Route::get('/surat-masuk/index', [SuratMasukController::class, 'create'])->middleware('auth');

Route::get('/surat-masuk/tambah', [SuratMasukController::class, 'tambah'])->middleware('auth');

Route::post('/surat-masuk/tambah', [SuratMasukController::class, 'store']);

Route::get('/surat-masuk/edit/{suratMasuk}', [SuratMasukController::class, 'edit']);

Route::post('/surat-masuk/save', [SuratMasukController::class, 'save']);



Route::get('/surat-keluar/index', [SuratKeluarController::class, 'create'])->middleware('auth');

Route::get('/surat-keluar/tambah', [SuratKeluarController::class, 'tambah'])->middleware('auth');

Route::post('/surat-keluar/tambah', [SuratKeluarController::class, 'store']);

Route::get('/surat-keluar/edit/{suratKeluar}', [SuratKeluarController::class, 'edit']);

Route::post('/surat-keluar/save', [SuratKeluarController::class, 'save']);



Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);