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
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Kelas</td>
                                <td>Kode Kelas</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach ($users as $kelas => $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kelas }}</td>
                            <td>{{ $value->first()->kelas->first()->code }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('krs.index.detailmahasiswa', ['groupKey' => 'mahasiswa', 'kelas' => $value->first()->kelas->first()->id, 'tahun_ajaran_id' => $tahunAjaranAktif->id ]) }}">Show</a>
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
