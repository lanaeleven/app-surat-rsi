<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('/surat-keluar', function () {
    return view('suratkeluar', ['title' => 'App Surat | Surat Keluar', 'active' => 'surat keluar']);
})->middleware('auth');

Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);


