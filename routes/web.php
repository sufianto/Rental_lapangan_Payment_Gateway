<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HelloWorldController;
// use App\Http\Controllers\HtmlController;
// use App\Http\Controllers\LatihanController;

// use App\Http\Controllers\AnggotaController;

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



// Route::get('/helloworld', [HelloWorldController::class, 'index']);
// Route::get('ambilfile',[HelloWorldController::class, 'ambilFile']);
// Route::get('getlorem',[HtmlController::class, 'getlorem']);
// Route::get('getTabel',[LatihanController::class, 'getTabel']);
// Route::get('getForm',[LatihanController::class, 'getForm']);

// Route::resource('anggota', AnggotaController::class);


Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda');
Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');

Route::resource('backend/lapangan', LapanganController::class, ['as' => 'backend'])->middleware('auth');
Route::resource('backend/biaya', BiayaController::class, ['as' => 'backend'])->middleware('auth');
Route::resource('backend/penyewa', PenyewaController::class, ['as' => 'backend'])->middleware('auth');

// // Route untuk reset stok
Route::post('backend/biaya/reset-stok', [BiayaController::class, 'resetStok'])->name('backend.biaya.resetStok')->middleware('auth');

// Route::post('backend/penyewa/store', [PenyewaController::class, 'store'])->name('backend.penyewa.store')->middleware('auth');


// Route for adding photos for a field
Route::post('foto-lapangan/store', [LapanganController::class, 'storeFoto'])->name('backend.foto_lapangan.store')->middleware('auth');

// Route for deleting photos of a field
Route::delete('foto-lapangan/{id}', [LapanganController::class, 'destroyFoto'])->name('backend.foto_lapangan.destroy')->middleware('auth');

// Route for generating user report
Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser')->middleware('auth');
Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser')->middleware('auth');

Route::get('backend/laporan/formpenyewa', [PenyewaController::class, 'formPenyewa'])->name('backend.laporan.formpenyewa')->middleware('auth');
Route::post('backend/laporan/cetakpenyewa', [PenyewaController::class, 'cetakPenyewa'])->name('backend.laporan.cetakpenyewa') ->middleware('auth');

// Route for generating field report (Lapangan)
Route::get('backend/laporan/formlapangan', [LapanganController::class, 'formLapangan'])->name('backend.laporan.formlapangan')->middleware('auth');
Route::post('backend/laporan/cetaklapangan', [LapanganController::class, 'cetakLapangan'])->name('backend.laporan.cetaklapangan')->middleware('auth');

// Route::get('backend/v_penyewa/show', [PenyewaController::class, 'show'])->name('backend.v_penyewa.show');
// Route::get('backend/v_penyewa/show', [PenyewaController::class, 'show'])->name('backend.v_penyewa.show'->middleware('auth'));
Route::get('/v_penyewa/show', [PenyewaController::class, 'show'])
    ->name('backend.v_penyewa.show')
    ->middleware('auth');


// Route::get('penyewa/show/test', [TestController::class, 'index'])->middleware('auth');

Route::post('/show-ajax', [PenyewaController::class, 'ajax'])->name('backend.penyewa.ajax')->middleware('auth');


Route::get('backend/penyewa/jadwal', [PenyewaController::class, 'jadwal'])->name('backend.penyewa.jadwal')->middleware('auth');



Route::resource('backend/oprasional', JamOperasionalController::class, ['as' => 'backend'])->middleware('auth');
// Menambahkan rute untuk halaman index
Route::get('/oprasional', [JamOperasionalController::class, 'index'])->name('backend.v_oprasional.index');
// Route::put('v_oprasional/{id}', [OperasionalController::class, 'update'])->name('backend.v_oprasional.update');
Route::put('/oprasional/{id}/update', [JamOperasionalController::class, 'update'])->name('backen.v_oprasional.update');
Route::get('/jam-operasional/create', [JamOperasionalController::class, 'create'])->name('backend.v_oprasional.create');
// Route::get('/operasional/store', [JamOperasionalController::class, 'store'])->name('backend.v_oprasional.store');





// Rute lainnya
// Route::resource('operasional', OperasionalController::class);

// Rute untuk menampilkan form create
Route::get('backend/v_operasional/create', [JamOperasionalController::class, 'create'])->name('backend.v_operasional.create');

// Rute untuk menyimpan data create
// Route::post('backend/v_operasional/store', [JamOperasionalController::class, 'store'])->name('backend.v_operasional.store');

Route::post('backend/v_oprasional/store', [JamOperasionalController::class, 'store'])->name('backend.v_oprasional.store');
Route::get('backend/v_operasional/edit/{id}', [JamOperasionalController::class, 'edit'])->name('backend.v_operasional.edit');

// Rute untuk mengupdate data
Route::put('backend/v_operasional/update/{id}', [JamOperasionalController::class, 'update'])->name('backend.v_operasional.update');
Route::delete('backend/v_operasional/destroy/{id}', [JamOperasionalController::class, 'destroy'])->name('backend.v_operasional.destroy');

// Route::get('backend/v_payment', [PaymentController::class, 'index'])->name('backend.payment.index');
// Route::post('backend/v_payment/charge', [PaymentController::class, 'charge'])->name('backend.payment.charge');

// Route::get('backend/penyewa',  [PenyewaController::class, 'index'])->name('backend.penyewa.index');
Route::post('backend/v_penyewa/charge', [PenyewaController::class, 'charge'])->name('backend.penyewa.charge');
Route::get('backend/v_penyewa/struk/{order_id}', [PenyewaController::class, 'cetakStruk'])->name('backend.v_penyewa.struk');



// Route::post('/midtrans/notification', [PenyewaController::class, 'notificationHandler']);
// Route::post('backend/v_penyewa/update-status', [PenyewaController::class, 'updateStatus'])->name('backend.penyewa.updateStatus');
Route::post('penyewa/updateStatus', [PenyewaController::class, 'updateStatus'])->name('backend.penyewa.updateStatus');

Route::get('backend/penyewa/form', [PenyewaController::class, 'formPenyewa'])->name('backend.penyewa.form');



// Route::get('backend/penyewa/cetak', [PenyewaController::class, 'cetakPenyewa'])->name('backend.penyewa.cetak');

// Route::get('backend/payment', [PaymentController::class, 'index'])->name('backend.payment.index');
// Route::get('backend/v_payment/charge', [PaymentController::class, 'charge'])->name('backend.payment.charge');
// Route::post('/midtrans/notification', [PenyewaController::class, 'notificationHandler']);
// Route::get('/payment/{penyewa_id}', [PaymentController::class, 'index'])->name('backend.payment.index');

// Add routes for payment actions
// Add in web.php
// Route::post('/payment/{penyewa_id}/process', [PaymentController::class, 'process'])->name('backend.payment.process');

// Route::get('backend/payment', [PaymentController::class, 'index'])->name('backend.payment.index');
// Route::post('/payment/{penyewa_id}/process', [PaymentController::class, 'process'])->name('backend.payment.process');


