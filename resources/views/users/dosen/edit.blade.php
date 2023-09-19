@extends('layouts.master')

@section('title', 'Edit Dosen')

@section('container')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Dosen</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('user.update', ['user' => $user->id, 'role' => 'dosen']) }}" method="POST"
                    enctype="multipart/form-data">
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
                            <label for="">Nomor Karyawan</label>
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
                            @error('jenis_kelamin')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Status Registrasi</label>
                            <select @if (auth()->user()->role == 'dosen') ? disabled : required @endif class="form-control select2" name="status" data-placeholder="Pilih Status" style="width: 100%;">
                                <option value="" selected disabled>Pilih Status</option>
                                <option @if ($user->status == 'active') selected @endif value="active">Aktif</option>
                                <option @if ($user->status == 'non-active') selected @endif value="non-active">Non Aktif
                                </option>
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
                            <label>Program Studi</label>
                            <select required class="form-control select2" name="prodi_id" data-placeholder="Pilih Prodi" style="width: 100%;">
                                @foreach ($prodi as $pr)
                                <option value="{{ $pr->id }}" {{ old('prodi_id', $user->prodi_id) == $pr->id ?
                                    'selected' : '' }}>{{ $pr->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Gelar Akademik</label>
                            <input type="text" class="form-control" name="gelar_akademik" value="{{ old('gelar_akademik', $user->gelar_akademik) }}" placeholder="Masukkan Gelar Akademik">
                            @error('gelar_akademik')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Jabatan Akademik</label>
                            <select class="form-control select2" name="jabatan_akademik">
                                <option value="">Pilih Jabatan Akademik</option>
                                <option {{ $user->jabatan_akademik == 'Tenaga Pengajar' ? 'selected' : '' }} value="Tenaga Pengajar">Tenaga Pengajar</option>
                                <option {{ $user->jabatan_akademik == 'Karyawan' ? 'selected' : '' }} value="Karyawan">Karyawan</option>
                            </select>
                            @error('jabatan_akademik')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Pendidikan Tinggi</label>
                            <select class="form-control select2" name="pendidikan_tinggi">
                                <option value="">Pilih Pendidikan Tinggi</option>
                                <option {{ $user->pendidikan_tinggi == 'SD/MI' ? 'selected' : '' }} value="SD/MI">SD/MI</option>
                                <option {{ $user->pendidikan_tinggi == 'SLTP/Sederajat' ? 'selected' : '' }} value="SLTP/Sederajat">SLTP/Sederajat</option>
                                <option {{ $user->pendidikan_tinggi == 'SLTA/Sederajat' ? 'selected' : '' }} value="SLTA/Sederajat">SLTA/Sederajat</option>
                                <option {{ $user->pendidikan_tinggi == 'D4/S1' ? 'selected' : '' }} value="D4/S1">D4/S1</option>
                                <option {{ $user->pendidikan_tinggi == 'S2' ? 'selected' : '' }} value="S2">S2</option>
                                <option {{ $user->pendidikan_tinggi == 'S3' ? 'selected' : '' }} value="S3">S3</option>
                            </select>
                            @error('pendidikan_tinggi')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Status Ikatan Kerja</label>
                            <select class="form-control select2" name="status_ikatan_kerja">
                                <option value="">Pilih Status Ikatan Kerja</option>
                                <option {{ $user->status_ikatan_kerja == 'Tetap' ? 'selected' : '' }} value="Tetap">Tetap</option>
                                <option {{ $user->status_ikatan_kerja == 'Sementara' ? 'selected' : '' }} value="Sementara">Sementara</option>
                            </select>
                            @error('status_ikatan_kerja')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="role" value="dosen">
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a href="{{ route('user.index', ['role' => 'dosen']) }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>
@endsection
