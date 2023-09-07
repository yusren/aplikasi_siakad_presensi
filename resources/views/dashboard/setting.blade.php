@extends('layouts.master')

@section('title', 'Setting')

@section('container')
<section class="content-header">
    <h1>
        Dashboard Setting
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <form id="form" method="POST" action="{{ route('setting.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="baak">BAAK :</label>
                            <input class="form-control" type="text" name="baak" id="" value="{{ $baak }}">
                        </div>
                        <select class="form-control select2" name="baak_status" id="">
                            <option @if ($baak_status == 'NITK') selected @endif value="NITK">NITK</option>
                            <option @if ($baak_status == 'NIDN') selected @endif value="NIDN">NIDN</option>
                        </select>
                        <div class="form-group">
                            <label for="baak_nomor">Nomor :</label>
                            <input class="form-control" type="text" name="baak_nomor" id="" value="{{ $baak_nomor }}">
                        </div>
                        <div class="form-group">
                            <label for="keuangan">Keuangan :</label>
                            <input class="form-control" type="text" name="keuangan" id="" value="{{ $keuangan }}">
                        </div>
                        <select class="form-control select2" name="keuangan_status" id="">
                            <option @if ($keuangan_status == 'NITK') selected @endif value="NITK">NITK</option>
                            <option @if ($keuangan_status == 'NIDN') selected @endif value="NIDN">NIDN</option>
                        </select>
                        <div class="form-group">
                            <label for="keuangan_nomor">Nomor :</label>
                            <input class="form-control" type="text" name="keuangan_nomor" id="" value="{{ $keuangan_nomor }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
