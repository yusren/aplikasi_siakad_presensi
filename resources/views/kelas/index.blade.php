@extends('layouts.master')

@section('title', 'Kelas')

@section('container')

    <section class="content-header">
        <h1>
            Data Kelas
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{ route('kelas.create') }}" class="btn btn-md bg-green">Tambah</a>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama Kelas</td>
                                    <td>Kode Kelas</td>
                                    <td>Angkatan</td>
                                    <td>Dosen Wali</td>
                                    <td>Prodi</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            @foreach ($kelas as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->code }}</td>
                                    <td>{{ $value->angkatan }}</td>
                                    <td>{{ $value->user->name }}</td>
                                    <td>{{ $value->prodi->name }}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('kelas.edit', $value->id) }}">Edit</a>
                                        <form action="{{ route('kelas.destroy', $value->id) }}" method="post"
                                            style="display: inline;">
                                            @method('delete')
                                            @csrf
                                            <button class="border-0 btn btn-danger" onclick="return confirm('Are you sure?')">Hapus</button>
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
