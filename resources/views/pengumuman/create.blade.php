@extends('layouts.master')

@section('title', 'Tambah Pengumuman')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Pengumuman</h3>
                </div>
                <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Cover</label>
                            <input type="file" class="form-control" name="cover" value="{{ old('cover') }}" placeholder="Cover">
                            @error('cover') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pengumuman</label>
                            <input type="text" class="form-control" name="judul" value="{{ old('judul') }}" placeholder="Masukkan Nama Pengumuman">
                            @error('judul') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                            @error('description') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <hr />
                        <div class="form-group">
                            <label>Program Users</label>
                            <select class="form-control select2" name="users[]" data-placeholder="Pilih User" style="width: 100%;" multiple>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{$user->nomor }} - {{$user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Program Kelas</label>
                            <select class="form-control select2" name="kelas[]" data-placeholder="Pilih Kelas" style="width: 100%;" multiple>
                                @foreach ($kelas as $kls)
                                <option value="{{ $kls->id }}">
                                    {{$kls->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select class="form-control select2" name="prodi[]" data-placeholder="Pilih Prodi" style="width: 100%;" multiple>
                                @foreach ($prodi as $pr)
                                <option value="{{ $pr->id }}">
                                    {{$pr->code }} - {{$pr->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control select2" name="role[]" data-placeholder="Pilih Role" style="width: 100%;" multiple>
                                @foreach ($roles as $role)
                                <option value="{{ $role }}">
                                    {{$role }}
                                </option>
                                @endforeach
                            </select>
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
