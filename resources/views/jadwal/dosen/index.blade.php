@extends('layouts.master')

@section('title', 'Jadwal')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Jadwal
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
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <th>Matakuliah</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Ruang</th>
                                <th>Buat Pertemuan</th>
                            </tr>
                            @forelse($jadwal as $j)
                            <tr>
                                <td>{{$j->matakuliah->name}}</td>
                                <td>{{$j->hari}}</td>
                                <td>{{$j->jam}}</td>
                                <td>{{$j->ruang->name}}</td>
                                <td><a class="btn btn-success" href="{{ route('pertemuan.create', ['jadwal_id' => $j->id]) }}">+</a></td>
                            </tr>
                            @foreach ($j->pertemuan as $pertemuan)
                            <tr>
                                <th>{{ $pertemuan->created_at->format('D d M Y') }}</th>
                                <th>{{ $pertemuan->name }}</th>
                                <th>{{ $pertemuan->topic }}</th>
                                <th><a class="btn btn-info" href="{{ route('pertemuan.show', $pertemuan->id) }}"><i class="fa fa-info"></i></a></th>
                            </tr>
                            @endforeach
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
