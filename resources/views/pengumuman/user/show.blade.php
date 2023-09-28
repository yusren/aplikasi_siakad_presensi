@extends('layouts.mahasiswa.master')

@section('title', 'Pengumuman')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $pengumuman->judul }}
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
            </div><!-- /.card -->
            <div class="card-body">
                <img class="img-thumbnail" src="{{ asset($pengumuman->cover) }}" alt="">
                <p>{!! $pengumuman->description !!}</p>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
