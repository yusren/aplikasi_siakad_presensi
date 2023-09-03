@extends('layouts.master')

@section('title', 'User')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data User
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('krs.create') }}" class="btn btn-md bg-green">Tambah</a>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        @foreach ($users as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->name }}</td>
                            <td><a class="btn btn-info" href="{{ route('user.show', $value->id) }}">Show</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
