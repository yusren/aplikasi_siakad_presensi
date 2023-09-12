<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/logo.png') }}" class="img-circle" alt="User Image"><br>
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <p>SIAKAD Presensi</p>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="{{ (request()->is('dashboard*')) ? 'active' : '' }}"><a href="/dashboard"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
            @switch(auth()->user()->role)
                @case('mahasiswa')
                    <li class="{{ (request()->is('user*')) ? 'active' : '' }}"><a href="{{ route('user.edit', ['user' => auth()->user()->id, 'role' => 'mahasiswa']) }}"><i class="fa fa-circle"></i><span>Data Diri</span></a></li>
                    <li class="{{ (request()->is('krs*')) ? 'active' : '' }}"><a href="/krs"><i class="fa fa-circle"></i><span>Entri KRS</span></a></li>
                    <li class="#"><a href="#"><i class="fa fa-circle"></i><span>Lihat KRS</span></a></li>
                    <li class="#"><a href="#"><i class="fa fa-circle"></i><span>Lihat Rekap</span></a></li>
                    <li class="{{ (request()->is('jadwal*')) ? 'active' : '' }}"><a href="/jadwal"><i class="fa fa-circle"></i><span>Jadwal</span></a></li>
                    @break
                @case('dosen')
                    <li class="{{ (request()->is('matakuliah*')) ? 'active' : '' }}"><a href="/matakuliah"><i class="fa fa-circle"></i><span>Mata Kuliah</span></a></li>
                    <li class="{{ (request()->is('jadwal*')) ? 'active' : '' }}"><a href="/jadwal"><i class="fa fa-circle"></i><span>Absensi</span></a></li>
                    <li class="{{ (request()->is('nilai*')) ? 'active' : '' }}"><a href="/nilai"><i class="fa fa-circle"></i><span>Nilai</span></a></li>
                    @break
                @default
                <li class="{{ request()->is('setting*') ? 'active' : '' }}"><a href="/setting"><i class="fa fa-gear"></i><span>Setting</span></a></li>
                <li class="{{ (request()->is('angket*')) ? 'active' : '' }}"><a href="/angket"><i class="fa fa-circle"></i><span>Angket</span></a></li>
                <li class="{{ (request()->is('admin*')) ? 'active' : '' }}"><a href="/admin"><i class="fa fa-users"></i><span>Admin</span></a></li>
                <li class="#"><a href="{{ route('user.index', ['role' => 'dosen']) }}"><i class="fa fa-users"></i><span>Dosen</span></a></li>
                <li class="#"><a href="{{ route('user.index', ['role' => 'mahasiswa']) }}"><i class="fa fa-users"></i><span>Mahasiswa</span></a></li>
                <li class="treeview {{ request()->is('fakultas*') || request()->is('kelas*') || request()->is('matakuliah*') || request()->is('tahunajaran*') || request()->is('prodi*') || request()->is('jadwal*') || request()->is('krs*') || request()->is('ruang*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-circle"></i><span>Master Data</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li class="{{ (request()->is('tahunajaran*')) ? 'active' : '' }}"><a href="/tahunajaran"><i class="fa fa-circle"></i><span>Tahun Ajaran</span></a></li>
                        <li class="{{ (request()->is('fakultas*')) ? 'active' : '' }}"><a href="/fakultas"><i class="fa fa-university"></i><span>Fakultas</span></a></li>
                        <li class="{{ (request()->is('prodi*')) ? 'active' : '' }}"><a href="/prodi"><i class="fa fa-circle"></i><span>Program Studi</span></a></li>
                        <li class="{{ (request()->is('kelas*')) ? 'active' : '' }}"><a href="/kelas"><i class="fa fa-circle"></i><span>Kelas</span></a></li>
                        <li class="{{ (request()->is('matakuliah*')) ? 'active' : '' }}"><a href="/matakuliah"><i class="fa fa-circle"></i><span>Mata Kuliah</span></a></li>
                        <li class="{{ (request()->is('ruang*')) ? 'active' : '' }}"><a href="/ruang"><i class="fa fa-circle"></i><span>Ruang</span></a></li>
                        <li class="{{ (request()->is('jadwal*')) ? 'active' : '' }}"><a href="/jadwal"><i class="fa fa-circle"></i><span>Jadwal</span></a></li>
                        <li class="{{ (request()->is('krs*')) ? 'active' : '' }}"><a href="/krs-detailprodi"><i class="fa fa-circle"></i><span>KRS</span></a></li>
                    </ul>
                </li>
            @endswitch
        </ul>
    </section>
</aside>
