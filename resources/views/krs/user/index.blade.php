@extends('layouts.mahasiswa.master')

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
            <div class="card">
                <div class="card-header">
                    <form method="GET" action="{{ url()->current() }}">
                        <input type="hidden" name="aksiKrs" value="{{ $aksiKrs }}">
                        <div class="mb-1 form-group">
                            <label>Tahun Ajaran</label>
                            <select required class="form-control select2" name="tahun_ajaran_id" data-placeholder="Pilih Tahun Ajaran" style="width: 100%;">
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
                </div><!-- /.card-header -->
                <div class="card-body table-responsive">
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
                </div><!-- /.card-body -->
                <div class="card-footer">
                    @if ($aksiKrs == 'entri')
                        @if ($krs->count() > 0)
                        <form method="POST" action="{{ route('krs.pengajuan') }}">
                            @csrf
                            <div class="mb-1 form-group">
                                <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaranAktif->id }}">
                                <button type="submit" class="btn btn-success">Ajukan KRS</button>
                            </div>
                        </form>
                        @endif
                    @else
                    <form method="GET" action="{{ route('export.print.krs') }}">
                        <div class="mb-1 form-group">
                            <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaranAktif->id }}">
                            <button type="submit" class="btn btn-success">Cetak KRS</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
