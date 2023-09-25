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
<div class="text-center">
    <h1><u>KARTU RENCANA STUDI</u></h1>
    <h1>(KRS)</h1>
</div>

<table class="table table-sm table-borderless">
    <tr>
        <td>Nama Mahasiswa</td>
        <td>:</td>
        <td>{{ auth()->user()->name }}</td>
    </tr>
    <tr>
        <td>NPM</td>
        <td>:</td>
        <td>{{ auth()->user()->nomor }}</td>
    </tr>
    <tr>
        <td>PRODI</td>
        <td>:</td>
        <td>{{ auth()->user()->prodi->name }}</td>
    </tr>
</table>

<table class="table table-bordered">
    <tr class="bg-info">
        <th>No</th>
        <th>Kode MK</th>
        <th>Nama Mata Kuliah</th>
        <th>SKS</th>
        <th>Kelas</th>
    </tr>
    @foreach ($krs as $value)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $value->matakuliah->code }}</td>
        <td>{{ $value->matakuliah->name }}</td>
        <td>{{ $value->matakuliah->sks }}</td>
        <td>{{ $value->user->kelas->first()->name }}</td>
    </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <th>Jumlah</th>
        <td>{{ $krs->sum('matakuliah.sks') }}</td>
        <td></td>
    </tr>
</table>

<h4>Petunjuk :</h4>
<ol>
    <li>Tulislah semua mata kuliah yang akan ditempuh semester ini dalam Blanko KRS.</li>
    <li>Jumlah SKS yang diprogram maksimal: <b>24 SKS, termasuk Mata Kuliah Perbaikan.</b></li>
    <li>KRS dibuat rangkap 3(1. Untuk Prodi, 2. BAAK/BAUK, 3. Arsip Mahasiswa).</li>
    <li>Mata Kuliah yang diprogram dalam KRS ini secara otomatis akan diprogram menjadi <b>Kartu Rencana Ujian (KRU)</b></li>
</ol>

<div class="row">
    <div class="col-4 col-sm-4 col-lg-4">
        <div class="text-center">
            Mengetahui
            <h5><b>Ketua Prodi</b></h5>
            @if ($krs->first()->status == 'setujui_by_kaprodi')
                @php
                    $png = DNS2D::getBarcodePNG('Dokumen ini telah ditandatangani secara elektronik oleh'.' '.auth()->user()->prodi->user->name, 'QRCODE', 3, 3);
                @endphp
                <div style="display: flex; justify-content: center;">
                    <img src="data:image/png;base64,{{ $png }}">
                </div>
            @endif
            <u>{{ auth()->user()->prodi->user->name }}</u><br>
            NIDN. {{ auth()->user()->prodi->user->nomor }}
        </div>
    </div>
    <div class="col-4 col-sm-4 col-lg-4">
        <div class="text-center">
            Menyetujui
            <h5><b>Dosen Pembimbing Akademik</b></h5>
            @if ($krs->first()->status == 'setujui_by_dosbing' || $krs->first()->status == 'setujui_by_kaprodi')
            @php
                $png = DNS2D::getBarcodePNG('Dokumen ini telah ditandatangani secara elektronik oleh'.' '.auth()->user()->user->name, 'QRCODE', 3, 3);
            @endphp
            <div style="display: flex; justify-content: center;">
                <img src="data:image/png;base64,{{ $png }}">
            </div>
            @endif
            <u>{{ auth()->user()->user->name }}</u><br>
            NIDN. {{ auth()->user()->user->nomor }}
        </div>
    </div>
    <div class="col-4 col-sm-4 col-lg-4">
        <div class="text-center">
            Pacitan, {{ date('d M Y') }}
            <h5><b>Kabiro Administrasi Keuangan</b></h5>
            @if ($krs->first()->status == 'setujui_by_keuangan' || $krs->first()->status == 'setujui_by_dosbing' || $krs->first()->status == 'setujui_by_kaprodi')
                @php
                    $png = DNS2D::getBarcodePNG('Dokumen ini telah ditandatangani secara elektronik oleh'.' '.json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan'], 'QRCODE', 3, 3);
                @endphp
                <div style="display: flex; justify-content: center;">
                    <img src="data:image/png;base64,{{ $png }}">
                </div>
            @endif
            <u>{{ json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan'] }}</u><br>
            {{ json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan_status'] }}. {{ json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan_nomor'] }}
        </div>
    </div>
</div>
</body>
</html>
