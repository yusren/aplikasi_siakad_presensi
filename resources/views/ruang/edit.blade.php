@extends('layouts.master')

@section('title', 'Edit Ruang')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Ruang</h3>
                </div>
                <form action="{{ route('ruang.update', $ruang->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ruang</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $ruang->name) }}" placeholder="Masukkan Nama Ruang">
                            @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Kode Ruang</label>
                            <input type="text" class="form-control" name="code"
                                value="{{ old('code', $ruang->code) }}" placeholder="Masukkan Kode Ruang">
                            @error('code') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ route('ruang.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
