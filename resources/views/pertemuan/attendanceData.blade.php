@extends('layouts.master')

@section('title', 'Pertemuan')

@section('container')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                @foreach($pertemuan as $p)
                                <th>Pertemuan {{$p->id}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendanceData as $data)
                            <tr>
                                @foreach($data as $key => $value)
                                <td>{{$value}}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.col -->
            </div>
        </div>
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
