<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\HtmlController;
use App\Http\Controllers\LatihanController;

use App\Http\Controllers\AnggotaController;

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\TestController;




Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('backend.login');

    });



    // Route::get('backend/beranda', function () {
    //     // Menampilkan nilai role pengguna yang sedang login
    //     dd(Auth::user()->role);
        
    //     return view('backend.beranda');
    // });
    Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])
    ->name('backend.beranda')
    ->middleware('auth', 'role:0'); // hanya Super Admin (role 1)

Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda');
Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

// Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');

// Route::resource('backend/lapangan', LapanganController::class, ['as' => 'backend'])->middleware('auth');
// Route::resource('backend/biaya', BiayaController::class, ['as' => 'backend'])->middleware('auth');
// Route::resource('backend/penyewa', PenyewaController::class, ['as' => 'backend'])->middleware('auth');

// // Route untuk reset stok
// Route::post('backend/biaya/reset-stok', [BiayaController::class, 'resetStok'])->name('backend.biaya.resetStok')->middleware('auth');




// // Route for adding photos for a field
// Route::post('foto-lapangan/store', [LapanganController::class, 'storeFoto'])->name('backend.foto_lapangan.store')->middleware('auth');

// // Route for deleting photos of a field
// Route::delete('foto-lapangan/{id}', [LapanganController::class, 'destroyFoto'])->name('backend.foto_lapangan.destroy')->middleware('auth');

// // Route for generating user report
// Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser')->middleware('auth');
// Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser')->middleware('auth');

// // Route for generating field report (Lapangan)
// Route::get('backend/laporan/formlapangan', [LapanganController::class, 'formLapangan'])->name('backend.laporan.formlapangan')->middleware('auth');
// Route::post('backend/laporan/cetaklapangan', [LapanganController::class, 'cetakLapangan'])->name('backend.laporan.cetaklapangan')->middleware('auth');

// Route::get('penyewa/show/test', [PenyewaController::class, 'show'])->name('backend.penyewa.show')->middleware('auth');
// // Route::get('penyewa/show/test', [TestController::class, 'index'])->middleware('auth');

// Route::post('/show-ajax', [PenyewaController::class, 'ajax'])->name('backend.penyewa.ajax')->middleware('auth');



// Auth::routes();



// Route::middleware(['auth', 'role:1'])->group(function () {
//     // Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');
//     Route::resource('backend/user', UserController::class, ['as' => 'backend']);
//     Route::resource('backend/lapangan', LapanganController::class, ['as' => 'backend']);
//     Route::resource('backend/biaya', BiayaController::class, ['as' => 'backend']);
//     Route::resource('backend/penyewa', PenyewaController::class, ['as' => 'backend']);
//     Route::post('/show-ajax', [PenyewaController::class, 'ajax'])->name('backend.penyewa.ajax');
//     Route::post('backend/biaya/reset-stok', [BiayaController::class, 'resetStok'])->name('backend.biaya.resetStok');
//     Route::post('foto-lapangan/store', [LapanganController::class, 'storeFoto'])->name('backend.foto_lapangan.store');
//     Route::delete('foto-lapangan/{id}', [LapanganController::class, 'destroyFoto'])->name('backend.foto_lapangan.destroy');
//     Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser');
//     Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser');
//     Route::get('backend/laporan/formlapangan', [LapanganController::class, 'formLapangan'])->name('backend.laporan.formlapangan');
//     Route::post('backend/laporan/cetaklapangan', [LapanganController::class, 'cetakLapangan'])->name('backend.laporan.cetaklapangan');
// });

// Route::middleware(['auth', 'role:0'])->group(function () {
//     Route::get('backend/lapangan', [LapanganController::class, 'index'])->name('backend.lapangan.index');
//     Route::resource('backend/biaya', BiayaController::class, ['as' => 'backend'])->except('create', 'store');
//     Route::resource('backend/penyewa', PenyewaController::class, ['as' => 'backend']);
//     Route::get('penyewa/show/test', [PenyewaController::class, 'show'])->name('backend.penyewa.show');
//     Route::post('/show-ajax', [PenyewaController::class, 'ajax'])->name('backend.penyewa.ajax');
// });
// Route::middleware(['auth', 'role:2'])->group(function () {
//     Route::get('backend/lapangan', [LapanganController::class, 'index'])->name('backend.lapangan.index');
//     Route::get('backend/penyewa', [PenyewaController::class, 'index'])->name('backend.penyewa.index');
//     Route::post('backend/penyewa', [PenyewaController::class, 'store'])->name('backend.penyewa.store');
//     Route::get('penyewa/show/test', [PenyewaController::class, 'show'])->name('backend.penyewa.show');
//     Route::post('/show-ajax', [PenyewaController::class, 'ajax'])->name('backend.penyewa.ajax');
// });




// Route untuk resource user (Hanya Admin)
Route::resource('backend/user', UserController::class, ['as' => 'backend'])
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses

// Route untuk resource lapangan (Hanya Admin)
Route::resource('backend/lapangan', LapanganController::class, ['as' => 'backend'])
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses

// Route untuk resource biaya (Hanya Admin)
Route::resource('backend/biaya', BiayaController::class, ['as' => 'backend'])
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses

// Route untuk resource penyewa (Hanya Admin)
Route::resource('backend/penyewa', PenyewaController::class, ['as' => 'backend'])
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses

// Route untuk reset stok (Hanya Admin)
Route::post('backend/biaya/reset-stok', [BiayaController::class, 'resetStok'])
    ->name('backend.biaya.resetStok')
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses

// Route untuk menambah foto lapangan (Hanya Admin)
Route::post('foto-lapangan/store', [LapanganController::class, 'storeFoto'])
    ->name('backend.foto_lapangan.store')
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses

// Route untuk menghapus foto lapangan (Hanya Admin)
Route::delete('foto-lapangan/{id}', [LapanganController::class, 'destroyFoto'])
    ->name('backend.foto_lapangan.destroy')
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses

// Route untuk laporan user (Hanya Admin)
Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])
    ->name('backend.laporan.formuser')
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses
Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])
    ->name('backend.laporan.cetakuser')
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses

// Route untuk laporan lapangan (Hanya Admin)
Route::get('backend/laporan/formlapangan', [LapanganController::class, 'formLapangan'])
    ->name('backend.laporan.formlapangan')
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses
Route::post('backend/laporan/cetaklapangan', [LapanganController::class, 'cetakLapangan'])
    ->name('backend.laporan.cetaklapangan')
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses

// Route untuk melihat jadwal penyewa (Hanya Admin)
// Route::get('backend/penyewa/jadwal', [PenyewaController::class, 'jadwal'])
//     ->name('backend.penyewa.jadwal')
//     ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses
Route::middleware(['auth'])->group(function () {
    Route::resource('penyewa', PenyewaController::class)->names('backend.penyewa');
});


// // Route untuk melihat penyewa (Hanya Admin)
// Route::get('penyewa/show/test', [PenyewaController::class, 'show'])
//     ->name('backend.penyewa.show')
//     ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses
    Route::get('penyewa/show/test', [PenyewaController::class, 'show'])->name('backend.penyewa.show')->middleware('auth');
// Route untuk AJAX penyewa (Hanya Admin)
Route::post('/show-ajax', [PenyewaController::class, 'ajax'])
    ->name('backend.penyewa.ajax')
    ->middleware('auth', 'role:admin'); // Hanya Admin yang dapat mengakses
