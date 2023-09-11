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
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form id="form" method="POST" action="{{ route('setting.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="baak">BAAK</label>
                                    <input class="form-control" type="text" name="baak" id="" value="{{ $baak }}">
                                </div>
                                <select class="form-control select2" name="baak_status" id="">
                                    <option @if ($baak_status == 'NITK') selected @endif value="NITK">NITK</option>
                                    <option @if ($baak_status == 'NIDN') selected @endif value="NIDN">NIDN</option>
                                </select>
                                <div class="form-group">
                                    <label for="baak_nomor">Nomor</label>
                                    <input class="form-control" type="text" name="baak_nomor" id="" value="{{ $baak_nomor }}">
                                </div>
                                <div class="form-group">
                                    <label for="keuangan">Keuangan</label>
                                    <input class="form-control" type="text" name="keuangan" id="" value="{{ $keuangan }}">
                                </div>
                                <select class="form-control select2" name="keuangan_status" id="">
                                    <option @if ($keuangan_status == 'NITK') selected @endif value="NITK">NITK</option>
                                    <option @if ($keuangan_status == 'NIDN') selected @endif value="NIDN">NIDN</option>
                                </select>
                                <div class="form-group">
                                    <label for="keuangan_nomor">Nomor</label>
                                    <input class="form-control" type="text" name="keuangan_nomor" id="" value="{{ $keuangan_nomor }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bobot_tugas">Bobot Nilai Tugas</label>
                                    <input class="form-control" type="number" name="bobot_tugas" id="" value="{{ $bobot_tugas }}">
                                </div>
                                <div class="form-group">
                                    <label for="bobot_uts">Bobot Nilai UTS</label>
                                    <input class="form-control" type="number" name="bobot_uts" id="" value="{{ $bobot_uts }}">
                                </div>
                                <div class="form-group">
                                    <label for="bobot_uas">Bobot Nilai UAS</label>
                                    <input class="form-control" type="number" name="bobot_uas" id="" value="{{ $bobot_uas }}">
                                </div>
                                <div class="form-group">
                                    <label for="bobot_keaktifan">Bobot Nilai Keaktifan</label>
                                    <input class="form-control" type="number" name="bobot_keaktifan" id="" value="{{ $bobot_keaktifan }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                @foreach ($grade_boundaries as $grade => $boundary)
                                <div class="form-group">
                                    <label for="{{ $grade }}">Batas Minimum Nilai {{ $grade }}</label>
                                    <input class="form-control" type="number" name="{{ $grade }}" id="" value="{{ $boundary }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
