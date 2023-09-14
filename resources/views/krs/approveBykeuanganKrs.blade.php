@extends('layouts.master')

@section('title', 'KRS')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data KRS
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('krs.approveByKeuanganStore') }}" method="POST">
                    @csrf
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Mahasiswa</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Matakuliah</th>
                                    <th>Kode</th>
                                    <th>SKS</th>
                                    <th>Prodi</th>
                                    <th>Status</th>
                                    <th>Dosbing</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($krs as $kr)
                                <tr>
                                    <th><input type="checkbox" name="selectedKrsID[]" value="{{ $kr->id }}"></th>
                                    <td>{{$kr->user->name}}</td>
                                    <td>{{$kr->semester}}</td>
                                    <td>{{$kr->tahunAjaran->semester}} - {{$kr->tahunAjaran->name}}</td>
                                    <td>{{$kr->matakuliah->name}}</td>
                                    <td>{{$kr->matakuliah->code}}</td>
                                    <td>{{$kr->matakuliah->sks}}</td>
                                    <td>{{$kr->matakuliah->prodi->name}}</td>
                                    <td>{{$kr->status}}</td>
                                    <td>{{$kr->user->user->name}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('krs.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
