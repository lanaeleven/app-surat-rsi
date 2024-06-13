<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailController;
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
// Route::get('/coba', [SuratMasukController::class, 'coba']);

Route::get('/email', [EmailController::class, 'index']);

Route::get('/surat-masuk/index', [SuratMasukController::class, 'create'])->middleware('sekre');
Route::get('/surat-masuk/s/{keterangan}', [SuratMasukController::class, 'create'])->middleware('sekre');
Route::get('/laporan/distribusi-surat/{keterangan}', [SuratMasukController::class, 'laporanDistribusiSurat'])->middleware('sekre');
Route::get('/surat-masuk/tambah', [SuratMasukController::class, 'tambah'])->middleware('sekre');
Route::get('/surat-masuk/edit/{suratMasuk}', [SuratMasukController::class, 'edit'])->middleware('sekre');
Route::get('/laporan/surat-masuk/per-direksi', [SuratMasukController::class, 'laporanPerDireksi'])->middleware('sekre');
Route::get('/laporan/distribusi-surat/rekap/per-tujuan', [SuratMasukController::class, 'laporanPerTujuan'])->middleware('sekre');
Route::get('/surat-masuk/disposisi/{suratMasuk}', [SuratMasukController::class, 'disposisi'])->middleware('auth');
Route::get('/surat-masuk/lacak-distribusi/{suratMasuk}', [SuratMasukController::class, 'lacakDistribusi'])->middleware('auth');
Route::get('/surat-masuk/ns/belum-diteruskan', [SuratMasukController::class, 'nonSekreBelumDiteruskan'])->middleware('notSekre');
Route::get('/surat-masuk/ns/sudah-diteruskan', [SuratMasukController::class, 'nonSekreSudahDiteruskan'])->middleware('notSekre');
Route::post('/surat-masuk/tambah', [SuratMasukController::class, 'store']);
Route::post('/surat-masuk/save', [SuratMasukController::class, 'save']);
Route::post('/surat-masuk/teruskan', [SuratMasukController::class, 'teruskan']);
Route::post('/surat-masuk/arsipkan', [SuratMasukController::class, 'arsipkan']);
Route::post('/surat-masuk/buka-arsip', [SuratMasukController::class, 'bukaArsip']);
Route::post('/unduh-disposisi', [SuratMasukController::class, 'unduhDisposisi']);
Route::post('/unduh-rekap-suratmasuk', [SuratMasukController::class, 'rekapSuratMasuk']);

Route::get('/surat-keluar/index', [SuratKeluarController::class, 'create'])->middleware('sekre');
Route::get('/surat-keluar/tambah', [SuratKeluarController::class, 'tambah'])->middleware('sekre');
Route::get('/surat-keluar/edit/{suratKeluar}', [SuratKeluarController::class, 'edit'])->middleware('sekre');
Route::get('/surat-keluar/{ket}', [SuratKeluarController::class, 'create'])->middleware('sekre');
Route::get('/laporan/surat-keluar/per-jenis-surat', [SuratKeluarController::class, 'laporanPerJenisSurat'])->middleware('sekre');
Route::post('/exportLaporan', [SuratKeluarController::class, 'exportLaporan'])->middleware('sekre');
Route::get('/laporan/surat-keluar/per-direksi', [SuratKeluarController::class, 'laporanPerDireksi'])->middleware('sekre');
Route::post('/surat-keluar/tambah', [SuratKeluarController::class, 'store']);
Route::post('/surat-keluar/save', [SuratKeluarController::class, 'save']);
Route::post('/unduh-rekap-suratkeluar', [SuratKeluarController::class, 'rekapSuratKeluar']);

Route::get('/spo/index', [SpoController::class, 'create'])->middleware('sekre');
Route::get('/spo/tambah', [SpoController::class, 'tambah'])->middleware('sekre');
Route::get('/spo/edit/{spo}', [SpoController::class, 'edit'])->middleware('sekre');
Route::post('/spo/tambah', [SpoController::class, 'store']);
Route::post('/spo/save', [SpoController::class, 'save']);
Route::post('/unduh-rekap-spo', [SpoController::class, 'rekapSpo']);

Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
// Route::post('/login', [LoginController::class, 'authenticate'])->middleware('throttle:3,1');
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/direksi/index', [DireksiController::class, 'create'])->middleware('sekre');
Route::get('/direksi/tambah', [DireksiController::class, 'tambah'])->middleware('sekre');
Route::get('/direksi/edit/{direksi}', [DireksiController::class, 'edit'])->middleware('sekre');
Route::post('/direksi/tambah', [DireksiController::class, 'store']);
Route::post('/direksi/save', [DireksiController::class, 'save']);

Route::get('/jenis-surat/index', [JenisSuratController::class, 'create'])->middleware('sekre');
Route::get('/jenis-surat/tambah', [JenisSuratController::class, 'tambah'])->middleware('sekre');
Route::get('/jenis-surat/edit/{jenisSurat}', [JenisSuratController::class, 'edit'])->middleware('sekre');
Route::post('/jenis-surat/tambah', [JenisSuratController::class, 'store']);
Route::post('/jenis-surat/save', [JenisSuratController::class, 'save']);

Route::get('/user/index', [UserController::class, 'create'])->middleware('sekre');
Route::get('/user/tambah', [UserController::class, 'tambah'])->middleware('sekre');
Route::get('/user/edit/{user}', [UserController::class, 'edit'])->middleware('sekre');
Route::get('/user/akun-ns', [UserController::class, 'akunNs'])->middleware('notSekre');
Route::post('/user/tambah', [UserController::class, 'store']);
Route::post('/user/save', [UserController::class, 'save']);
Route::post('/user/updateInfoProfil', [UserController::class, 'updateInfoProfil']);
Route::post('/user/updatePasswordNs', [UserController::class, 'updatePasswordNs']);
Route::post('/user/updatePassword', [UserController::class, 'updatePassword']);

// Route::get('/dashboard-laporan/akun-ns', [DashboardController::class, 'dashboardLaporan'])->middleware('notSekre');