@extends('layouts.mahasiswa.master')
@section('container')
<!-- welcome user -->
<div class="mb-4 row">
    <div class="col-auto">
        <div class="shadow avatar avatar-50 rounded-10">
            <img src="{{ asset(auth()->user()->photo) }}" alt="">
        </div>
    </div>
    <div class="col align-self-center ps-0">
        <h4 class="text-color-theme"><span class="fw-normal">Hi</span>, {{ auth()->user()->name }}</h4>
        <p class="text-muted">{{ auth()->user()->kelas->first()->name }}</p>
    </div>
</div>
@endsection
