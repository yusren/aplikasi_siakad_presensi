@extends('layouts.master')

@section('title', 'Detail')

@section('container')

<section class="content-header">
    <h1>
        Detail Dosen
    </h1>
</section>

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
                                <option value="{{ $ta->id }}" {{ (request('tahun_ajaran_id')==$ta->id ||
                                    $tahunAjaranAktif->id == $ta->id) ? 'selected' : '' }}>
                                    {{ $ta->name }} - {{ $ta->semester }}. {{ $ta->is_active ? 'aktif' : '' }}
                                </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="role" value="dosen">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <div class="box-body table-responsive">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Data Dosen</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Mata Kuliah Diampu</a></li>
                            <li><a href="#tab_3" data-toggle="tab">Jadwal</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Program Studi</th>
                                            <th colspan="4">{{$user->prodi->name}}</th>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <th colspan="4">{{$user->name}}</th>
                                        </tr>
                                        <tr>
                                            <th>NIDN</th>
                                            <th colspan="4">{{$user->nomor}}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive">
                                        <tbody>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Matakuliah</th>
                                                <th>SKS</th>
                                                <th>Semester</th>
                                            </tr>
                                            @forelse($user->matakuliah as $value)
                                            <tr>
                                                <td>{{$value->code}}</td>
                                                <td>{{$value->name}}</td>
                                                <td>{{$value->sks}}</td>
                                                <td>{{$value->semester}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5">Kosong</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_3">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive">
                                        <tbody>
                                            <tr>
                                                <th>Matakuliah</th>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Ruang</th>
                                                <th>Kelas</th>
                                            </tr>
                                            @forelse($jadwal as $j)
                                            <tr>
                                                <td>{{$j->matakuliah->name}}</td>
                                                <td>{{$j->hari}}</td>
                                                <td>{{$j->jam}}</td>
                                                <td>{{$j->ruang->name}}</td>
                                                <td>{{$j->kelas->name}}</td>
                                            </tr>
                                            @foreach ($j->pertemuan as $pertemuan)
                                            <tr>
                                                <th colspan="1"></th>
                                                <th colspan="2">{{ $pertemuan->created_at->format('D d M Y') }}</th>
                                                <th>{{ $pertemuan->name }}</th>
                                                <th>{{ $pertemuan->topic }}</th>
                                            </tr>
                                            @endforeach
                                            @empty
                                            <tr>
                                                <td colspan="5">Kosong</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('user.index', ['role' => 'dosen']) }}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
