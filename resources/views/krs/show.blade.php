@extends('layouts.master')

@section('title', 'KRS')

@section('container')
<h1>KRS Mahasiswa</h1>

<h2>Data Mahasiswa</h2>
<ul>
    <li>Nama: {{ $krs->user->name }}</li>
    <li>NIM: {{ $krs->user->nomor }}</li>
    <li>Prodi: {{ $krs->user->prodi->name }}</li>
</ul>

<h2>Tahun Ajaran</h2>
<p>{{ $krs->tahunAjaran->name }} - {{ $krs->tahunAjaran->semester }}</p>
@endsection
