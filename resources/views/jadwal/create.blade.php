@extends('layouts.master')

@section('title', 'Tambah Jadwal')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Jadwal</h3>
                </div>
                <form action="{{ route('matakuliah.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Nama Jadwal</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Jadwal">
                            @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Kode Jadwal</label>
                            <input type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Masukkan Kode Jadwal">
                            @error('code') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Fakultas</label>
                            <select class="form-control select2" name="fakultas_id" data-placeholder="Pilih Fakultas" style="width: 100%;" id="fakultas">
                                <option value="" selected disabled>Pilih Fakultas</option>
                                @foreach ($fakultas as $fk)
                                <option value="{{ $fk->id }}" {{ old('fakultas_id')==$fk->id ? 'selected' : '' }}>
                                    {{ $fk->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('fakultas_id')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Prodi</label>
                            <select id="prodi" class="form-control select2" name="prodi_id" data-placeholder="Pilih Prodi" style="width: 100%;">
                            </select>
                            @error('prodi_id') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-default">Kembali</a>
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
    $('#fakultas').on('change', function() {
        let fakultas_id = $(this).val();
        $.get('/fakultas/' + fakultas_id + '/prodi', function(data) {
            $('#prodi').find('option').remove();
            let defaultOption = $('<option>').val('').text('Pilih Kas').prop('disabled', true).prop('selected', true);
            $('#prodi').append(defaultOption);
            data.forEach(function(prodi) {
                let option = $('<option>').val(prodi.id).text(prodi.name);
                $('#prodi').append(option);
            });
            $('#prodi').trigger('change.select2');
            $('#prodi').prop('disabled', false);
        });
    });
</script>
@endsection
