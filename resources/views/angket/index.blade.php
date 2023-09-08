@extends('layouts.master')

@section('title', 'Angket')

@section('container')

<section class="content-header">
    <h1>
        Data Angket
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('angket.create') }}" class="btn btn-md bg-green">Tambah</a>
                </div>
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Angket</td>
                                <td>Tujuan Angket</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach ($angket as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->tujuan }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('angket.edit', $value->id) }}">Edit</a>
                                <a class="btn btn-info" href="{{ route('angket.show', $value->id) }}">Show</a>
                                <form action="{{ route('angket.destroy', $value->id) }}" method="post"
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
