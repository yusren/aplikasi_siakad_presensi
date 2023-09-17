@extends('layouts.mahasiswa.master')

@section('title', 'Edit Mahasiswa')

@section('container')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Edit Mahasiswa</h3>
                </div><!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('user.update', ['user' => $user->id, 'role' => 'mahasiswa']) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Foto</label>
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
                            <label for="">{{ $user->role == 'mahasiswa' ? 'NIM' : 'Nomor Karyawan' }}</label>
                            <input type="text" class="form-control" name="nomor" value="{{ old('nomor', $user->nomor) }}" placeholder="Masukkan Nomor">
                            @error('nomor')
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
                            <label>Status Registrasi</label>
                            <select @if (auth()->user()->role == 'mahasiswa') ? disabled : required @endif class="form-control select2" name="status" data-placeholder="Pilih Status" style="width: 100%;">
                                <option value="" selected disabled>Pilih Status</option>
                                <option @if ($user->status == 'active') selected @endif value="active">Aktif</option>
                                <option @if ($user->status == 'non-active') selected @endif value="non-active">Non Aktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $user->alamat) }}" placeholder="Masukkan Alamat">
                            @error('alamat')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <select required class="form-control select2" name="agama" data-placeholder="Pilih Agama" style="width: 100%;">
                                @foreach ($agama as $value)
                                <option value="{{ $value }}" {{ old('agama', $user->agama) == $value ? 'selected' : '' }}>{{ $value }} </option>
                                @endforeach
                            </select>
                            @error('agama')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir', $user->tempat_lahir) }}" placeholder="Masukkan Tempat Lahir">
                            @error('tempat_lahir')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" placeholder="Masukkan Tanggal Lahir">
                            @error('tanggal_lahir')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Dosen Pembimbing Akademik</label>
                            <select @if (auth()->user()->role == 'mahasiswa') ? disabled : required @endif class="form-control select2" name="user_id" data-placeholder="Pilih Dosen" style="width: 100%;">
                                <option value="" selected disabled>Pilih Dosen PA</option>
                                @foreach ($dosen as $ds)
                                    <option value="{{ $ds->id }}" {{ old('user_id', $user->user_id) == $ds->id ? 'selected' : '' }}>{{ $ds->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" class="form-control" name="ayah" value="{{ $user->keluarga->ayah ?? '-' }}">
                        </div>
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" class="form-control" name="ibu" value="{{ $user->keluarga->ibu ?? '-' }}">
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan Ayah</label>
                            <input type="text" class="form-control" name="pekerjaan_ayah" value="{{ $user->keluarga->pekerjaan_ayah ?? '-' }}">
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan Ibu</label>
                            <input type="text" class="form-control" name="pekerjaan_ibu" value="{{ $user->keluarga->pekerjaan_ibu ?? '-' }}">
                        </div>
                        <div class="form-group">
                            <label>Penghasilan Ayah</label>
                            <input type="text" class="form-control" name="penghasilan_ayah" value="{{ $user->keluarga->penghasilan_ayah ?? '-' }}">
                        </div>
                        <div class="form-group">
                            <label>Penghasilan Ibu</label>
                            <input type="text" class="form-control" name="penghasilan_ibu" value="{{ $user->keluarga->penghasilan_ibu ?? '-' }}">
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select @if (auth()->user()->role == 'mahasiswa') ? disabled : required @endif class="form-control select2" name="prodi_id" data-placeholder="Pilih Prodi" style="width: 100%;">
                                @foreach ($prodi as $pr)
                                <option value="{{ $pr->id }}" {{ old('prodi_id', $user->prodi_id) == $pr->id ? 'selected' : '' }}>{{ $pr->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="prodi_id" value="{{ $user->prodi_id }}">
                        <input type="hidden" name="status" value="{{ $user->status }}">
                        <input type="hidden" name="role" value="mahasiswa">
                    </div><!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('user.index', ['role' => 'mahasiswa']) }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div><!-- /.card -->
        </div>
    </div>
</section>
@endsection
