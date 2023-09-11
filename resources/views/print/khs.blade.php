<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/bootstrap/css/bootstrap.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}">
    <!-- Datetimepicker -->
    <link href="{{ asset('assets/adminlte/plugins/datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/adminlte/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <!-- Daterangepicker -->
    <link href="{{ asset('assets/adminlte/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/zenTheme/css/AdminLTE.min.css') }}">
    <!-- Skins -->
    {{--
    <link rel="stylesheet" href="{{ asset('assets/zenTheme/css/_all-skins.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/zenTheme/css/custom.css') }}">
    {{--
    <link rel="stylesheet" href="{{ asset('assets/zenTheme/css/admin-style.css') }}"> --}}
    <style>
        * {
            font-family: "Times New Roman", Times, serif;
            /* font-size: 16px; */
        }
    </style>
</head>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
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
                    <td>{{ $convertScoreToGrade((($bobot_tugas/100)*$value->nilai_tugas)+(($bobot_uts/100)*$value->nilai_uts)+(($bobot_uas/100)*$value->nilai_uas)+(($bobot_keaktifan/100)*$value->nilai_keaktifan)) }}</td>
                    <td>{{ (($bobot_tugas/100)*$value->nilai_tugas) + (($bobot_uts/100)*$value->nilai_uts) + (($bobot_uas/100)*$value->nilai_uas) + (($bobot_keaktifan/100)*$value->nilai_keaktifan) }}</td>
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
                    <td>20</td>
                    <td>0</td>
                    <td>30.5</td>
                    <td>66.5</td>
                    <td>3.33</td>
                    <td>3.53</td>
                </tr>
            </table>
            @endif

            <div class="row">
                <div class="col-4 col-sm-4 col-lg-4">
                    <div class="text-center">
                        <h5><b>Ketua BAAK</b></h5>
                        <u>{{ json_decode(Storage::disk('public')->get('settings.json'), true)['baak'] }}</u><br>
                        {{ json_decode(Storage::disk('public')->get('settings.json'), true)['baak_status'] }}. {{
                        json_decode(Storage::disk('public')->get('settings.json'), true)['baak_nomor'] }}
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-lg-4">
                    <div class="text-center">
                        <h5><b>Ketua Program Studi</b></h5>
                        <u>{{ auth()->user()->prodi->user->name }}</u><br>
                        NIDN. {{ auth()->user()->prodi->user->nomor }}
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-lg-4">
                    <div class="text-center">
                        <b>Pacitan,</b> {{ date('d M Y') }}
                        <h5><b>Dosen Pembimbing Akademik</b></h5>
                        <u>{{ auth()->user()->user->name }}</u><br>
                        NIDN. {{ auth()->user()->user->nomor }}
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('assets/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/adminlte/plugins/select2/select2.full.min.js') }}"></script>
    <!-- Datepicker -->
    <script src="{{ asset('assets/adminlte/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/adminlte/dist/js/app.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('assets/adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/adminlte/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('assets/adminlte/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- datetimerange -->
    <script src="{{ asset('assets/adminlte/plugins/daterangepicker/moment.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- page script -->
    <script>
        $(function() {
                $(".select2").select2();
                $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });

                //Date picker
                $('#datepicker').datepicker({
                    autoclose: true
                })
            });
    </script>
    @yield('page-script')
</body>

</html>
