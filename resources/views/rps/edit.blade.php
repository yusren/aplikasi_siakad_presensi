@extends('layouts.master')

@section('title', 'Edit Rps')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Rps</h3>
                </div>
                <form action="{{ route('rps.update', $rp->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Rps</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $rp->name) }}" placeholder="Masukkan Nama Rps">
                            @error('name') <div class="invalid-feedback text-danger"> {{ $message }} </div> @enderror
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ route('rps.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
