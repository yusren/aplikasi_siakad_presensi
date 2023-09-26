@extends('layouts.master')

@section('title', 'Edit Angket')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Angket</h3>
                </div>
                <form action="{{ route('angket.update', $angket->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Nama Angket</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $angket->name) }}" placeholder="Masukkan Nama Angket">
                            @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Mulai Dari</label>
                            <input type="datetime-local" class="form-control" name="start_at" value="{{ old('start_at', $angket->start_at) }}" placeholder="Masukkan Tujuan Angket">
                            @error('start_at') <div class="invalid-feedback text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Berakhir</label>
                            <input type="datetime-local" class="form-control" name="end_at" value="{{ old('end_at', $angket->end_at) }}" placeholder="Masukkan Tujuan Angket">
                            @error('end_at') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Kondisi</label>
                            <select required class="form-control select2" name="kondisi" data-placeholder="Pilih Kondisi" style="width: 100%;">
                                <option value="" selected disabled>Pilih</option>
                                <option @if ($angket->kondisi == 'sebelum_entri_krs') selected @endif value="sebelum_entri_krs" selected>sebelum_entri_krs</option>
                                <option @if ($angket->kondisi == 'sebelum_lihat_nilai') selected @endif value="sebelum_lihat_nilai" selected>sebelum_lihat_nilai</option>
                                <option @if ($angket->kondisi == 'setelah_login') selected @endif value="setelah_login">setelah_login</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tujuan Angket</label>
                            <select class="form-control select2" name="tujuan" data-placeholder="Pilih Tujuan Angket" style="width: 100%;">
                                <option value="" selected disabled>Pilih Tujuan Angket</option>
                                @foreach ($pilihan as $tujuan)
                                <option value="{{ $tujuan }}" {{ old('tujuan')==$tujuan ? 'selected' : '' }}>
                                    {{ $tujuan }}
                                </option>
                                @endforeach
                            </select>
                            @error('tujuan') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group" id="matakuliah">
                            <label>Mata Kuliah</label>
                            <select class="form-control select2" name="matakuliah[]" data-placeholder="Pilih Mata Kuliah" style="width: 100%;" multiple>
                                @foreach ($matakuliah as $mk)
                                <option value="{{ $mk->id }}" {{ old('matakuliah')==$mk->id ? 'selected' : '' }}>
                                    {{ $mk->code }} {{ $mk->name }} - {{ $mk->prodi->name }} {{ $mk->user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="prodi">
                            <label>Program Studi</label>
                            <select class="form-control select2" name="prodi" data-placeholder="Pilih Prodi" style="width: 100%;" multiple>
                                @foreach ($prodi as $pr)
                                    <option value="{{ $pr->id }}" {{ old('prodi') == $pr->id ? 'selected' : '' }}>{{ $pr->name }}</option>
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
