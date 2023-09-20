@extends('layouts.mahasiswa.master')

@section('title', 'Upload Tugas')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Upload Tugas
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Pertemuan</label>
                        <input readonly type="text" class="form-control" name="name" value="{{ old('name', $pertemuan->name) }}">
                        @error('name')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Topik</label>
                        <input readonly type="text" class="form-control" name="topic" value="{{ old('topic', $pertemuan->topic) }}">
                        @error('topic')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Sub Topik</label>
                        <input readonly type="text" class="form-control" name="sub_topic" value="{{ old('sub_topic', $pertemuan->sub_topic) }}">
                        @error('sub_topic')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Dosen Pengganti</label>
                        <input readonly type="text" class="form-control" name="dosen_pengganti" value="{{ old('dosen_pengganti', $pertemuan->dosen_pengganti) }}">
                        @error('dosen_pengganti')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr />
                    <form action="{{ route('pertemuan.uploadtugas') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-1 form-goup">
                            <input type="hidden" class="form-control" name="pertemuan_id" value="{{ $pertemuan->id }}">
                            <input type="file" class="form-control" name="file">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
