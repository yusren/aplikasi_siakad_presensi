@extends('layouts.master')

@section('title', 'Tambah Prodi')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Prodi</h3>
                </div>
                <form action="{{ route('prodi.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Nama Prodi</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                placeholder="Masukkan Nama Prodi">
                            @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Kode Prodi</label>
                            <input type="text" class="form-control" name="code" value="{{ old('code') }}"
                                placeholder="Masukkan Kode Prodi">
                            @error('code') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Fakultas</label>
                            <select required class="form-control select2" name="fakultas_id" data-placeholder="Pilih Fakultas" style="width: 100%;">
                                @foreach ($fakultas as $fk)
                                    <option value="{{ $fk->id }}"
                                        {{ old('fakultas_id') == $fk->id ? 'selected' : '' }}>{{ $fk->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('prodi.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
