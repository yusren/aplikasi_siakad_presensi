@extends('layouts.master')

@section('title', 'Bimbingan')

@section('container')

<section class="content-header">
    <h1>
        Data Bimbingan
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="" class="table table-bordered table-striped">
                        <tr>
                            <th>Nama Bimbingan</th>
                            <td>{{ $bimbingan->name }}</td>
                        </tr>
                        <tr>
                            <th>Pokok Bahasan</th>
                            <td>{{ $bimbingan->topic }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Ajaran</th>
                            <td>{{ $bimbingan->tahunAjaran->semester }} - {{ $bimbingan->tahunAjaran->name }}</td>
                        </tr>
                    </table>
                </div>
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
                        @foreach($bimbingan->user->mahasiswa as $record)
                        <tr>
                            <td><input type="checkbox" name="selectedNomor[]" value="{{$record->nomor}}"></td>
                            <td>{{$record->nomor}}</td>
                            <td>{{$record->name}}</td>
                            <td>{{ $bimbingan->detail()->where('user_id', $record->id)->exists() ? $bimbingan->detail()->where('user_id', $record->id)->first()->created_at->format('D d M Y') : 'Bimbingan Belum Dilakukan'}}</td>
                            <td>
                                @if($bimbingan->detail()->where('user_id', $record->id)->exists())
                                <form action="{{ route('presensi.bimbingan.destroy', $bimbingan->detail()->where('user_id', $record->id)->first()->id) }}" method="post" style="display: inline;">
                                    @method('delete')
                                    @csrf
                                    <button class="border-0 btn btn-danger" onclick="return confirm('Are you sure?')">Hapus</button>
                                </form>
                                @else
                                <form action="{{ route('presensi.bimbingan') }}" method="post" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="bimbingan_id" value="{{ $bimbingan->id }}">
                                    <input type="hidden" class="form-control" name="nim"
                                        value="{{ old('nim', $record->nomor) }}">
                                    <button type="submit" class="btn btn-success">Absen</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('bimbingan.index') }}" class="btn btn-default">Kembali</a>
                <button id="submitStoreBulkForm" type="button" class="btn btn-success">Absen</button>
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

        let bimbingan_id = @json($bimbingan->id);
        let storeBulk = @json(route('presensi.BulkBimbingan'));
        $.ajax({
            url: storeBulk,
            type: 'POST',
            data: {
                '_token': '{{ csrf_token() }}',
                'selectedNomor': selectedNomor,
                'bimbingan_id': bimbingan_id
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
