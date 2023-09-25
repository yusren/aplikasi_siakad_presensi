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
        }

        .table-sm {
            font-size: 85%;
        }

        .table-inf th,
        .table-inf td {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
        }

        .bg-info {
            background-color: #17a2b8;
            color: #fff;
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
<table width="100%">
    <tr>
        <td width="15%">
            <img width="100px" src="{{ asset('img/logo.png') }}" >
        </td>
        <td style="text-align: center !important;"><br>
            <p><strong style="font-size: 16px;">STKIP PGRI PACITAN<br>
            SEKOLAH TINGGI KEGURUAN DAN ILMU PENDIDIKAN PGRI PACITAN</strong><br>
            <strong style="font-size: 12px;">Jln. Cut Nya' Dien No. 4A Ploso Pacitan Pacitan Telp : 0357- 881488 Fax : 0357-884742<br>
            e-mail : Info@stkippacitan.ac.id.Website : stkippacitan.ac.id
            </strong></p>
        </td>
    </tr>
</table>
<hr style="border-top: 3px double;">
<br>
<p style="text-align: center;"><strong><u>
    KARTU RENCANA STUDI
</u><br>(KRS)</strong></p>
<br>

<table style="padding: 0.75rem; font-size: 100%;" class="table">
    <tr>
        <td width="25%">Nama Mahasiswa</td>
        <td width="5%">:</td>
        <td>{{ auth()->user()->name }}</td>
    </tr>
    <tr>
        <td>NPM</td>
        <td>:</td>
        <td>{{ auth()->user()->nomor }}</td>
    </tr>
    <tr>
        <td>Program Studi</td>
        <td>:</td>
        <td>{{ auth()->user()->prodi->name }}</td>
    </tr>
</table>

<table class="table table-bordered table-inf">
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
<ol style="font-size: 14px;">
    <li>Tulislah semua mata kuliah yang akan ditempuh semester ini dalam Blanko KRS.</li>
    <li>Jumlah SKS yang diprogram maksimal: <b>24 SKS, termasuk Mata Kuliah Perbaikan.</b></li>
    <li>KRS dibuat rangkap 3(1. Untuk Prodi, 2. BAAK/BAUK, 3. Arsip Mahasiswa).</li>
    <li>Mata Kuliah yang diprogram dalam KRS ini secara otomatis akan diprogram menjadi <b>Kartu Rencana Ujian (KRU)</b></li>
</ol>

<table width="100%" class="text-center">
    <tr>
        <td width="33%">Mengetahui<br>Ketua Prodi</td>
        <td width="33%">Menyetujui<br>Dosen Pembimbing Akademik</td>
        <td width="33%">Pacitan, {{ date('d M Y') }}<br>Kabiro Administrasi Keuangan</td>
    </tr>
    <tr>
        <td><br>
            @if ($krs->first()->status == 'setujui_by_kaprodi')
                @php
                    $png = DNS2D::getBarcodePNG('Dokumen ini telah ditandatangani secara elektronik oleh'.' '.auth()->user()->prodi->user->name, 'QRCODE', 3, 3);
                @endphp
                <div style="display: flex; justify-content: center;">
                    <img src="data:image/png;base64,{{ $png }}">
                </div>
            @endif
        </td>
        <td><br>
            @if ($krs->first()->status == 'setujui_by_dosbing' || $krs->first()->status == 'setujui_by_kaprodi')
            @php
                $png = DNS2D::getBarcodePNG('Dokumen ini telah ditandatangani secara elektronik oleh'.' '.auth()->user()->user->name, 'QRCODE', 3, 3);
            @endphp
            <div style="display: flex; justify-content: center;">
                <img src="data:image/png;base64,{{ $png }}">
            </div>
            @endif
        </td>
        <td><br>
            @if ($krs->first()->status == 'setujui_by_keuangan' || $krs->first()->status == 'setujui_by_dosbing' || $krs->first()->status == 'setujui_by_kaprodi')
                @php
                    $png = DNS2D::getBarcodePNG('Dokumen ini telah ditandatangani secara elektronik oleh'.' '.json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan'], 'QRCODE', 3, 3);
                @endphp
                <div style="display: flex; justify-content: center;">
                    <img src="data:image/png;base64,{{ $png }}">
                </div>
            @endif
        </td>
    </tr>
    <tr>
        <td><br>
            <u>{{ auth()->user()->prodi->user->name }}</u><br>
            NIDN. {{ auth()->user()->prodi->user->nomor }}
        </td>
        <td><br>
            <u>{{ auth()->user()->user->name }}</u><br>
            NIDN. {{ auth()->user()->user->nomor }}
        </td>
        <td><br>
            <u>{{ json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan'] }}</u><br>
            {{ json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan_status'] }}. {{ json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan_nomor'] }}
        </td>
    </tr>
</table>

</body>
</html>
