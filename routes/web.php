<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DireksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSuratController;
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

Route::get('/', [DashboardController::class, 'create'])->middleware('auth');

Route::get('/surat-masuk/index', [SuratMasukController::class, 'create'])->middleware('auth');
Route::get('/surat-masuk/tambah', [SuratMasukController::class, 'tambah'])->middleware('auth');
Route::post('/surat-masuk/tambah', [SuratMasukController::class, 'store']);
Route::get('/surat-masuk/edit/{suratMasuk}', [SuratMasukController::class, 'edit']);
Route::post('/surat-masuk/save', [SuratMasukController::class, 'save']);
Route::get('/surat-masuk/disposisi/{suratMasuk}', [SuratMasukController::class, 'disposisi']);
Route::post('/surat-masuk/teruskan', [SuratMasukController::class, 'teruskan']);
Route::get('/surat-masuk/d/belum-diteruskan', [SuratMasukController::class, 'direkturBelumDiteruskan']);
Route::get('/surat-masuk/d/sudah-diteruskan', [SuratMasukController::class, 'direkturSudahDiteruskan']);
Route::get('/surat-masuk/disposisi/lihat/{suratMasuk}', [SuratMasukController::class, 'lihatSuratDisposisi']);
Route::get('/surat-masuk/kb/belum-diteruskan', [SuratMasukController::class, 'kepalaBagianBelumDiteruskan']);
Route::get('/surat-masuk/kb/sudah-diteruskan', [SuratMasukController::class, 'kepalaBagianSudahDiteruskan']);
Route::get('/surat-masuk/pj/belum-diteruskan', [SuratMasukController::class, 'penanggungJawabBelumDiteruskan']);
Route::get('/surat-masuk/pj/sudah-diteruskan', [SuratMasukController::class, 'penanggungJawabSudahDiteruskan']);
Route::get('/surat-masuk/lacak-distribusi/{suratMasuk}', [SuratMasukController::class, 'lacakDistribusi']);
Route::get('/surat-masuk/{keterangan}', [SuratMasukController::class, 'create']);

Route::get('/surat-keluar/index', [SuratKeluarController::class, 'create'])->middleware('admin');
Route::get('/surat-keluar/tambah', [SuratKeluarController::class, 'tambah'])->middleware('auth');
Route::post('/surat-keluar/tambah', [SuratKeluarController::class, 'store']);
Route::get('/surat-keluar/edit/{suratKeluar}', [SuratKeluarController::class, 'edit']);
Route::post('/surat-keluar/save', [SuratKeluarController::class, 'save']);
Route::get('/surat-keluar/{ket}', [SuratKeluarController::class, 'create']);

Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/direksi/index', [DireksiController::class, 'create'])->middleware('admin');
Route::get('/direksi/tambah', [DireksiController::class, 'tambah'])->middleware('admin');
Route::post('/direksi/tambah', [DireksiController::class, 'store']);
Route::get('/direksi/edit/{direksi}', [DireksiController::class, 'edit'])->middleware('admin');
Route::post('/direksi/save', [DireksiController::class, 'save']);

Route::get('/jenis-surat/index', [JenisSuratController::class, 'create'])->middleware('admin');
Route::get('/jenis-surat/tambah', [JenisSuratController::class, 'tambah'])->middleware('admin');
Route::post('/jenis-surat/tambah', [JenisSuratController::class, 'store']);
Route::get('/jenis-surat/edit/{jenisSurat}', [JenisSuratController::class, 'edit'])->middleware('admin');
Route::post('/jenis-surat/save', [JenisSuratController::class, 'save']);

Route::get('/user/index', [UserController::class, 'create'])->middleware('admin');
Route::get('/user/tambah', [UserController::class, 'tambah'])->middleware('admin');
Route::post('/user/tambah', [UserController::class, 'store']);
Route::get('/user/edit/{jenisSurat}', [UserController::class, 'edit'])->middleware('admin');
Route::post('/user/save', [UserController::class, 'save']);