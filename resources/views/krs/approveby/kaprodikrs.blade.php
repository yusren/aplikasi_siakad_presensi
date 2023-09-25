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
                <form action="{{ route('krs.approveByKaprodiStore') }}" method="POST">
                    @csrf
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Mahasiswa</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($krs as $userId => $krGroupedByTahunAjaran)
                                @foreach($krGroupedByTahunAjaran as $tahunAjaranId => $kr)
                                <tr>
                                    <td><input type="checkbox" name="selectedUserTahunAjaranID[]" value="{{ $userId }}_{{ $tahunAjaranId }}"></td>
                                    <td>{{ $kr->first()->user->name }}</td>
                                    <td>{{ $kr->first()->semester }}</td>
                                    <td>{{ $kr->first()->tahunAjaran->semester }} - {{ $kr->first()->tahunAjaran->name }}</td>
                                    {{-- <td><a class="btn btn-info" href="{{ route('user.show', ['user' => $kr->first()->user->id, 'role' => 'mahasiswa' , 'tahun_ajaran_id' => $kr->first()->tahunAjaran->id]) }}">Show</a></td> --}}
                                    <td><a class="btn btn-info show-krs-details" data-user-id="{{ $kr->first()->user->id }}" data-tahun-ajaran-id="{{ $kr->first()->tahunAjaran->id }}" href="#">Show</a></td>
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
@include('krs.components.modal-user-krs')
@endsection
