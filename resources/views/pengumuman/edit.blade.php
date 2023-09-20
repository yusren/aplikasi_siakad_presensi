@extends('layouts.master')

@section('title', 'Edit Pengumuman')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Pengumuman</h3>
                </div>
                <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Nama Pengumuman</label>
                            <input type="text" class="form-control" name="judul" value="{{ old('judul', $pengumuman->judul) }}" placeholder="Masukkan Nama Pengumuman">
                            @error('judul') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $pengumuman->description }}</textarea>
                            @error('description') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="mahasiswa" value="mahasiswa" @if($pengumuman->role == 'mahasiswa') checked @endif>
                            <label class="form-check-label" for="mahasiswa">
                                mahasiswa
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="non-mahasiswa" value="non-mahasiswa" @if($pengumuman->role == 'non-mahasiswa') checked @endif>
                            <label class="form-check-label" for="non-mahasiswa">
                                Selain Mahasiswa
                            </label>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('pengumuman.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
