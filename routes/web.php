<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AsistenController;
use App\Http\Controllers\DosenController;
use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
})->name('dashboard');

Route::get('/kelola-matkul', function () {
    return view('matkul.index');
})->name('kelolamatkul');

Route::controller(AsistenController::class)->group(function () {
    Route::get('/kelola-asisten', 'index')->name('kelolaasisten');
    Route::get('/kelola-asisten/tambah', 'create')->name('asisten.tambah');
    Route::post('/kelola-asisten', 'store')->name('asisten.store');
    Route::get('/kelola-asisten/{asisten}/edit', 'edit')->name('asisten.edit');
    Route::put('/kelola-asisten/{asisten}', 'update')->name('asisten.update');
    Route::delete('/kelola-asisten/{asisten}', 'destroy')->name('asisten.destroy');
});

Route::controller(DosenController::class)->group(function () {
    Route::get('/kelola-dosen', 'index')->name('keloladosen');
    Route::get('/kelola-dosen/tambah', 'create')->name('dosen.tambah');
    Route::post('/kelola-dosen', 'store')->name('dosen.store');
    Route::get('/kelola-dosen/{dosen}/edit', 'edit')->name('dosen.edit');
    Route::put('/kelola-dosen/{dosen}', 'update')->name('dosen.update');
    Route::delete('/kelola-dosen/{dosen}', 'destroy')->name('dosen.destroy');
});

use App\Http\Controllers\MatkulController;
use App\Http\Controllers\MatkulKelasController;

Route::controller(MatkulController::class)->group(function () {
    Route::get('/kelola-matkul', 'index')->name('kelolamatkul');
    Route::get('/kelola-matkul/tambah', 'create')->name('matkul.tambah');
    Route::post('/kelola-matkul', 'store')->name('matkul.store');
    Route::get('/kelola-matkul/{matkul}/edit', 'edit')->name('matkul.edit');
    Route::put('/kelola-matkul/{matkul}', 'update')->name('matkul.update');
    Route::delete('/kelola-matkul/{matkul}', 'destroy')->name('matkul.destroy');
});


Route::prefix('kelola-matkul-kelas')->name('matkulkelas.')->group(function () {
    Route::get('/', [MatkulKelasController::class, 'index'])->name('index');
    Route::get('/tambah', [MatkulKelasController::class, 'create'])->name('tambah');
    Route::post('/', [MatkulKelasController::class, 'store'])->name('store');
    Route::get('/{matkulkelas}/edit', [MatkulKelasController::class, 'edit'])->name('edit');
    Route::put('/{matkulkelas}', [MatkulKelasController::class, 'update'])->name('update');
    Route::delete('/{matkulkelas}', [MatkulKelasController::class, 'destroy'])->name('destroy');
});


Route::get('/kelola-absen', [AbsenController::class, 'index'])->name('absen.index');
Route::get('/kelola-absen/cetak', [AbsenController::class, 'cetak'])->name('absen.cetak');



