@extends('layouts.master')

@section('title', 'Edit Kelas')

@section('container')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Kelas</h3>
                    </div>
                    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Kelas</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $kelas->name) }}" placeholder="Masukkan Nama Kelas">
                                @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Kode Kelas</label>
                                <input type="text" class="form-control" name="code" value="{{ old('code', $kelas->code) }}" placeholder="Masukkan Kode Kelas">
                                @error('code') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Angkatan</label>
                                <input type="text" class="form-control" name="angkatan" value="{{ old('angkatan', $kelas->angkatan) }}" placeholder="Masukkan Angkatan">
                                @error('angkatan') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Mahasiswa</label>
                                <select required class="form-control select2" name="mahasiswa[]" data-placeholder="Pilih Mahasiswa" style="width: 100%;" multiple>
                                    @foreach ($mahasiswa as $mhs)
                                        <option @foreach ($kelas->users as $value) @if ($value->id == $mhs->id) selected @endif @endforeach value="{{ $mhs->id }}" {{ old('mahasiswa') == $mhs->id ? 'selected' : '' }}>
                                            {{ $mhs->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Prodi</label>
                                <select required class="form-control select2" name="prodi_id" data-placeholder="Pilih Prodi" style="width: 100%;">
                                    @foreach ($prodi as $pr)
                                        <option value="{{ $pr->id }}"
                                            {{ old('prodi_id', $kelas->prodi_id) == $pr->id ? 'selected' : '' }}>{{ $pr->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group"> --}}
                                {{-- <label>Dosen</label> --}}
                                {{-- <select required class="form-control select2" name="user_id" data-placeholder="Pilih Dosen" style="width: 100%;"> --}}
                                    {{-- @foreach ($dosen as $ds) --}}
                                        {{-- <option value="{{ $ds->id }}" --}}
                                            {{-- {{ old('user_id', $kelas->user_id) == $ds->id ? 'selected' : '' }}>{{ $ds->name }} --}}
                                        {{-- </option> --}}
                                    {{-- @endforeach --}}
                                {{-- </select> --}}
                            {{-- </div> --}}
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('kelas.index') }}" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
