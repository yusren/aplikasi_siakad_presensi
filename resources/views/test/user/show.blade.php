@extends('layouts.mahasiswa.master')

@section('title', 'Isi Angket')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form action="{{ route('test.update', $angket->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body table-responsive">
                        <table id="" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Pertanyaan</td>
                                    <td>Jenis</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            @foreach($angket->pertanyaan as $value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$value->description}}</td>
                                <td>{{$value->type}}</td>
                                <td>
                                    @if(count($value->jawaban)>0)
                                    <ul>
                                        @foreach($value->jawaban as $jawaban)
                                        <li>
                                            <input type="radio" name="{{ $value->id }}" value="{{ $jawaban->id }}" {{ isset($hasilAngket->data_jawaban[$value->id]) && json_decode($hasilAngket->data_jawaban, true)[$value->id] == $jawaban->id ? 'checked' : '' }}>
                                            {{$jawaban->answer_text}}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <textarea name="{{ $value->id }}" cols="30"
                                        rows="10">{{ isset($hasilAngket->data_jawaban[$value->id]) ? json_decode($hasilAngket->data_jawaban, true)[$value->id] : '' }}</textarea>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('test.index', ['kondisi' => $angket->kondisi]) }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
