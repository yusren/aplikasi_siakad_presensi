@extends('layouts.master')

@section('title', 'Tambah KRS')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah KRS</h3>
                </div>
                <form action="{{ route('krs.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Prodi</label>
                            <select required class="form-control select2" name="prodi_id" data-placeholder="Pilih Prodi" style="width: 100%;" id="prodi">
                                @foreach ($prodi as $prod)
                                <option value="{{ $prod->id }}" {{ old('prodi_id')==$prod->id ? 'selected' : '' }}>{{ $prod->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select id="kelas" class="form-control select2" name="kelas_id" data-placeholder="Pilih Kelas" style="width: 100%;"></select>
                            @error('kelas_id') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select required class="form-control select2" name="tahun_ajaran_id" data-placeholder="Pilih Tahun Ajaran" style="width: 100%;">
                                @foreach ($tahunAjaran as $ta)
                                <option value="{{ $ta->id }}" {{ old('tahun_ajaran_id')==$ta->id ? 'selected' : '' }}>
                                    {{ $ta->name }} - {{ $ta->semester }}. {{ $ta->is_active ? 'active' : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Semester</label>
                            <input type="text" class="form-control" name="semester" value="{{ old('semester') }}" placeholder="Masukkan Semester">
                            @error('semester') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Matakuliah</label>
                            <select required class="form-control select2" name="matakuliah[]" data-placeholder="Pilih Matakuliah" style="width: 100%;" multiple>
                                @foreach ($matakuliah as $mk)
                                <option value="{{ $mk->id }}">
                                    {{ $mk->code }} - {{ $mk->name }} - {{ $mk->user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group"> --}}
                            {{-- <label>Mata Kuliah</label> --}}
                            {{-- <select required class="form-control select2" name="matakuliah[]" data-placeholder="Pilih Mata Kuliah" style="width: 100%;" multiple id="matakuliah"> --}}
                                {{-- <option value="" selected disabled>Pilih Mata Kuliah</option> --}}
                            {{-- </select> --}}
                        {{-- </div> --}}
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('krs.index') }}" class="btn btn-default">Kembali</a>
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
    $('#matakuliah').prop('disabled', true);
    $('#kelas').prop('disabled', true);
    $('#prodi').on('change', function() {
        let prodi_id = $(this).val();
        $.get('/prodi/' + prodi_id + '/matakuliah', function(data) {
            $('#matakuliah').find('option').remove();
            // let defaultOption = $('<option>').val('').text('Pilih Mata Kuliah').prop('disabled', true).prop('selected', true);
            // $('#matakuliah').append(defaultOption);
            data.forEach(function(matakuliah) {
                let option = $('<option>').val(matakuliah.id).text(matakuliah.name+'-'+matakuliah.code+'-'+matakuliah.prodi.name+'-'+matakuliah.user.name);
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
