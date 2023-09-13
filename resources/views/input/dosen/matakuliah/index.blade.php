@extends('layouts.master')

@section('title', 'Nilai')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Nilai
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Matakuliah</td>
                                <td>Nama Matakuliah</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach ($users as $matakuliah => $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $matakuliah }}</td>
                            <td>{{ $value->first()['matakuliahCode'] }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('nilai.index', ['matakuliah_id' => $value->first()['matakuliahId'], 'tahun_ajaran_id' => $tahunAjaranAktif->id ]) }}">Show</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
