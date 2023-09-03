@extends('layouts.master')

@section('title', 'Tambah KRS')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah KRS</h3>
                </div>
                <form action="{{ route('krs.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Prodi</label>
                            <select required class="form-control select2" name="prodi_id" data-placeholder="Pilih Prodi" style="width: 100%;">
                                @foreach ($prodi as $prod)
                                <option value="{{ $prod->id }}" {{ old('prodi_id')==$prod->id ? 'selected' : '' }}>{{ $prod->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select required class="form-control select2" name="tahun_ajaran_id" data-placeholder="Pilih Tahun Ajaran" style="width: 100%;">
                                @foreach ($tahunAjaran as $ta)
                                <option value="{{ $ta->id }}" {{ old('tahun_ajaran_id')==$ta->id ? 'selected' : '' }}>
                                    {{ $ta->name }}, {{ $ta->semester }} {{ $ta->is_active ? 'active' : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select required class="form-control select2" name="matakuliah[]" data-placeholder="Pilih Tahun Mata Kuliah" style="width: 100%;" multiple>
                                @foreach ($matakuliah as $mk)
                                <option value="{{ $mk->id }}" >
                                    {{ $mk->name }} {{ $mk->prodi->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('krs.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
