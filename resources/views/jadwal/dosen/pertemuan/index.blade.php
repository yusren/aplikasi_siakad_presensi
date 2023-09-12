@extends('layouts.master')

@section('title', 'Jadwal')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Jadwal
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <th>Matakuliah</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Ruang</th>
                                <th>Kelas</th>
                                <th>Prodi</th>
                                <th>Buat Pertemuan</th>
                            </tr>
                            @forelse($jadwal as $j)
                            <tr>
                                <td>{{$j->matakuliah->name}}</td>
                                <td>{{$j->hari}}</td>
                                <td>{{$j->jam}}</td>
                                <td>{{$j->ruang->name}}</td>
                                <td>{{$j->kelas->name}}</td>
                                <td>{{$j->kelas->prodi->name}}</td>
                                <td><a class="btn btn-success" href="{{ route('pertemuan.create', ['jadwal_id' => $j->id]) }}">+</a></td>
                            </tr>
                            @foreach ($j->pertemuan as $pertemuan)
                            <tr>
                                <th>{{ $pertemuan->created_at->format('D d M Y') }}</th>
                                <th colspan="3">{{ $pertemuan->name }}</th>
                                <th>{{ $pertemuan->topic }}</th>
                                <th><a class="btn btn-info" href="{{ route('pertemuan.show', $pertemuan->id) }}"><i class="fa fa-info"></i></a></th>
                            </tr>
                            @endforeach
                            @empty
                            <tr>
                                <td colspan="5">Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
