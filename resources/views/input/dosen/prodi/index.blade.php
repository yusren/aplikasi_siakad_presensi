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
                <div class="box-header">
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select required class="form-control select2" name="tahun_ajaran_id" data-placeholder="Pilih Tahun Ajaran" style="width: 100%;">
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
                                <td>Nama Prodi</td>
                                <td>Kode Prodi</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach($users as $prodiData => $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $prodiData }}</td>
                            <td>{{ $value->first()->kelas->first()->prodi->code }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('nilai.index.detailkelas', ['prodi' => $value->first()->kelas->first()->prodi->id, 'tahun_ajaran_id' => $tahunAjaranAktif->id ]) }}">Show</a>
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
