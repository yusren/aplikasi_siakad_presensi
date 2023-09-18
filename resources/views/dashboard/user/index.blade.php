@extends('layouts.mahasiswa.master')
@section('container')
<!-- welcome user -->
<div class="mb-4 shadow-sm card">
    <div class="card-header">
        <div class="row">
            <div class="col-auto">
                <div class="shadow avatar avatar-50 rounded-10">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                    <!--<img src="{{ asset(auth()->user()->photo) }}" alt="">-->
                </div>
            </div>
            <div class="col align-self-center ps-0">
                <h4 class="text-color-theme"><span class="fw-normal">Hi</span>, {{ auth()->user()->name }} - ( {{ auth()->user()->nomor }} )</h4>
                <p class="text-muted">
                    {{ auth()->user()->kelas->first()->name }} - {{ auth()->user()->kelas->first()->prodi->name }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Saving targets -->
    <div class="mb-3 row">
        <div class="col">
            <h6 class="title">Menu</h6>
        </div>
    </div>

    <div class="mb-4 row">
        <div class="col-6 col-md-2 col-lg-3">
            <a href="{{ route('dashboard') }}">
                <div class="mb-3 card">
                    <div class="text-center card-body">
                        <div class="avatar avatar-30 alert-dark text-dark rounded-circle">
                            <i class="bi bi-house"></i>
                        </div>
                        <p class="mt-2 small text-muted">Home</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-2 col-lg-3">
            <a href="{{ route('jadwal.index') }}">
                <div class="mb-3 card">
                    <div class="text-center card-body">
                        <div class="avatar avatar-30 alert-success text-dark rounded-circle">
                            <i class="bi bi-calendar"></i>
                        </div>
                        <p class="mt-2 small text-muted">Jadwal</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-2 col-lg-3">
            <a href="{{ route('krs.index', ['aksiKrs' => 'lihat']) }}">
                <div class="mb-3 card">
                    <div class="text-center card-body">
                        <div class="avatar avatar-30 alert-warning text-dark rounded-circle">
                            <i class="bi bi-file-ruled"></i>
                        </div>
                        <p class="mt-2 small text-muted">Lihat KRS</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-2 col-lg-3">
            <a href="{{ route('krs.index', ['aksiKrs' => 'entri']) }}" target="_blank">
                <div class="mb-3 card">
                    <div class="text-center card-body">
                        <div class="avatar avatar-30 alert-primary text-dark rounded-circle">
                            <i class="bi bi-file-ruled"></i>
                        </div>
                        <p class="mt-2 small text-muted">Entri KRS</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

<!-- Saving targets -->
    <div class="mb-4 row">

        <div class="col-6 col-md-2 col-lg-3">
            <a href="{{ route('krs.khs') }}">
                <div class="mb-3 card">
                    <div class="text-center card-body">
                        <div class="avatar avatar-30 alert-dark text-dark rounded-circle">
                            <i class="bi bi-file-earmark-spreadsheet"></i>
                        </div>
                        <p class="mt-2 small text-muted">Lihat KHS</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-2 col-lg-3">
            <a href="{{ route('krs.rekap') }}">
                <div class="mb-3 card">
                    <div class="text-center card-body">
                        <div class="avatar avatar-30 alert-success text-dark rounded-circle">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <p class="mt-2 small text-muted">Lihat Rekap</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-2 col-lg-3">
            <a href="{{ route('user.edit', ['user' => auth()->user()->id, 'role' => 'mahasiswa']) }}">
                <div class="mb-3 card">
                    <div class="text-center card-body">
                        <div class="avatar avatar-30 alert-warning text-dark rounded-circle">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <p class="mt-2 small text-muted">Profile</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-2 col-lg-3">
            <a href="{{ route('profile.edit') }}" target="_blank">
                <div class="mb-3 card">
                    <div class="text-center card-body">
                        <div class="avatar avatar-30 alert-primary text-dark rounded-circle">
                            <i class="bi bi-gear"></i>
                        </div>
                        <p class="mt-2 small text-muted">Setting</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col">
            <h6 class="title">Pengumuman</h6>
        </div>
        <div class="col-auto align-self-center">
            <a href="#" class="small">View all</a>
        </div>
    </div>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <a href="#" class="mb-3 card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <div class="shadow-sm avatar avatar-60 rounded-10 coverimg">
                                    <img src="{{ asset('img/logo.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col align-self-center ps-0">
                                <p class="mb-1 text-color-theme">Berkomitmen Cetak Pendidik Berkarakter, STKIP PGRI Pacitan Gelar Wisuda ke XXIV</p>
                                <p class="text-muted size-12">Konsisten melahirkan lulusan yang profesional, STKIP PGRI Pacitan kembali menggelar wisuda untuk ke-24 kalinya. Mengusung tema ...</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <a href="#" class="mb-3 card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <div class="shadow-sm avatar avatar-60 rounded-10 coverimg">
                                    <img src="{{ asset('img/logo.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col align-self-center ps-0">
                                <p class="mb-1 text-color-theme">PENYERAHAN PENGHARGAAN TANDAI PUNCAK DIES NATALIS KE-31 STKIP PGRI PACITAN</p>
                                <p class="text-muted size-12">Rangkaian kegiatan Dies Natalis ke-31 STKIP PGRI Pacitan telah berakhir. Puncak kegiatan digelar pada ...</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
@endsection
