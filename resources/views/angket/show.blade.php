@extends('layouts.master')

@section('title', 'Tambah Pertanyaan')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Pertanyaan</h3>
                </div>
                <form action="{{ route('pertanyaan.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Nama Angket</label>
                            <input type="hidden" name="angket_id" value="{{ $angket->id }}">
                            <input type="text" class="form-control" name="name" value="{{ old('name', $angket->name) }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Pertanyaan</label>
                            <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tipe Soal</label>
                            <select required class="form-control select2" name="type" data-placeholder="Pilih Tipe" style="width: 100%;">
                                <option value="" selected disabled>Pilih Tipe</option>
                                <option value="multiple_choice">Pilihan Ganda</option>
                                <option value="essay">Essay</option>
                            </select>
                        </div>
                        <div class="form-group">
                            {{ $angket->kondisi }}
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('angket.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Pertanyaan</td>
                                <td>Jenis</td>
                                <td>Banyak Jawaban</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach ($pertanyaan as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ $value->type }}</td>
                            <td>{{ $value->jawaban->count() }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('pertanyaan.edit', $value->id) }}">Edit</a>
                                <a class="btn btn-info" href="{{ route('jawaban.index', ['pertanyaan_id' => $value->id]) }}">Tambah Jawaban</a>
                                <form action="{{ route('pertanyaan.destroy', $value->id) }}" method="post"
                                    style="display: inline;">
                                    @method('delete')
                                    @csrf
                                    <button class="border-0 btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
