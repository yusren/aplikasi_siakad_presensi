@extends('layouts.master')

@section('title', 'Tambah Dosen')

@section('container')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Dosen</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('user.store', ['role'=> 'dosen']) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Foto</label>
                            <input type="file" class="form-control" name="photo" value="{{ old('photo') }}" placeholder="Masukkan Foto">
                            @error('photo')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama">
                            @error('name')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">NIDN</label>
                            <input type="text" class="form-control" name="nomor" value="{{ old('nomor') }}" placeholder="Masukkan NIDN">
                            @error('nomor')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">No Telp/WA</label>
                            <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp') }}" placeholder="Masukkan No Telp/WA">
                            @error('no_telp')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Masukkan Email">
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
                            <select class="form-control select2" name="jenis_kelamin"
                                data-placeholder="Pilih Jenis Kelamin" style="width: 100%;">
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="laki-laki">Laki-Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Status Registrasi</label>
                            <select class="form-control select2" name="status" data-placeholder="Pilih Status" style="width: 100%;">
                                <option value="" selected disabled>Pilih Status</option>
                                <option value="active">Aktif</option>
                                <option value="non-active">Non Aktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Agama</label>
                            <select required class="form-control select2" name="agama" data-placeholder="Pilih Agama" style="width: 100%;">
                                <option value="" selected disabled>Pilih Agama</option>
                                @foreach ($agama as $value)
                                <option value="{{ $value }}" {{ old('agama')==$value ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                            @error('agama')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Masukkan Tempat Lahir">
                            @error('tempat_lahir')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="Masukkan Tanggal Lahir">
                            @error('tanggal_lahir')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select required class="form-control select2" name="prodi_id" data-placeholder="Pilih Prodi" style="width: 100%;">
                                <option value="" selected disabled>Pilih Prodi</option>
                                @foreach ($prodi as $pr)
                                <option value="{{ $pr->id }}" {{ old('prodi_id')==$pr->id ? 'selected' : '' }}>
                                    {{ $pr->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Gelar Akademik</label>
                            <input type="text" class="form-control" name="gelar_akademik" value="{{ old('gelar_akademik') }}" placeholder="Masukkan Gelar Akademik">
                            @error('gelar_akademik')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Jabatan Akademik</label>
                            <select class="form-control select2" name="jabatan_akademik">
                                <option value="">Pilih Jabatan Akademik</option>
                                <option value="Tenaga Pengajar">Tenaga Pengajar</option>
                                <option value="Karyawan">Karyawan</option>
                            </select>
                            @error('jabatan_akademik')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Pendidikan Tinggi</label>
                            <select class="form-control select2" name="pendidikan_tinggi">
                                <option value="">Pilih Pendidikan Tinggi</option>
                                <option value="SD/MI">SD/MI</option>
                                <option value="SLTP/Sederajat">SLTP/Sederajat</option>
                                <option value="SLTA/Sederajat">SLTA/Sederajat</option>
                                <option value="D4/S1">D4/S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                            @error('pendidikan_tinggi')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Status Ikatan Kerja</label>
                            <select class="form-control select2" name="status_ikatan_kerja">
                                <option value="">Pilih Status Ikatan Kerja</option>
                                <option value="Tetap">Tetap</option>
                                <option value="Sementara">Sementara</option>
                            </select>
                            @error('status_ikatan_kerja')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="role" value="dosen">
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat">
                            @error('alamat')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="form-label" for="provinsi">Provinsi</label>
                            <div class="mb-1">
                                <select style="width: 100%;" class="form-select select2" name="provinsi" id="provinsi" required>
                                    <option>==Pilih Salah Satu==</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id ?? '' }}" {{ old('provinsi')==$item->id ? 'selected' : '' }}>{{ $item->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kota">Kabupaten / Kota</label>
                            <div class="mb-1">
                                <select style="width: 100%;" class="form-select select2" name="kota" id="kota" required>
                                    <option>==Pilih Salah Satu==</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kecamatan">Kecamatan</label>
                            <div class="mb-1">
                                <select style="width: 100%;" class="form-select select2" name="kecamatan" id="kecamatan" required>
                                    <option>==Pilih Salah Satu==</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="desa">Desa</label>
                            <div class="mb-1">
                                <select style="width: 100%;" class="form-select select2" name="desa" id="desa" required>
                                    <option>==Pilih Salah Satu==</option>
                                </select>
                            </div>
                        </div>
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
@section('page-script')
<script>
    function onChangeSelect(url, id, name) {
    // send ajax request to get the cities of the selected province and append to the select tag
    $.ajax({
        url: url
        , type: 'GET'
        , data: {
            id: id
        }
        , success: function (data) {
            $('#' + name)
                .empty();
            $('#' + name)
                .append('<option>==Pilih Salah Satu==</option>');

            $.each(data, function (key, value) {
                $('#' + name).append('<option value="' + key + '">' + value + '</option>');
            });
        }
    });
}
$(function () {
    $('#provinsi').on('change', function () {
            onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
        });
    $('#kota').on('change', function () {
            onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
        })
    $('#kecamatan').on('change', function () {
            onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
        })
});
</script>
@endsection
