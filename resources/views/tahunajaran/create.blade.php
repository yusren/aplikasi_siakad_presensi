@extends('layouts.master')

@section('title', 'Tambah Tahun Ajaran')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Tahun Ajaran</h3>
                </div>
                <form action="{{ route('tahunajaran.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Nama Tahun Ajaran</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Tahun Ajaran">
                            @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <select required class="form-control select2" name="semester" data-placeholder="Pilih Semester" style="width: 100%;">
                                <option value="ganjil" selected>Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('tahunajaran.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
