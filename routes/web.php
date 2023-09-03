<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/admin', AdminController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/fakultas', FakultasController::class);
    Route::get('/fakultas/{fakultas_id}/prodi', [FakultasController::class, 'getProdi']);
    Route::resource('/matakuliah', MatakuliahController::class);
    Route::resource('/ruang', RuangController::class);
    Route::resource('/kelas', KelasController::class);
    Route::resource('/prodi', ProdiController::class);
    Route::get('/prodi/{prodi_id}/matakuliah', [ProdiController::class, 'getMatakuliah']);
    Route::get('/prodi/{prodi_id}/kelas', [ProdiController::class, 'getKelas']);
    Route::resource('/tahunajaran', TahunAjaranController::class);
    Route::resource('/jadwal', JadwalController::class);
    Route::resource('/krs', KrsController::class);
});

require __DIR__.'/auth.php';

//* Artisan Commands
Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');

    return redirect('/login')->with(['success' => 'Optimization Berhasil']);
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');

    return redirect('/login')->with(['success' => 'Storage Link Berhasil']);
});
