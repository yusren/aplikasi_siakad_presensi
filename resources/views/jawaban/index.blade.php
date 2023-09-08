@extends('layouts.master')

@section('title', 'Jawaban')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Jawaban
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah jawaban</h3>
                    @if ($pertanyaan)
                    <h1>{!! $pertanyaan->description !!}</h1>
                    @endif

                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('jawaban.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Soal</label>
                            <select required class="form-control select2" name="pertanyaan_id"
                                data-placeholder="Pilih Soal" style="width: 100%;">
                                <option value="" selected disabled>Pilih Soal</option>
                                @foreach ($pertanyaans as $value)
                                <option value="{{ $value->id }}" @if ($pertanyaan) {{ old('pertanyaan_id', $pertanyaan->id) == $value->id ? 'selected' : '' }} @endif>
                                    {!! $value->description !!}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Jawaban</label>
                            <textarea name="answer_text" id="answer_text"
                                class="form-control input-sm">{{ old('answer_text') }}</textarea>
                            @error('answer_text')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a href="{{ route('angket.show', $pertanyaan->angket->id) }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div><!-- /.box -->
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Kode Soal</td>
                                <td>Jawaban</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach ($jawaban as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->pertanyaan->description }}</td>
                            <td>{{ $value->answer_text }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('jawaban.edit', $value->id) }}">Edit</a>
                                <form action="{{ route('jawaban.destroy', $value->id) }}" method="post"
                                    style="display: inline;">
                                    @method('delete')
                                    @csrf
                                    <button class="border-0 btn btn-danger" onclick="return confirm('Are you sure?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
