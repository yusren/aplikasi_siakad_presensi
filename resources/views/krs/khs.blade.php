@extends('layouts.mahasiswa.master')

@section('title', 'Kartu Hasil Studi')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Kartu Hasil Studi
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
                </div><!-- /.card-header -->
                <div class="card-body">
                    @if ($krs->count() > 0)
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td>Nama Mahasiswa</td>
                            <td>:</td>
                            <td>{{ auth()->user()->name }}</td>
                            <td>Semester</td>
                            <td>:</td>
                            <td>{{ $krs->first()->semester }}</td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td>:</td>
                            <td>{{ auth()->user()->nomor }}</td>
                            <td>Tahun Ajaran</td>
                            <td>:</td>
                            <td>{{ $tahunAjaranAktif->name }}</td>
                        </tr>
                    </table>

                    <table class="table table-bordered">
                        <tr class="bg-info">
                            <th>No</th>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Nilai</th>
                            <th>Bobot</th>
                        </tr>
                        @foreach ($krs as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->matakuliah->code }}</td>
                            <td>{{ $value->matakuliah->name }}</td>
                            <td>{{ $value->matakuliah->sks }}</td>
                            @if ($value->matakuliah->angket && auth()->user()->hasilAngket->whereIn('angket_id', $value->matakuliah->angket->id)->count() == 0)
                                <td colspan="2"><a class="btn btn-info" href="{{ route('test.show', $value->matakuliah->angket->id) }}">Show</a></td>
                            @else
                                <td>{{$convertScoreToGrade((($bobot_tugas/100)*$value->nilai_tugas)+(($bobot_uts/100)*$value->nilai_uts)+(($bobot_uas/100)*$value->nilai_uas)+(($bobot_keaktifan/100)*$value->nilai_keaktifan))}}</td>
                                <td>{{ (($bobot_tugas/100)*$value->nilai_tugas) + (($bobot_uts/100)*$value->nilai_uts) +(($bobot_uas/100)*$value->nilai_uas) + (($bobot_keaktifan/100)*$value->nilai_keaktifan)}}</td>
                            @endif
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <th>Jumlah</th>
                            <td>{{ $krs->sum('matakuliah.sks') }}</td>
                            <td></td>
                        </tr>
                    </table>

                    <table class="table text-center table-bordered">
                        <tr>
                            <td colspan="2">SKS</td>
                            <td rowspan="2">Jumlah Nilai Yang Masuk</td>
                            <td rowspan="2">BOBOT</td>
                            <td rowspan="2">IP. SMT</td>
                            <td rowspan="2">IPK</td>
                        </tr>
                        <tr>
                            <td>Lulus</td>
                            <td>Gagal</td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>{{ $totalScore }}</td>
                            <td>{{ $ip }}</td>
                            <td>{{ $ipk }}</td>
                        </tr>
                    </table>
                    @endif
                </div>
                <div class="card-footer">
                    <form method="GET" action="{{ route('export.print.khs') }}">
                        <div class="mb-1 form-group">
                            <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaranAktif->id }}">
                            <button type="submit" class="btn btn-success">Cetak KHS</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
