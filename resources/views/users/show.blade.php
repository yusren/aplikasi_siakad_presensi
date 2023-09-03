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
                    @if (count($krs) > 0)
                    <table id="krs" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">Kelas</th>
                                <th>{{$user->kelas->first()->name}}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Nama</th>
                                <th>{{$user->name}}</th>
                            </tr>
                            <tr>
                                <th colspan="2">NIM</th>
                                <th>{{$user->nim}}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Tahun Ajaran</th>
                                <th>{{$krs->first()->tahunAjaran->name}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th colspan="3">KRS</th>
                            </tr>
                            <tr>
                                <th>Matakuliah</th>
                                <th>Kode</th>
                                <th>SKS</th>
                            </tr>
                            @foreach($krs as $kr)
                            <tr>
                                <td>{{$kr->matakuliah->name}}</td>
                                <td>{{$kr->matakuliah->code}}</td>
                                <td>{{$kr->matakuliah->sks}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <table id="jadwal" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="4">Jadwal</th>
                            </tr>
                            <tr>
                                <th>Matakuliah</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwal as $j)
                            <tr>
                                <td>{{$j->matakuliah->name}}</td>
                                <td>{{$j->hari}}</td>
                                <td>{{$j->jam}}</td>
                                <td>{{$j->ruang->name}}</td>
                                <td>{{$j->user->name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="box-footer">
                    <a href="{{ route('user.index') }}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
