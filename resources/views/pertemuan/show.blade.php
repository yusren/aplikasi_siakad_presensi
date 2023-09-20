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
                        <div class=" form-group">
                            <label for="">NIM</label>
                            <input type="hidden" name="pertemuan_id" value="{{ $pertemuan->id }}">
                            <input type="text" class="form-control" name="nim" value="{{ old('nim') }}" autofocus>
                            @error('nim')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    <hr />
                    <div class="table-responsive">
                        <table id="" class="table table-bordered table-striped">
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jam</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($records as $record)
                            <tr>
                                <td><input type="checkbox" name="selectedNomor[]" value="{{$record['nomor']}}"></td>
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
                                    <form action="{{ route('presensi.store') }}" method="post" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="pertemuan_id" value="{{ $pertemuan->id }}">
                                        <input type="hidden" class="form-control" name="nim" value="{{ old('nim', $record['nomor']) }}">
                                        <button type="submit" class="btn btn-success">absen</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('jadwal.index.detailpertemuan', ['matakuliah' => $pertemuan->jadwal->matakuliah_id, 'kelas' => $pertemuan->jadwal->kelas_id, 'tahun_ajaran_id' => $pertemuan->jadwal->tahun_ajaran_id ]) }}" class="btn btn-default">Kembali</a>
                    <button id="submitStoreBulkForm" type="button" class="btn btn-success">Absen</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page-script')
<script>
$(document).ready(function() {
    var $submitBtn = $('#submitStoreBulkForm');
    var $checkboxes = $('input[name="selectedNomor[]"]');

    $submitBtn.hide();

    function toggleSubmitButton() {
        $submitBtn.toggle($checkboxes.is(':checked'));
    }

    $('#selectAll').click(function() {
        $checkboxes.prop('checked', $(this).prop('checked'));
        toggleSubmitButton();
    });

    $checkboxes.click(toggleSubmitButton);

    $('#submitStoreBulkForm').click(function() {
        let selectedNomor = [];
        $('input[name="selectedNomor[]"]:checked').each(function() {
            selectedNomor.push($(this).val());
        });

        let pertemuan_id = @json($pertemuan->id);
        let storeBulk = @json(route('presensi.storeBulk'));
        $.ajax({
            url: storeBulk,
            type: 'POST',
            data: {
                '_token': '{{ csrf_token() }}',
                'selectedNomor': selectedNomor,
                'pertemuan_id': pertemuan_id
            },
            success: function(response) {
                console.log('Success:', response);
                location.reload(); // Reload the page
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
            }
        });
    });
});
</script>
@endsection
