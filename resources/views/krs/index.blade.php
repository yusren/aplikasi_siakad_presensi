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
                <div class="box-header">
                    <a href="{{ route('krs.create') }}" class="btn btn-md bg-green">Tambah</a>
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select required class="form-control select2" name="tahun_ajaran_id"
                                data-placeholder="Pilih Tahun Ajaran" style="width: 100%;">
                                @foreach($tahunAjaran as $ta)
                                <option value="{{ $ta->id }}" {{ (request('tahun_ajaran_id')==$ta->id || $tahunAjaranAktif->id == $ta->id) ? 'selected' : '' }}>
                                    {{ $ta->name }} - {{ $ta->semester }}. {{ $ta->is_active ? 'aktif' : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>NIM</td>
                                <td>Nama Mahasiswa</td>
                                <td>Status</td>
                                <td>Kelas</td>
                                <td>Semester</td>
                                <td>Validasi</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach ($users as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->nomor }}</td>
                            <td>{{ $value->name }}</td>
                            <td>Registrasi {{ $value->status }}</td>
                            <td>{{ $value->kelas->first()->name }}</td>
                            <td>{{ $value->krs->first()->semester }}</td>
                            <td>{{ $value->krs->first()->status }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('user.show', ['user' => $value->id, 'tahun_ajaran_id' => $tahunAjaranAktif->id]) }}">Show</a>
                                {{-- <a class="btn btn-success" href="{{ route('krs.input', ['user' => $value->id, 'tahun_ajaran_id' => $tahunAjaranAktif->id]) }}">Input Nilai</a> --}}
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
