@extends('layouts.master')

@section('title', 'Jurnal Dosen')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Jurnal Dosen
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-sm table-bordered table-responsive">
                        <tr>
                            <th>Nama Dosen</th>
                            <th>{{ $jadwal->user->name }}</th>
                        </tr>
                        <tr>
                            <th>NIDN Dosen</th>
                            <th>{{ $jadwal->user->nomor }}</th>
                        </tr>
                    </table>
                    @foreach ($jadwal->pertemuan as $pertemuan)
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th>Pertemuan Ke</th>
                            <td>{{ $loop->iteration }}. {{ $pertemuan->name }} ({{ $pertemuan->created_at->format('D d M Y') }})</td>
                        </tr>
                        <tr>
                            <th>Dosen pengganti</th>
                            <td>{{ $pertemuan->dosen_pengganti }}</td>
                        </tr>
                        <tr>
                            <th>Pokok Pembahasan</th>
                            <td>{{ $pertemuan->topic }}</td>
                        </tr>
                        <tr>
                            <th>Sub Pokok Pembahasan</th>
                            <td>{{ $pertemuan->sub_topic }}</td>
                        </tr>
                    </table>
                    @endforeach
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
