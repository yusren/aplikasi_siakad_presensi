@extends('layouts.master')

@section('title', 'KRS')

@section('container')

<section class="content-header">
    <h1>
        Data KRS
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="krs" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="4">Kelas</th>
                                <th>{{$user->kelas->first()->name}}</th>
                            </tr>
                            <tr>
                                <th colspan="4">Nama</th>
                                <th>{{$user->name}}</th>
                            </tr>
                            <tr>
                                <th colspan="4">NIM</th>
                                <th>{{$user->nim}}</th>
                            </tr>
                            @if (count($krs) > 0)
                            <tr>
                                <th colspan="4">Tahun Ajaran</th>
                                <th>{{$krs->first()->tahunAjaran->name}}</th>
                            </tr>
                            @endif
                        </thead>
                        @if (count($krs) > 0)
                        <tbody>
                            <tr>
                                <th colspan="5" class="text-right">KRS</th>
                            </tr>
                            <tr>
                                <th>Dosen</th>
                                <th>Matakuliah</th>
                                <th>Kode</th>
                                <th>SKS</th>
                                <th>Nilai</th>
                            </tr>
                            @forelse($krs as $kr)
                            <tr>
                                <td>{{$kr->matakuliah->user->name}}</td>
                                <td>{{$kr->matakuliah->name}}</td>
                                <td>{{$kr->matakuliah->code}}</td>
                                <td>{{$kr->matakuliah->sks}}</td>
                                <td>{{$kr->nilai}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Kosong</td>
                            </tr>
                            @endforelse
                            <tr>
                                <th colspan="5" class="text-right">Jadwal</th>
                            </tr>
                            <tr>
                                <th>Matakuliah</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                            </tr>
                            @forelse($jadwal as $j)
                            <tr>
                                <td>{{$j->matakuliah->name}}</td>
                                <td>{{$j->hari}}</td>
                                <td>{{$j->jam}}</td>
                                <td>{{$j->ruang->name}}</td>
                                <td>{{$j->user->name}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                        @endif
                    </table>
                </div>
                <div class="box-footer">
                    <a href="{{ route('user.index') }}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
