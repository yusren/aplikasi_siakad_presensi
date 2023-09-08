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
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select required class="form-control select2" name="tahun_ajaran_id"
                                data-placeholder="Pilih Tahun Ajaran" style="width: 100%;">
                                @foreach($tahunAjaran as $ta)
                                <option value="{{ $ta->id }}" {{ (request('tahun_ajaran_id')==$ta->id ||
                                    $tahunAjaranAktif->id == $ta->id) ? 'selected' : '' }}>
                                    {{ $ta->name }} - {{ $ta->semester }}. {{ $ta->is_active ? 'aktif' : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                    <hr />
                    <form method="POST" action="{{ route('krs.pengajuan') }}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaranAktif->id }}">
                            <button type="submit" class="btn btn-success">Ajukan KRS</button>
                        </div>
                    </form>
                    <form method="GET" action="{{ route('export.print.krs') }}">
                        <div class="form-group">
                            <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaranAktif->id }}">
                            <button type="submit" class="btn btn-success">Cetak KRS</button>
                        </div>
                    </form>
                    <form method="GET" action="{{ route('export.print.khs') }}">
                        <div class="form-group">
                            <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaranAktif->id }}">
                            <button type="submit" class="btn btn-success">Cetak KHS</button>
                        </div>
                    </form>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <th>Dosen</th>
                                <th>Matakuliah</th>
                                <th>Kode</th>
                                <th>SKS</th>
                                <th>Status</th>
                            </tr>
                            @forelse($krs as $kr)
                            <tr>
                                <td>{{$kr->matakuliah->user->name}}</td>
                                <td>{{$kr->matakuliah->name}}</td>
                                <td>{{$kr->matakuliah->code}}</td>
                                <td>{{$kr->matakuliah->sks}}</td>
                                <td>{{$kr->status}}</td>
                            </tr>
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
