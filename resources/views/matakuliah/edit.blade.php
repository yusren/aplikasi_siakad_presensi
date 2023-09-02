@extends('layouts.master')

@section('title', 'Edit Mata Kuliah')

@section('container')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Mata Kuliah</h3>
                    </div>
                    <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Mata Kuliah</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $matakuliah->name) }}" placeholder="Masukkan Nama Mata Kuliah">
                                @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Kode Mata Kuliah</label>
                                <input type="text" class="form-control" name="code" value="{{ old('code', $matakuliah->code) }}" placeholder="Masukkan Kode Mata Kuliah">
                                @error('code') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">SKS</label>
                                <input type="text" class="form-control" name="sks" value="{{ old('sks', $matakuliah->sks) }}" placeholder="Masukkan SKS">
                                @error('sks') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Semester</label>
                                <input type="text" class="form-control" name="semester" value="{{ old('semester', $matakuliah->semester) }}" placeholder="Masukkan Semester">
                                @error('semester') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Prodi</label>
                                <select required class="form-control select2" name="prodi_id" data-placeholder="Pilih Prodi" style="width: 100%;">
                                    @foreach ($prodi as $pr)
                                        <option value="{{ $pr->id }}"
                                            {{ old('prodi_id', $matakuliah->prodi_id) == $pr->id ? 'selected' : '' }}>{{ $pr->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select required class="form-control select2" name="kategori" data-placeholder="Pilih Kategori" style="width: 100%;">
                                    <option @if($matakuliah->kategori == 'wajib') selected @endif value="wajib">Wajib</option>
                                    <option @if($matakuliah->kategori == 'pilihan') selected @endif value="pilihan">Pilihan</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('matakuliah.index', $matakuliah->index) }}" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
