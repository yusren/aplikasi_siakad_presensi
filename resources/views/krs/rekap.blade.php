@extends('layouts.mahasiswa.master')

@section('title', 'Rekap Nilai')

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Rekap Nilai
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="example1" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Dosen</th>
                                <th>Kode</th>
                                <th>Matakuliah</th>
                                <th>SKS</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($krs as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$value->matakuliah->user->name}}</td>
                                <td>{{$value->matakuliah->code}}</td>
                                <td>{{$value->matakuliah->name}}</td>
                                <td>{{$value->matakuliah->sks}}</td>
                                <td>{{$convertScoreToGrade((($bobot_tugas/100)*$value->nilai_tugas)+(($bobot_uts/100)*$value->nilai_uts)+(($bobot_uas/100)*$value->nilai_uas)+(($bobot_keaktifan/100)*$value->nilai_keaktifan))}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@endsection
