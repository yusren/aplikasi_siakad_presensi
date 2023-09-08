@extends('layouts.master')

@section('title', 'Edit Jawaban')

@section('container')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Jawaban</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('jawaban.update', $jawaban->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Soal</label>
                            <select required class="form-control select2" name="pertanyaan_id"
                                data-placeholder="Pilih Soal" style="width: 100%;">
                                <option value="" selected disabled>Pilih Soal</option>
                                @foreach ($pertanyaans as $value)
                                <option value="{{ $value->id }}" {{ old('pertanyaan_id', $jawaban->pertanyaan_id) == $value->id ? 'selected' : '' }}>
                                    {!! $value->description !!}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Jawaban</label>
                            <textarea name="answer_text" id="answer_text"
                                class="form-control input-sm">{{ old('answer_text', $jawaban->answer_text) }}</textarea>
                            @error('answer_text')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a href="{{ route('jawaban.index', ['pertanyaan_id' => $jawaban->pertanyaan_id]) }}"
                            class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>
@endsection
