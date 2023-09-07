@extends('layouts.master')

@section('title', 'Detail Pertemuan')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Pertemuan</h3>
                    {{ $pertemuan->jadwal->kelas->name }} {{ $pertemuan->jadwal->ruang->name }}
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Nama Pertemuan</label>
                        <input readonly type="text" class="form-control" name="name" value="{{ old('name', $pertemuan->name) }}">
                        @error('name')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Topik</label>
                        <input readonly type="text" class="form-control" name="topic" value="{{ old('topic', $pertemuan->topic) }}">
                        @error('topic')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Sub Topik</label>
                        <input readonly type="text" class="form-control" name="sub_topic" value="{{ old('sub_topic', $pertemuan->sub_topic) }}">
                        @error('sub_topic')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Dosen Pengganti</label>
                        <input readonly type="text" class="form-control" name="dosen_pengganti" value="{{ old('dosen_pengganti', $pertemuan->dosen_pengganti) }}">
                        @error('dosen_pengganti')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr />
                    <form action="{{ route('presensi.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">NIM</label>
                            <input type="hidden" name="pertemuan_id" value="{{ $pertemuan->id }}">
                            <input type="text" class="form-control" name="nim" value="{{ old('nim') }}" autofocus>
                            @error('nim')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jam</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($records as $record)
                            <tr>
                                <td>{{$record['nomor']}}</td>
                                <td>{{$record['name']}}</td>
                                <td>{{optional($record['created_at'])->format('h:i:s')}}</td>
                                <td>
                                    @if($record['id'])
                                    <form action="{{ route('presensi.destroy', $record['id']) }}" method="post"
                                        style="display: inline;">
                                        @method('delete')
                                        @csrf
                                        <button class="border-0 btn btn-danger" onclick="return confirm('Are you sure?')">Hapus</button>
                                    </form>
                                    @else
                                    <a class="btn btn-success" href="#">Absen</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('jadwal.index') }}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
