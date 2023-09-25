@extends('layouts.mahasiswa.master')

@section('title', 'Upload Tugas')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Upload Tugas
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th>Kode MK</th>
                            <td>{{$jadwal->matakuliah->code}}</td>
                        </tr>
                        <tr>
                            <th>Matakuliah</th>
                            <td>{{$jadwal->matakuliah->name}}</td>
                        </tr>
                        <tr>
                            <th>Hari</th>
                            <td>{{$jadwal->hari}}</td>
                        </tr>
                        <tr>
                            <th>Jam</th>
                            <td>{{$jadwal->jam}}</td>
                        </tr>
                        <tr>
                            <th>Ruang</th>
                            <td>{{$jadwal->ruang->name}}</td>
                        </tr>
                        <tr>
                            <th>Dosen</th>
                            <td>{{$jadwal->user->name}}</td>
                        </tr>
                        <tr>
                            <td>Pertemuan Ke</td>
                            <td>Upload Tugas</td>
                        </tr>
                        @foreach ($jadwal->pertemuan as $pertemuan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($pertemuan->tugas()->where('user_id', auth()->id())->first())
                                <a href="{{ $pertemuan->tugas()->where('user_id', auth()->id())->first()->file }}" class="btn btn-sm btn-warning">Download</a>
                                @else
                                <a href="{{ route('pertemuan.show', $pertemuan->id) }}" class="btn btn-sm btn-primary">{{ $pertemuan->name }}</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
