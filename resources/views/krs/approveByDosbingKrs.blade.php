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
                <form action="{{ route('krs.approveByDosbingStore') }}" method="POST">
                    @csrf
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Mahasiswa</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                    <th>KRS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($krs as $userId => $krGroupedByTahunAjaran)
                                @foreach($krGroupedByTahunAjaran as $tahunAjaranId => $kr)
                                <tr>
                                    <td><input type="checkbox" name="selectedUserTahunAjaranID[]" value="{{ $userId }}_{{ $tahunAjaranId }}"></td>
                                    <td>{{ $kr->first()->user->name }}</td>
                                    <td>{{ $kr->first()->semester }}</td>
                                    <td>{{ $kr->first()->tahunAjaran->name }}</td>
                                    <td colspan="4">
                                        <table class="table table-bordered table-responsive table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Matakuliah</th>
                                                    <th>Kode</th>
                                                    <th>SKS</th>
                                                    <th>Prodi</th>
                                                    <th>Status</th>
                                                    <th>Dosen MK</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($kr as $item)
                                                <tr>
                                                    <td>{{$item->matakuliah->name}}</td>
                                                    <td>{{$item->matakuliah->code}}</td>
                                                    <td>{{$item->matakuliah->sks}}</td>
                                                    <td>{{$item->matakuliah->prodi->name}}</td>
                                                    <td>{{$item->status}}</td>
                                                    <td>{{$item->matakuliah->user->name}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                @endforeach
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
