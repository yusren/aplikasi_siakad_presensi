@extends('layouts.master')

@section('title', 'Ruang')

@section('container')

<section class="content-header">
    <h1>
        Data Ruang
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('ruang.create') }}" class="btn btn-md bg-green">Tambah</a>
                </div>
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Ruang</td>
                                <td>Kode Ruang</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach ($ruang as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->code }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('ruang.edit', $value->id) }}">Edit</a>
                                <form action="{{ route('ruang.destroy', $value->id) }}" method="post"
                                    style="display: inline;">
                                    @method('delete')
                                    @csrf
                                    <button class="border-0 btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Hapus</button>
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
