@extends('layouts.master')

@section('title', 'Edit Jadwal')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Jadwal</h3>
                </div>
                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select class="form-control select2" name="tahun_ajaran_id" data-placeholder="Pilih Tahun Ajaran" style="width: 100%;" id="tahun_ajaran">
                                <option value="" selected disabled>Pilih Tahun Ajaran</option>
                                @foreach ($tahunAjaran as $tahun_ajaran)
                                <option value="{{ $tahun_ajaran->id }}" {{ old('tahun_ajaran_id', $jadwal->tahun_ajaran_id)==$tahun_ajaran->id ?
                                    'selected' : '' }}>
                                    {{ $tahun_ajaran->name }}, {{ $tahun_ajaran->semester }} {{ $tahun_ajaran->is_active
                                    ? 'active' : '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('tahun_ajaran_id')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Ruang</label>
                            <select class="form-control select2" name="ruang_id" data-placeholder="Pilih Ruang" style="width: 100%;" id="ruang">
                                <option value="" selected disabled>Pilih Ruang</option>
                                @foreach ($ruangan as $ruang)
                                <option value="{{ $ruang->id }}" {{ old('ruang_id', $jadwal->ruang_id)==$ruang->id ? 'selected' : '' }}>
                                    {{ $ruang->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('ruang_id')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Dosen</label>
                            <select class="form-control select2" name="user_id" data-placeholder="Pilih Dosen" style="width: 100%;" id="user">
                                <option value="" selected disabled>Pilih Dosen</option>
                                @foreach ($dosen as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $jadwal->user_id)==$user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Fakultas</label>
                            <select class="form-control select2" name="fakultas_id" data-placeholder="Pilih Fakultas" style="width: 100%;" id="fakultas">
                                <option value="" selected disabled>Pilih Fakultas</option>
                                @foreach ($fakultas as $fk)
                                <option value="{{ $fk->id }}" {{ old('fakultas_id', $jadwal->fakultas_id)==$fk->id ? 'selected' : '' }}>
                                    {{ $fk->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('fakultas_id')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Prodi</label>
                            <select id="prodi" class="form-control select2" name="prodi_id" data-placeholder="Pilih Prodi" style="width: 100%;"></select>
                            @error('prodi_id') <div class="invalid-feedback text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select id="matakuliah" class="form-control select2" name="matakuliah_id" data-placeholder="Pilih Mata Kuliah" style="width: 100%;"></select>
                            @error('matakuliah_id') <div class="invalid-feedback text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select id="kelas" class="form-control select2" name="kelas_id" data-placeholder="Pilih Kelas" style="width: 100%;"></select>
                            @error('kelas_id') <div class="invalid-feedback text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Waktu/Jam</label>
                            <input type="time" name="jam" id="jam" class="form-input" value="{{ old('jam', $jadwal->jam) }}">
                            @error('jam') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Hari</label>
                            <select class="form-control select2" name="hari" data-placeholder="Pilih Hari" style="width: 100%;" id="fakultas">
                                <option value="" selected disabled>Pilih Hari</option>
                                @foreach ($hari as $h)
                                <option value="{{ $h }}" {{ old('hari', $jadwal->hari)==$h ? 'selected' : '' }}>
                                    {{ $h }}
                                </option>
                                @endforeach
                            </select>
                            @error('hari')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('jadwal.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page-script')
<script>
    $('#prodi').prop('disabled', true);
    $('#matakuliah').prop('disabled', true);
    $('#kelas').prop('disabled', true);
    $('#fakultas').on('change', function() {
        let fakultas_id = $(this).val();
        $.get('/fakultas/' + fakultas_id + '/prodi', function(data) {
            $('#prodi').find('option').remove();
            let defaultOption = $('<option>').val('').text('Pilih Prodi').prop('disabled', true).prop('selected', true);
            $('#prodi').append(defaultOption);
            data.forEach(function(prodi) {
                let option = $('<option>').val(prodi.id).text(prodi.name);
                $('#prodi').append(option);
            });
            $('#prodi').trigger('change.select2');
            $('#prodi').prop('disabled', false);
        });
    });
    $('#prodi').on('change', function() {
        let prodi_id = $(this).val();
        $.get('/prodi/' + prodi_id + '/matakuliah', function(data) {
            $('#matakuliah').find('option').remove();
            let defaultOption = $('<option>').val('').text('Pilih Mata Kuliah').prop('disabled', true).prop('selected', true);
            $('#matakuliah').append(defaultOption);
            data.forEach(function(matakuliah) {
                let option = $('<option>').val(matakuliah.id).text(matakuliah.name);
                $('#matakuliah').append(option);
            });
            $('#matakuliah').trigger('change.select2');
            $('#matakuliah').prop('disabled', false);
        });
        $.get('/prodi/' + prodi_id + '/kelas', function(data) {
            $('#kelas').find('option').remove();
            let defaultOption = $('<option>').val('').text('Pilih Kelas').prop('disabled', true).prop('selected', true);
            $('#kelas').append(defaultOption);
            data.forEach(function(kelas) {
                let option = $('<option>').val(kelas.id).text(kelas.name);
                $('#kelas').append(option);
            });
            $('#kelas').trigger('change.select2');
            $('#kelas').prop('disabled', false);
        });
    });
</script>
@endsection
