@extends('layouts.master')

@section('title', 'Edit Bimbingan')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Bimbingan</h3>
                </div>
                <form action="{{ route('bimbingan.update', $bimbingan->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Nama Bimbingan</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $bimbingan->name) }}"
                                placeholder="Masukkan Nama Bimbingan">
                            @error('name')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select class="form-control select2" name="tahun_ajaran_id" data-placeholder="Pilih Tahun Ajaran" style="width: 100%;" id="tahun_ajaran">
                                <option value="" selected disabled>Pilih Tahun Ajaran</option>
                                @foreach ($tahunAjaran as $tahun_ajaran)
                                <option value="{{ $tahun_ajaran->id }}" {{ old('tahun_ajaran_id', $bimbingan->tahun_ajaran_id)==$tahun_ajaran->id ? 'selected' : '' }}>
                                    {{ $tahun_ajaran->name }} - {{ $tahun_ajaran->semester }}. {{ $tahun_ajaran->is_active ? 'active' : '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('tahun_ajaran_id')
                            <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('bimbingan.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
