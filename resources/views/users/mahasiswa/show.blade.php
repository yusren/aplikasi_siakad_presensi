@extends('layouts.master')

@section('title', 'KRS')

@section('container')

<section class="content-header">
    <h1>
        Data KRS
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
                            <select required class="form-control select2" name="tahun_ajaran_id"
                                data-placeholder="Pilih Tahun Ajaran" style="width: 100%;">
                                @foreach($tahunAjaran as $ta)
                                <option value="{{ $ta->id }}" {{ (request('tahun_ajaran_id')==$ta->id ||
                                    $tahunAjaranAktif->id == $ta->id) ? 'selected' : '' }}>
                                    {{ $ta->name }} - {{ $ta->semester }}. {{ $ta->is_active ? 'aktif' : '' }}
                                </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="role" value="mahasiswa">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <div class="box-body table-responsive">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li><a href="#tab_1" data-toggle="tab">Data Mahasiswa</a></li>
                            <li class="active"><a href="#tab_2" data-toggle="tab">KRS</a></li>
                            <li><a href="#tab_3" data-toggle="tab">Jadwal</a></li>
                            {{-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> --}}
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="tab_1">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kelas</th>
                                            <th colspan="4">{{$user->kelas->first()->name}}</th>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <th colspan="4">{{$user->name}}</th>
                                        </tr>
                                        <tr>
                                            <th>NIM</th>
                                            <th colspan="4">{{$user->nomor}}</th>
                                        </tr>
                                        @if (count($krs) > 0)
                                        <tr>
                                            <th>Semester</th>
                                            <th colspan="4">{{$krs->first()->semester}}</th>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>Tahun Ajaran</th>
                                            <th colspan="4">{{$tahunAjaranAktif->name}}, {{$tahunAjaranAktif->semester}}
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="tab-pane active" id="tab_2">
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Dosen</th>
                                                <th>Matakuliah</th>
                                                <th>Kode</th>
                                                <th>SKS</th>
                                                <th>
                                                    <table class="table table-bordered table-sm">
                                                        <tr>
                                                            <th>Tugas</th>
                                                            <th>UTS</th>
                                                            <th>UAS</th>
                                                            <th>Keaktifan</th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($krs as $kr)
                                            <tr>
                                                <td>{{$kr->matakuliah->user->name}}</td>
                                                <td>{{$kr->matakuliah->name}}</td>
                                                <td>{{$kr->matakuliah->code}}</td>
                                                <td>{{$kr->matakuliah->sks}}</td>
                                                <td>
                                                    <table class="table table-bordered table-sm">
                                                        <tr>
                                                            <td>{{$kr->nilai_tugas}}</td>
                                                            <td>{{$kr->nilai_uts}}</td>
                                                            <td>{{$kr->nilai_uas}}</td>
                                                            <td>{{$kr->nilai_keaktifan}}</td>
                                                        </tr>
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
                                </div>
                            </div>

                            <div class="tab-pane" id="tab_3">
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Matakuliah</th>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Ruang</th>
                                                <th>Dosen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($jadwal as $j)
                                            <tr>
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('user.index', ['role' => 'mahasiswa']) }}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection