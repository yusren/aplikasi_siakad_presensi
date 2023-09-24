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
                            <select required class="form-control select2" name="tahun_ajaran_id" data-placeholder="Pilih Tahun Ajaran" style="width: 100%;">
                                @foreach($tahunAjaran as $ta)
                                <option value="{{ $ta->id }}" {{ (request('tahun_ajaran_id')==$ta->id ||
                                    $tahunAjaranAktif->id == $ta->id) ? 'selected' : '' }}>
                                    {{ $ta->name }} - {{ $ta->semester }}. {{ $ta->is_active ? 'aktif' : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select class="form-control select2" name="matakuliah_id" data-placeholder="Pilih Mata Kuliah" style="width: 100%;" id="matakuliah">
                                <option value="" selected disabled>Pilih Mata Kuliah</option>
                                @foreach ($matakuliah as $mk)
                                <option value="{{ $mk->id }}" {{ (request('matakuliah_id') == $mk->id || isset($matakuliahAktif) && $matakuliahAktif->id == $mk->id) ? 'selected' : '' }}>
                                    {{ $mk->code }} - {{ $mk->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('matakuliah_id')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div><!-- /.box-header -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>Kelas</th> <!-- Add this line -->
                                @for ($i = 1; $i <= 16; $i++) <th>Pertemuan {{$i}}</th>
                                    @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendanceData as $data)
                            <tr>
                                @foreach($data as $key => $value)
                                <td>{!! $value !!}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.col -->
            </div>
        </div>
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
