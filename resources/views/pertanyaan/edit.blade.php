@extends('layouts.master')

@section('title', 'Edit Pertanyaan')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Pertanyaan</h3>
                </div>
                <form action="{{ route('pertanyaan.update', $pertanyaan->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Pertanyaan</label>
                            <input type="hidden" name="angket_id" value="{{ $pertanyaan->angket_id }}">
                            <textarea class="form-control" name="description">{{ old('description', $pertanyaan->description) }}</textarea>
                            @error('description') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
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
