@extends('layouts.master')

@section('title', 'Tambah Mata Kuliah')

@section('container')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Mata Kuliah</h3>
                    </div>
                    <form action="{{ route('matakuliah.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Nama Mata Kuliah</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Mata Kuliah">
                                @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Kode Mata Kuliah</label>
                                <input type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Masukkan Kode Mata Kuliah">
                                @error('code') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
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
