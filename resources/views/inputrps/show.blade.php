@extends('layouts.master')

@section('title', 'Tambah Pertanyaan')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('inputrps.update', $rps->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="box-header">
                        <div class="form-group">
                            <input class="form-control" type="file" name="file">
                        </div>
@if ($hasilRps)
                            <div class="form-group">
                                <a href="{{ asset($hasilRps->file) }}" class="btn btn-sm btn-warning">Download</a>
                            </div>
@endif
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('inputrps.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
