<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\JamOperasionalController;

use App\Http\Controllers\TestController;

use App\Http\Controllers\PaymentController;




Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('backend.login');

    });




Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda');
Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

// Route khusus Owner (Role: 1)
Route::group(['middleware' => ['auth', 'role:1']], function () {
    // Beranda
    

    // Manajemen User
    Route::resource('backend/user', UserController::class, ['as' => 'backend']);

    // Laporan User
    Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser');
    Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser');
});

// Route khusus Admin (Role: 0)
Route::group(['middleware' => ['auth', 'role:0']], function () {
    // Data Lapangan
    Route::resource('backend/lapangan', LapanganController::class, ['as' => 'backend']);
    Route::resource('backend/biaya', BiayaController::class, ['as' => 'backend']);

    // Laporan Lapangan
    Route::get('backend/laporan/formlapangan', [LapanganController::class, 'formLapangan'])->name('backend.laporan.formlapangan');
    Route::post('backend/laporan/cetaklapangan', [LapanganController::class, 'cetakLapangan'])->name('backend.laporan.cetaklapangan');
});

// Route khusus Admin dan Owner (Role: 0 atau 1)
Route::group(['middleware' => ['auth', 'role:0||1']], function () {
    // Operasional
    Route::resource('backend/oprasional', JamOperasionalController::class, ['as' => 'backend']);
    Route::get('backend/operasional/index', [JamOperasionalController::class, 'index'])->name('backend.operasional.index');
    Route::get('backend/v_operasional/create', [JamOperasionalController::class, 'create'])->name('backend.v_operasional.create');
    Route::post('backend/v_operasional/store', [JamOperasionalController::class, 'store'])->name('backend.v_operasional.store');
    Route::get('backend/v_operasional/edit/{id}', [JamOperasionalController::class, 'edit'])->name('backend.v_operasional.edit');
    Route::put('backend/v_operasional/update/{id}', [JamOperasionalController::class, 'update'])->name('backend.v_operasional.update');
    Route::delete('backend/v_operasional/destroy/{id}', [JamOperasionalController::class, 'destroy'])->name('backend.v_operasional.destroy');

    // Laporan Penyewa
    Route::get('backend/laporan/formpenyewa', [PenyewaController::class, 'formPenyewa'])->name('backend.laporan.formpenyewa');
    Route::post('backend/laporan/cetakpenyewa', [PenyewaController::class, 'cetakPenyewa'])->name('backend.laporan.cetakpenyewa');

     // Data Lapangan
     Route::resource('backend/lapangan', LapanganController::class, ['as' => 'backend']);
     Route::resource('backend/biaya', BiayaController::class, ['as' => 'backend']);
 
     // Laporan Lapangan
     Route::get('backend/laporan/formlapangan', [LapanganController::class, 'formLapangan'])->name('backend.laporan.formlapangan');
     Route::post('backend/laporan/cetaklapangan', [LapanganController::class, 'cetakLapangan'])->name('backend.laporan.cetaklapangan');
});

// Route khusus Penyewa (Role: 2)
Route::group(['middleware' => ['auth', 'role:2']], function () {
    // Jadwal Sewa
    Route::get('backend/penyewa/jadwal', [PenyewaController::class, 'jadwal'])->name('backend.penyewa.jadwal');
});

// Route untuk Semua Role (Role: 0, 1, 2)
Route::group(['middleware' => 'auth'], function () {
    // Data Penyewa
    Route::resource('backend/penyewa', PenyewaController::class, ['as' => 'backend']);
    Route::get('backend/lapangan', [LapanganController::class, 'index'])->name('backend.lapangan.index');
    Route::get('backend/foto_lapangan/store}', [LapanganController::class, 'store'])->name('backend.foto_lapangan.store');
    Route::get('backend/lapangan/show/{id}', [LapanganController::class, 'show'])->name('backend.lapangan.show');
    Route::post('/show-ajax', [PenyewaController::class, 'ajax'])->name('backend.penyewa.ajax');
    Route::post('backend/v_penyewa/charge', [PenyewaController::class, 'charge'])->name('backend.penyewa.charge');
    Route::get('backend/v_penyewa/show', [PenyewaController::class, 'show'])->name('backend.v_penyewa.show');
    Route::get('backend/v_penyewa/struk/{order_id}', [PenyewaController::class, 'cetakStruk'])->name('backend.v_penyewa.struk');
    Route::post('penyewa/updateStatus', [PenyewaController::class, 'updateStatus'])->name('backend.penyewa.updateStatus');

    Route::get('/v_penyewa/show', [PenyewaController::class, 'show'])
    ->name('backend.v_penyewa.show');
});