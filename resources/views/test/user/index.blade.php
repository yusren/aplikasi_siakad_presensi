@extends('layouts.mahasiswa.master')

@section('title', 'Angket')

@section('container')

<section class="content-header">
    <h1>
        Angket
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    @if(session('toast_warning'))
                    <div class="alert alert-warning alert-dismissible">
                        {{ session('toast_warning') }}
                    </div>
                    @endif
                </div>
                <div class="card-body table-responsive">
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
                                <a class="btn btn-info" href="{{ route('test.show', $value->id) }}">Show</a>
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
