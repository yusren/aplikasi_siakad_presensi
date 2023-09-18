@extends('layouts.mahasiswa.master')

@section('title', 'Profile Mahasiswa')

@section('container')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Profil Mahasiswa</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <table>
                        <tr>
                            <td width="60%">Nama</td>
                            <td width="5%"> : </td>
                            <td width="35%">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td> : </td>
                            <td>{{ $user->nomor }}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td> : </td>
                            <td>{{ $user->prodi->name }}</td>
                        </tr>
                        <tr>
                            <td>No. Telp / WA</td>
                            <td> : </td>
                            <td>{{ $user->no_telp }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td> : </td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td> : </td>
                            <td>{{ $user->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td>Status Registrasi</td>
                            <td> : </td>
                            <td>
                                @if($user->status == 'active')
                                Aktif
                                @else
                                Non Aktif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td> : </td>
                            <td>{{ $user->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td> : </td>
                            <td>{{ $user->agama }}</td>
                        </tr>
                        <tr>
                            <td>Tempat</td>
                            <td> : </td>
                            <td>{{ $user->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td> : </td>
                            <td>{{ $user->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <td>Dosen PA</td>
                            <td> : </td>
                            <td>{{ $user->user->name ?? '-' }}</td> 
                        </tr>
                        <tr>
                            <td>Nama Ayah</td>
                            <td> : </td>
                            <td>{{ $user->ayah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Nama Ibu</td>
                            <td> : </td>
                            <td>{{ $user->ibu ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan Ayah</td>
                            <td> : </td>
                            <td>{{ $user->pekerjaan_ayah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan Ibu</td>
                            <td> : </td>
                            <td>{{ $user->pekerjaan_ibu ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Penghasilan Ayah</td>
                            <td> : </td>
                            <td>{{ $user->penghasilan_ayah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Penghasilan Ibu</td>
                            <td> : </td>
                            <td>{{ $user->penghasilan_ibu ?? '-' }}</td>
                        </tr>
                    </table>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>
    </div>
</section>
@endsection
