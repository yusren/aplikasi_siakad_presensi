<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AngketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RpsController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\TestAngketController;
use App\Http\Controllers\TestRpsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login-mhs', [AuthController::class, 'login'])->name('mahasiswa.login');

Route::middleware(['auth', 'checkangketsetelahlogin', 'checkrps'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/jadwal-detailprodi', [JadwalController::class, 'indexDetailprodi'])->name('jadwal.index.detailprodi');
    Route::get('/jadwal-detailkelas', [JadwalController::class, 'indexDetailkelas'])->name('jadwal.index.detailkelas');
    Route::get('/jadwal-detailmatakuliah', [JadwalController::class, 'indexDetailmatakuliah'])->name('jadwal.index.detailmatakuliah');
    Route::get('/jadwal-detailpertemuan', [JadwalController::class, 'indexDetailpertemuan'])->name('jadwal.index.detailpertemuan');

    // Route::resource('/krs', KrsController::class)->middleware('checkangketsebelumlihatnilai');
    Route::resource('/krs', KrsController::class)->middleware(['checkangketsebelumentrikrs', 'checkangketsebelumlihatnilai']);
    Route::get('/krs-rekap', [KrsController::class, 'rekap'])->name('krs.rekap');

    Route::get('/krs-detailprodi', [KrsController::class, 'indexDetailprodi'])->name('krs.index.detailprodi');
    Route::get('/krs-detailkelas', [KrsController::class, 'indexDetailkelas'])->name('krs.index.detailkelas');
    Route::get('/krs-detailmahasiswa', [KrsController::class, 'indexDetailmahasiswa'])->name('krs.index.detailmahasiswa');
    Route::post('/krs/showDetails', [KrsController::class, 'showDetails'])->name('krs.showDetails');
    Route::post('/krs-pengajuan', [KrsController::class, 'pengajuanKrs'])->name('krs.pengajuan');

    Route::get('/krs-approveByDosbing', [KrsController::class, 'approveByDosbingKrs'])->name('krs.approveByDosbing');
    Route::get('/krs-approveByKaprodi', [KrsController::class, 'approveByKaprodiKrs'])->name('krs.approveByKaprodi');
    Route::get('/krs-approveByKeuangan', [KrsController::class, 'approveByKeuanganKrs'])->name('krs.approveByKeuangan');
    Route::post('/krs-approveByDosbingStore', [KrsController::class, 'approveByDosbingStoreKrs'])->name('krs.approveByDosbingStore');
    Route::post('/krs-approveByKaprodiStore', [KrsController::class, 'approveByKaprodiStoreKrs'])->name('krs.approveByKaprodiStore');
    Route::post('/krs-approveByKeuanganStore', [KrsController::class, 'approveByKeuanganStoreKrs'])->name('krs.approveByKeuanganStore');

    Route::get('/print-krs', [ExportController::class, 'printKrs'])->name('export.print.krs');
    Route::get('/print-khs', [ExportController::class, 'printKhs'])->name('export.print.khs');
    Route::get('/print-jurnaldosen', [ExportController::class, 'printJurnalDosen'])->name('export.print.jurnaldosen');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'show'])->name('pengumuman.show');
});

Route::middleware(['role:mahasiswa'])->group(function () {
    Route::get('/khs', [KrsController::class, 'khs'])->name('krs.khs');
    Route::post('/uploadtugas', [PertemuanController::class, 'uploadtugas'])->name('pertemuan.uploadtugas');
    Route::get('/jadwal/{jadwal}', [JadwalController::class, 'show'])->name('jadwal.show');
});
Route::middleware(['role:dosen'])->group(function () {
    Route::get('/khs', [KrsController::class, 'khs'])->name('krs.khs');
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/nilai-detailprodi', [NilaiController::class, 'indexDetailprodi'])->name('nilai.index.detailprodi');
    Route::get('/nilai-detailkelas', [NilaiController::class, 'indexDetailkelas'])->name('nilai.index.detailkelas');
    Route::get('/nilai-detailmatakuliah', [NilaiController::class, 'indexDetailmatakuliah'])->name('nilai.index.detailmatakuliah');
    Route::post('/nilai', [NilaiController::class, 'store'])->name('nilai.store');

    Route::resource('/presensi', PresensiController::class);
    Route::get('/presensi-rekap', [PresensiController::class, 'rekap'])->name('presensi.rekap');
    Route::post('/presensi-bluk', [PresensiController::class, 'storeBulk'])->name('presensi.storeBulk');

    Route::resource('/pertemuan', PertemuanController::class);
});
Route::middleware(['role:superadmin'])->group(function () {
    Route::resource('/admin', AdminController::class);
    Route::resource('/user', UserController::class);
    Route::get('/gender', [UserController::class, 'getUsersByLocation']);
    Route::post('/mahasiswa/import', [UserController::class, 'importMahasiswa'])->name('mahasiswa.import');
    Route::post('/dosen/import', [UserController::class, 'importDosen'])->name('dosen.import');

    Route::resource('/fakultas', FakultasController::class);
    Route::get('/fakultas/{fakultas_id}/prodi', [FakultasController::class, 'getProdi']);
    Route::resource('/prodi', ProdiController::class);
    Route::get('/prodi/{prodi_id}/matakuliah', [ProdiController::class, 'getMatakuliah']);
    Route::get('/prodi/{prodi_id}/kelas', [ProdiController::class, 'getKelas']);
    Route::resource('/kelas', KelasController::class);
    Route::resource('/ruang', RuangController::class);
    Route::resource('/jadwal', JadwalController::class)->except(['index', 'show']);

    Route::post('/matakuliah/import', [MatakuliahController::class, 'import'])->name('matakuliah.import');
    Route::get('/setting', [DashboardController::class, 'setting'])->name('setting');
    Route::post('/setting-store', [DashboardController::class, 'store'])->name('setting.store');
    Route::resource('/tahunajaran', TahunAjaranController::class);

    Route::resource('/angket', AngketController::class);
    Route::resource('/pertanyaan', PertanyaanController::class);
    Route::resource('/jawaban', JawabanController::class);
    Route::resource('/pengumuman', PengumumanController::class)->except(['show']);
    Route::resource('/rps', RpsController::class);
});

Route::middleware(['role:superadmin|dosen'])->group(function () {
    Route::resource('/matakuliah', MatakuliahController::class);
});

Route::resource('/inputrps', TestRpsController::class)->middleware('auth');
Route::resource('/test', TestAngketController::class)->middleware('auth');
Route::get('provinces', [DependantDropdownController::class, 'provinces'])->name('provinces');
Route::get('cities', [DependantDropdownController::class, 'cities'])->name('cities');
Route::get('districts', [DependantDropdownController::class, 'districts'])->name('districts');
Route::get('villages', [DependantDropdownController::class, 'villages'])->name('villages');

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
