<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\SppController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\LaporanController;
// use App\Http\Controllers\SiswaLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


// Route::group(['middleware' => 'prevent-back-history'],function(){
// 	Auth::routes();
//     Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// });
// Route Admin & Petugas


Route::resource('/data-siswa', SiswaController::class);
Route::resource('/data-kelas', KelasController::class);
Route::resource('/data-petugas', PetugasController::class);
Route::resource('/data-spp', SppController::class);

Route::resource('/pembayaran', PembayaranController::class);
Route::post('/pembayaran/cetak/{id_pembayaran}', [PembayaranController::class, 'export']);
Route::get('/histori-pembayaran', [HistoryController::class, 'index']);
Route::get('/laporan', [LaporanController::class, 'index']);
Route::post('/getlaporan', [LaporanController::class, 'getPembayaran']);
Route::post('/laporan/export', [LaporanController::class, 'export']);

// Siswa
// Route::get('/login/siswa', [SiswaLoginController::class, 'siswaLogin']);
// Route::post('/login/siswa/proses', [SiswaLoginController::class, 'login']);
// Route::get('/siswa/histori', [SiswaLoginController::class, 'index'])->name('histori');
// Route::get('/siswa/logout', [SiswaLoginController::class, 'logout']);
