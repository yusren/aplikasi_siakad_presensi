<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AngketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\PresensiController;
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
    Route::get('/setting', [DashboardController::class, 'setting'])->name('setting');
    Route::post('/setting-store', [DashboardController::class, 'store'])->name('setting.store');

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
    Route::get('/krs-detailprodi', [KrsController::class, 'indexDetailprodi'])->name('krs.index.detailprodi');
    Route::get('/krs-detailkelas', [KrsController::class, 'indexDetailkelas'])->name('krs.index.detailkelas');
    Route::get('/krs-detailmahasiswa', [KrsController::class, 'indexDetailmahasiswa'])->name('krs.index.detailmahasiswa');
    Route::post('/pengajuan-krs', [KrsController::class, 'pengajuanKrs'])->name('krs.pengajuan');
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::post('/nilai', [NilaiController::class, 'store'])->name('nilai.store');
    Route::resource('/pertemuan', PertemuanController::class);
    Route::resource('/presensi', PresensiController::class);
    Route::resource('/angket', AngketController::class);
    Route::resource('/pertanyaan', PertanyaanController::class);
    Route::resource('/jawaban', JawabanController::class);
    // Route::get('/krs/{user}/input-nilai', [KrsController::class, 'inputNilai'])->name('krs.input');
    Route::get('/print-krs', [ExportController::class, 'printKrs'])->name('export.print.krs');
    Route::get('/print-khs', [ExportController::class, 'printKhs'])->name('export.print.khs');
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
