@extends('layouts.master')

@section('title', 'Edit Admin')

@section('container')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Admin</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $admin->name) }}" placeholder="Masukkan Nama">
                                @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username" value="{{ old('username', $admin->username) }}" placeholder="Masukkan Username">
                                @error('username') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $admin->email) }}" placeholder="Masukkan Email">
                                @error('email') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                                    placeholder="Masukkan Password">
                                @error('password') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm-password" value="{{ old('confirm-password') }}" placeholder="Confirm Password">
                                @error('confirm-password') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control select2" name="role" data-placeholder="Pilih Role" style="width: 100%;">
                                    <option value="" selected disabled>Pilih Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            {{ old('role', $admin->role) == $role ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2" name="status" data-placeholder="Pilih Status" style="width: 100%;">
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option @if ($admin->status == 'active') selected @endif value="active">Aktif</option>
                                    <option @if ($admin->status == 'non-active') selected @endif value="non-active">Non Aktif</option>
                                </select>
                                @error('status') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Program Studi</label>
                                <select required class="form-control select2" name="prodi_id" data-placeholder="Pilih Prodi" style="width: 100%;">
                                    <option value="" selected disabled>Pilih Prodi</option>
                                    @foreach ($prodi as $pr)
                                    <option value="{{ $pr->id }}" {{ old('prodi_id', $admin->prodi_id)==$pr->id ? 'selected' : '' }}>
                                        {{$pr->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <a href="{{ route('admin.index') }}" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
