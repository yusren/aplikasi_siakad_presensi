@extends('layouts.master')

@section('title', 'Tambah Angket')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Angket</h3>
                </div>
                <form action="{{ route('angket.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Nama Angket</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Angket">
                            @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tujuan Angket</label>
                            <input type="text" class="form-control" name="tujuan" value="{{ old('tujuan') }}" placeholder="Masukkan Tujuan Angket">
                            @error('tujuan') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Mulai Dari</label>
                            <input type="datetime-local" class="form-control" name="start_at" value="{{ old('start_at') }}" placeholder="Masukkan Tujuan Angket">
                            @error('start_at') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Berakhir</label>
                            <input type="datetime-local" class="form-control" name="end_at" value="{{ old('end_at') }}" placeholder="Masukkan Tujuan Angket">
                            @error('end_at') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Kondisi</label>
                            <select required class="form-control select2" name="kondisi" data-placeholder="Pilih Kondisi" style="width: 100%;">
                                <option value="sebelum_entri_krs" selected>sebelum_entri_krs</option>
                                <option value="sebelum_lihat_nilai" selected>sebelum_lihat_nilai</option>
                                <option value="setelah_login">setelah_login</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select class="form-control select2" name="matakuliah_id" data-placeholder="Pilih Tahun Mata Kuliah" style="width: 100%;">
                                <option value="" selected disabled>Pilih Mata Kuliah</option>
                                @foreach ($matakuliah as $mk)
                                <option value="{{ $mk->id }}" {{ old('matakuliah_id')==$mk->id ? 'selected' : '' }}>
                                    {{ $mk->code }} {{ $mk->name }} - {{ $mk->prodi->name }} {{ $mk->user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('angket.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
