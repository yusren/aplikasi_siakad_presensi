@extends('layouts.master')

@section('title', 'Edit Prodi')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Prodi</h3>
                </div>
                <form action="{{ route('prodi.update', $prodi->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Prodi</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $prodi->name) }}" placeholder="Masukkan Nama Prodi">
                            @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Kode Prodi</label>
                            <input type="text" class="form-control" name="code" value="{{ old('code', $prodi->code) }}" placeholder="Masukkan Kode Prodi">
                            @error('code') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jenjang</label>
                            <input type="text" class="form-control" name="jenjang" value="{{ old('jenjang', $prodi->jenjang) }}" placeholder="Masukkan Jenjang">
                            @error('jenjang') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Fakultas</label>
                            <select required class="form-control select2" name="fakultas_id" data-placeholder="Pilih Fakultas" style="width: 100%;">
                                @foreach ($fakultas as $fk)
                                    <option value="{{ $fk->id }}"
                                        {{ old('fakultas_id', $prodi->fakultas_id) == $fk->id ? 'selected' : '' }}>{{ $fk->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen/Kapordi</label>
                            <select required class="form-control select2" name="user_id" data-placeholder="Pilih Dosen" style="width: 100%;">
                                @foreach ($dosen as $ds)
                                    <option value="{{ $ds->id }}"
                                        {{ old('user_id', $prodi->user_id) == $ds->id ? 'selected' : '' }}>{{ $ds->name }}
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
