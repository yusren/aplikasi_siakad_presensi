@extends('layouts.mahasiswa.master')

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
            <div class="card">
                <div class="card-header">
                    <form method="GET" action="{{ url()->current() }}">
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
                                <th>Kode MK</th>
                                <th>Matakuliah</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                            </tr>
                            @forelse($jadwal as $j)
                            <tr>
                                <td>{{$j->matakuliah->code}}</td>
                                <td>{{$j->matakuliah->name}}</td>
                                <td>{{$j->hari}}</td>
                                <td>{{$j->jam}}</td>
                                <td>{{$j->ruang->name}}</td>
                                <td>{{$j->user->name}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                        </tbody>
                    </table>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
