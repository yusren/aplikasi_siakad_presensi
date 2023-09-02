@extends('layouts.master')

@section('title', 'Edit User')

@section('container')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit User</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <img class="img-thumbnail" src="{{ asset($user->photo) }}" alt="" width="200px">
                            <input type="file" class="form-control" name="photo" value="{{ old('photo') }}" placeholder="Masukkan Foto">
                            @error('photo')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan Nama">
                            @error('name')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">NIM</label>
                            <input type="text" class="form-control" name="nim" value="{{ old('nim', $user->nim) }}" placeholder="Masukkan NIM">
                            @error('nim')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">No Telp/WA</label>
                            <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" placeholder="Masukkan No Telp/WA">
                            @error('no_telp')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan Email">
                            @error('email')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Masukkan Password">
                            @error('password')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm-password" value="{{ old('confirm-password') }}" placeholder="Confirm Password">
                            @error('confirm-password')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control select2" name="role" data-placeholder="Pilih Role"
                                style="width: 100%;">
                                <option value="" selected disabled>Pilih Role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control select2" name="jenis_kelamin" data-placeholder="Pilih Jenis Kelamin" style="width: 100%;">
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="laki-laki" @if ($user->jenis_kelamin == 'laki-laki') selected @endif>Laki-Laki</option>
                                <option value="perempuan" @if ($user->jenis_kelamin == 'perempuan') selected @endif>Perempuan</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2" name="status" data-placeholder="Pilih Status"
                                style="width: 100%;">
                                <option value="" selected disabled>Pilih Status</option>
                                <option @if ($user->status == 'active') selected @endif value="active">Aktif</option>
                                <option @if ($user->status == 'non-active') selected @endif value="non-active">Non
                                    Aktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a href="{{ route('user.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>
@endsection
