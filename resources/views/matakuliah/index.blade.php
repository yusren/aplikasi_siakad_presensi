@extends('layouts.master')

@section('title', 'Mata Kuliah')

@section('container')

    <section class="content-header">
        <h1>
            Data Mata Kuliah
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    @if (auth()->user()->role != 'dosen')
                    <div class="box-header">
                        <form action="{{ route('matakuliah.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group"><input class="form-control" type="file" name="file" accept=".csv,.xlsx,.xls"></div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary" type="submit">Import</button>
                            </div>
                        </form>
                        <a href="{{ route('matakuliah.create') }}" class="btn btn-md bg-green">Tambah</a>
                    </div>
                    @endif
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    @if (auth()->user()->role != 'dosen')
                                        <td>Dosen</td>
                                    @endif
                                    <td>Nama Mata Kuliah</td>
                                    <td>Kode Mata Kuliah</td>
                                    <td>SKS</td>
                                    <td>Kategori</td>
                                    <td>Semester</td>
                                    <td>Prodi</td>
                                    <td>Fakultas</td>
                                    @if (auth()->user()->role != 'dosen')
                                    <td>Aksi</td>
                                    @endif
                                </tr>
                            </thead>
                            @foreach ($matakuliah as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @if (auth()->user()->role != 'dosen')
                                    <td>{{ $value->user->name }}</td>
                                    @endif
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->code }}</td>
                                    <td>{{ $value->sks }}</td>
                                    <td>{{ $value->kategori }}</td>
                                    <td>{{ $value->semester }}</td>
                                    <td>{{ $value->prodi->name }}</td>
                                    <td>{{ $value->prodi->fakultas->name }}</td>
                                    @if (auth()->user()->role != 'dosen')
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('matakuliah.edit', $value->id) }}">Edit</a>
                                        <form action="{{ route('matakuliah.destroy', $value->id) }}" method="post"
                                            style="display: inline;">
                                            @method('delete')
                                            @csrf
                                            <button class="border-0 btn btn-danger" onclick="return confirm('Are you sure?')">Hapus</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
