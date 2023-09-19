@extends('layouts.master')

@section('title', 'KRS')

@section('container')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select required class="form-control select2" name="tahun_ajaran_id"
                                data-placeholder="Pilih Tahun Ajaran" style="width: 100%;">
                                @foreach($tahunAjaran as $ta)
                                <option value="{{ $ta->id }}" {{ (request('tahun_ajaran_id') == $ta->id || $tahunAjaranAktif->id == $ta->id) ? 'selected' : '' }}>
                                    {{ $ta->name }} - {{ $ta->semester }}. {{ $ta->is_active ? 'aktif' : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select class="form-control select2" name="matakuliah_id"
                                data-placeholder="Pilih Mata Kuliah" style="width: 100%;" id="matakuliah">
                                <option value="" selected disabled>Pilih Mata Kuliah</option>
                                @foreach ($matakuliah as $mk)
                                <option value="{{ $mk->id }}" {{ (request('matakuliah_id') == $mk->id || isset($matakuliahAktif) && $matakuliahAktif->id == $mk->id) ? 'selected' : '' }}>
                                    {{ $mk->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('matakuliah_id')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                    <hr />
                    @if ($matakuliahAktif)
                    <h3>{{ $matakuliahAktif->name }} {{ $matakuliahAktif->code }}</h3>
                    @endif
                    @if ($users)
                    <form action="{{ route('nilai.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="matakuliah_id" value="{{ $matakuliahAktif->id }}">
                        <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaranAktif->id }}">
                        <div class="box-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>NIM</td>
                                        <td>Nama Mahasiswa</td>
                                        <td>Kelas</td>
                                        <td>Prodi</td>
                                        <td>Absen</td>
                                        <td>Tugas</td>
                                        <td>UTS</td>
                                        <td>UAS</td>
                                        <td>Keaktifan</td>
                                        <td>N.A</td>
                                        <td>N.B</td>
                                    </tr>
                                </thead>
                                @foreach ($users as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->nomor }}</td>
                                    <td>{{ $value->name }} <input type="hidden" name="krs_id[]" value="{{ $value->krs->first()->id }}"></td>
                                    <td>{{ $value->kelas->first()->name }}</td>
                                    <td>{{ $value->kelas->first()->prodi->name }}</td>
                                    <td>
                                        @php
                                            $absen = $value->presensi->where('pertemuan.jadwal.tahun_ajaran_id', $tahunAjaranAktif->id)->where('pertemuan.jadwal.matakuliah_id', $matakuliahAktif->id)->count();
                                        @endphp
                                        {{ $absen }}
                                    </td>
                                    <td><input @if ($absen < 13) disabled @endif type="number" name="nilai_tugas[]" value="{{ $value->krs->first()->nilai_tugas }}" min="0"></td>
                                    <td><input @if ($absen < 13) disabled @endif type="number" name="nilai_uts[]" value="{{ $value->krs->first()->nilai_uts }}" min="0"></td>
                                    <td><input @if ($absen < 13) disabled @endif type="number" name="nilai_uas[]" value="{{ $value->krs->first()->nilai_uas }}" min="0"></td>
                                    <td><input @if ($absen < 13) disabled @endif type="number" name="nilai_keaktifan[]" value="{{ $value->krs->first()->nilai_keaktifan }}" min="0"></td>
                                    <td>{{ $convertScoreToGrade((($bobot_tugas/100)*$value->krs->first()->nilai_tugas)+(($bobot_uts/100)*$value->krs->first()->nilai_uts)+(($bobot_uas/100)*$value->krs->first()->nilai_uas)+(($bobot_keaktifan/100)*$value->krs->first()->nilai_keaktifan)) }}</td>
                                    <td>{{ (($bobot_tugas/100)*$value->krs->first()->nilai_tugas) + (($bobot_uts/100)*$value->krs->first()->nilai_uts) + (($bobot_uas/100)*$value->krs->first()->nilai_uas) + (($bobot_keaktifan/100)*$value->krs->first()->nilai_keaktifan) }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
