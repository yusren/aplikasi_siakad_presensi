<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
<style>
    .text-center {
        text-align: center;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        border-collapse: collapse;
    }

    .table-sm {
        font-size: 85%;
    }

    .table-borderless {
        border: none;
    }

    .bg-info {
        background-color: #17a2b8;
        color: #fff;
    }

    .table th,
    .table td {
        border: 1px solid #dee2e6;
        padding: 0.75rem;
    }

    .row::after {
        content: "";
        clear: both;
        display: table;
    }

    .col-4 {
        float: left;
        width: 33.33333333%;
    }

    .col-sm-4 {
        float: left;
        width: 33.33333333%;
    }

    .col-lg-4 {
        float: left;
        width: 33.33333333%;
    }


    .h1 {
        font-size: 2.5rem;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .u {
        text-decoration: underline;
    }

    .h5 {
        font-size: 1.25rem;
    }

    .ol {
        list-style-type: decimal;
        padding-left: 2rem;
    }
</style>
</head>
<body>
    <section class="content">
        <hr />
        <div class="text-center">
            <h1><u>KARTU HASIL STUDI</u></h1>
        </div>

        @if ($krs->count() > 0)
        <table class="table table-sm table-borderless">
            <tr>
                <td>Nama Mahasiswa</td>
                <td>:</td>
                <td>{{ auth()->user()->name }}</td>
                <td>Semester</td>
                <td>:</td>
                <td>{{ $krs->first()->semester }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td>{{ auth()->user()->nomor }}</td>
                <td>Tahun Ajaran</td>
                <td>:</td>
                <td>{{ $tahunAjaran->name }}</td>
            </tr>
        </table>

        <table class="table table-bordered">
            <tr class="bg-info">
                <th>No</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai</th>
                <th>Bobot</th>
            </tr>
            @foreach ($krs as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->matakuliah->code }}</td>
                <td>{{ $value->matakuliah->name }}</td>
                <td>{{ $value->matakuliah->sks }}</td>
@if($value->matakuliah->angkets->isNotEmpty() && auth()->user()->hasilAngket->whereIn('angket_id', $value->matakuliah->angkets->pluck('id'))->count() == 0)
    <td colspan="2"></td>
@else
    <td>{{ $convertScoreToGrade((($bobot_tugas/100)*$value->nilai_tugas) + (($bobot_uts/100)*$value->nilai_uts) + (($bobot_uas/100)*$value->nilai_uas) + (($bobot_keaktifan/100)*$value->nilai_keaktifan)) }}</td>
    <td>{{ (($bobot_tugas/100)*$value->nilai_tugas) + (($bobot_uts/100)*$value->nilai_uts) + (($bobot_uas/100)*$value->nilai_uas) + (($bobot_keaktifan/100)*$value->nilai_keaktifan) }}</td>
@endif
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <th>Jumlah</th>
                <td>{{ $krs->sum('matakuliah.sks') }}</td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <table class="table text-center table-bordered">
            <tr>
                <td colspan="2">SKS</td>
                <td rowspan="2">Jumlah Nilai Yang Masuk</td>
                <td rowspan="2">BOBOT</td>
                <td rowspan="2">IP. SMT</td>
                <td rowspan="2">IPK</td>
            </tr>
            <tr>
                <td>Lulus</td>
                <td>Gagal</td>
            </tr>
            <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>{{ $totalScore }}</td>
                <td>{{ $ip }}</td>
                <td>{{ $ipk }}</td>
            </tr>
        </table>
        @endif
        <table width="100%" class="text-center">
            <tr>
                <td width="33%">Mengetahui<br>Ketua BAAK</td>
                <td width="33%">Menyetujui<br>Ketua Program Studi</td>
                <td width="33%"><b>Pacitan</b>, {{ date('d M Y') }}<br>Dosen Pembimbing Akademik</td>
            </tr>
            <tr>
                <td><br>
                @php
                    $png = DNS2D::getBarcodePNG('Dokumen ini telah ditandatangani secara elektronik oleh'.' '.json_decode(Storage::disk('public')->get('settings.json'), true)['baak'], 'QRCODE', 3, 3);
                @endphp
                <div style="display: flex; justify-content: center;">
                    <img src="data:image/png;base64,{{ $png }}">
                </div>
                </td>
                <td><br>
                @php
                    $png = DNS2D::getBarcodePNG('Dokumen ini telah ditandatangani secara elektronik oleh'.' '.auth()->user()->prodi->user->name, 'QRCODE', 3, 3);
                @endphp
                <div style="display: flex; justify-content: center;">
                    <img src="data:image/png;base64,{{ $png }}">
                </div>
                </td>
                <td><br>
                @php
                    $png = DNS2D::getBarcodePNG('Dokumen ini telah ditandatangani secara elektronik oleh'.' '.auth()->user()->user->name, 'QRCODE', 3, 3);
                @endphp
                <div style="display: flex; justify-content: center;">
                    <img src="data:image/png;base64,{{ $png }}">
                </div>
                </td>
            </tr>
            <tr>
                <td><br>
                    <u>{{ json_decode(Storage::disk('public')->get('settings.json'), true)['baak'] }}</u><br>
                    {{ json_decode(Storage::disk('public')->get('settings.json'), true)['baak_status'] }}. {{json_decode(Storage::disk('public')->get('settings.json'), true)['baak_nomor'] }}
                </td>
                <td><br>
                    <u>{{ auth()->user()->prodi->user->name }}</u><br>
                    NIDN. {{ auth()->user()->prodi->user->nomor }}
                </td>
                <td><br>
                    <u>{{ auth()->user()->user->name }}</u><br>
                    NIDN. {{ auth()->user()->user->nomor }}
                </td>
            </tr>
        </table>
    </section><!-- /.content -->
</body>
</html>
