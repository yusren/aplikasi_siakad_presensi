@extends('layouts.master')

@section('title', 'Dosen')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Dosen
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form action="{{ route('dosen.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><input class="form-control" type="file" name="file" accept=".csv,.xlsx,.xls"></div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Import</button>
                        </div>
                    </form>
                    <a href="{{ route('user.create', ['role'=>'dosen']) }}" class="btn btn-md bg-green">Tambah</a>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Role</td>
                                <td>Satus</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach ($users as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->kelas->first()->name ?? '' }} {{ $value->name }}</td>
                            <td>{{ $value->role }}</td>
                            <td>Registrasi {{ $value->status }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('user.edit', ['user'=>$value->id, 'role'=>'dosen']) }}">Edit</a>
                                <a class="btn btn-info" href="{{ route('user.show', ['user'=>$value->id, 'role'=>'dosen']) }}">Show</a>
                                <form action="{{ route('user.destroy', ['user'=>$value->id, 'role'=>'dosen']) }}"
                                    method="post" style="display: inline;">
                                    @method('delete')
                                    @csrf
                                    <button class="border-0 btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
