@extends('layouts.master')

@section('title', 'Tambah Pertemuan')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Pertemuan</h3>
                    {{ $jadwal->kelas->name }} {{ $jadwal->ruang->name }}
                </div>
                <form action="{{ route('pertemuan.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Nama Pertemuan</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $nama) }}" placeholder="Masukkan Nama Pertemuan">
                            @error('name')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Topik</label>
                            <input type="text" class="form-control" name="topic" value="{{ old('topic') }}" placeholder="Masukkan Topik">
                            @error('topic')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Sub Topik</label>
                            <input type="text" class="form-control" name="sub_topic" value="{{ old('sub_topic') }}" placeholder="Masukkan Sub Topik">
                            @error('sub_topic')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Dosen Pengganti</label>
                            <input type="text" class="form-control" name="dosen_pengganti" value="{{ old('dosen_pengganti') }}" placeholder="Masukkan Dosen Pengganti">
                            @error('dosen_pengganti')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
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
