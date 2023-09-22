@extends('layouts.master')

@section('title', 'Pertemuan')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Pertemuan
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
            </div><!-- /.box -->
            @foreach ($pertemuanGrouped as $key => $pertemuan)
            <div class="box">
                <h1>{{ $key }}</h1>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Topik</th>
                                <th>Sub Topik</th>
                                <th>Dosen Pengganti</th>
                                <th colspan="2">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pertemuan as $p)
                            <tr>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->topic }}</td>
                                <td>{{ $p->sub_topic }}</td>
                                <td>{{ $p->dosen_pengganti }}</td>
                                <td>
                                    <ul>
                                        <li>{{$p->jadwal->matakuliah->name}}</li>
                                        <li>{{$p->jadwal->hari}}</li>
                                        <li>{{$p->jadwal->jam}}</li>
                                        <li>{{$p->jadwal->ruang->name}}</li>
                                        <li>{{$p->jadwal->kelas->name}}</li>
                                        <li>{{$p->jadwal->kelas->prodi->name}}</li>
                                    </ul>
                                </td>
                                <td>
                                    <table class="table table-sm table-bordered">
                                        <tr>
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>Status</th>
                                        </tr>
                                        @foreach($p->jadwal->kelas->users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->nomor}}</td>
                                            <td>{{ $p->presensi->contains('user_id', $user->id) ? 'Hadir' : 'Tidak Hadir' }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div>
            @endforeach
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
