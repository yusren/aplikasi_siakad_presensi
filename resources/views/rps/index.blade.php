@extends('layouts.master')

@section('title', 'Rps')

@section('container')

<section class="content-header">
    <h1>
        Data Rps
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('rps.create') }}" class="btn btn-md bg-green">Tambah</a>
                </div>
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Rps</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach ($rps as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->name }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('rps.edit', $value->id) }}">Edit</a>
                                <a class="btn btn-info" href="{{ route('rps.show', $value->id) }}">Detail</a>
                                <form action="{{ route('rps.destroy', $value->id) }}" method="post"
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
