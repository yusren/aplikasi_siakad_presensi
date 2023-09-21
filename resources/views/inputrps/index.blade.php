@extends('layouts.master')

@section('title', 'Rps')

@section('container')

<section class="content-header">
    <h1>
        Rps
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    @if(session('toast_warning'))
                    <div class="alert alert-warning alert-dismissible">
                        {{ session('toast_warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
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
                                <a class="btn btn-info" href="{{ route('inputrps.show', $value->id) }}">Show</a>
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
