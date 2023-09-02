@extends('layouts.master')

@section('title', 'Jadwal')

@section('container')

<section class="content-header">
    <h1>
        Data Jadwal
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('jadwal.create') }}" class="btn btn-md bg-green">Tambah</a>
                </div>
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Fakultas</td>
                                <td>Prodi</td>
                                <td>Mata Kuliah</td>
                                <td>Ruang</td>
                                <td>Hari</td>
                                <td>Jam</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach ($jadwal as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->prodi->fakultas->name }}</td>
                            <td>{{ $value->prodi->name }}</td>
                            <td>{{ $value->matakuliah->name }}</td>
                            <td>{{ $value->ruang->name }}</td>
                            <td>{{ $value->hari }}</td>
                            <td>{{ $value->jam }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('jadwal.edit', $value->id) }}">Edit</a>
                                <form action="{{ route('jadwal.destroy', $value->id) }}" method="post"
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
