<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/logo.png') }}" class="img-circle" alt="User Image"><br>
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <p>SIAKAD STKIP PGRI Pacitan</p>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="{{ (request()->is('dashboard*')) ? 'active' : '' }}"><a href="/dashboard"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
            @switch(auth()->user()->role)
                @case('mahasiswa')
                    <li class="{{ (request()->is('user*')) ? 'active' : '' }}"><a href="{{ route('user.edit', ['user' => auth()->user()->id, 'role' => 'mahasiswa']) }}"><i class="fa fa-circle"></i><span>Data Diri</span></a></li>
                    <li class="{{ (request()->is('krs*')) ? 'active' : '' }}"><a href="/krs"><i class="fa fa-circle"></i><span>Entri KRS</span></a></li>
                    <li class="{{ (request()->is('rekap*')) ? 'active' : '' }}"><a href="/krs-rekap"><i class="fa fa-circle"></i><span>Lihat Rekap</span></a></li>
                    <li class="{{ (request()->is('jadwal*')) ? 'active' : '' }}"><a href="/jadwal"><i class="fa fa-circle"></i><span>Jadwal</span></a></li>
                    @break
                @case('dosen')
                    <li class="{{ (request()->is('matakuliah*')) ? 'active' : '' }}"><a href="/matakuliah"><i class="fa fa-book"></i><span>Mata Kuliah</span></a></li>
                    <li class="{{ (request()->is('pertemuan*')) ? 'active' : '' }}"><a href="/pertemuan"><i class="fa fa-circle"></i><span>Pertemuan</span></a></li>
                    <li class="{{ (request()->is('jadwal*')) ? 'active' : '' }}"><a href="/jadwal-detailprodi"><i class="fa fa-users"></i><span>Presensi</span></a></li>
                    <li class="{{ (request()->is('nilai*')) ? 'active' : '' }}"><a href="/nilai-detailprodi"><i class="fa fa-tasks"></i><span>Penilaian</span></a></li>
                    <li class="{{ request()->is('krs-approveByDosbing*') ? 'active' : '' }}"><a href="/krs-approveByDosbing"><i class="fa fa-gear"></i><span>Approval KRS PA</span></a></li>
                    @break
                @case('lpm')
                    <li class="{{ (request()->is('angket*')) ? 'active' : '' }}"><a href="/angket"><i class="fa fa-bar-chart"></i><span>Angket</span></a></li>
                    @break
                @case('birokeuangan')
                    <li class="{{ request()->is('krs-approveByKeuangan*') ? 'active' : '' }}"><a href="/krs-approveByKeuangan"><i class="fa fa-check"></i><span>Approval KRS Keuangan</span></a></li>
                    @break
                @case('kaprodi')
                    <li class="{{ request()->is('krs-approveByKaprodi*') ? 'active' : '' }}"><a href="/krs-approveByKaprodi"><i class="fa fa-check"></i><span>Approval KRS Kaprodi</span></a></li>
                    @break
                @default

                <li class="treeview {{ request()->is('admin*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-users"></i><span>Master Users</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="{{ (request()->is('admin*')) ? 'active' : '' }}"><a href="/admin"><i class="fa fa-sitemap"></i><span>Admin</span></a></li>
                            <li class="#"><a href="{{ route('user.index', ['role' => 'dosen']) }}"><i class="fa fa-users"></i><span>Dosen</span></a></li>
                            <li class="#"><a href="{{ route('user.index', ['role' => 'mahasiswa']) }}"><i class="fa fa-user"></i><span>Mahasiswa</span></a></li>
                        </ul>
                </li>
                <li class="{{ (request()->is('tahunajaran*')) ? 'active' : '' }}"><a href="/tahunajaran"><i class="fa fa-calendar"></i><span>Tahun Ajaran</span></a></li>
                <li class="{{ (request()->is('fakultas*')) ? 'active' : '' }}"><a href="/fakultas"><i class="fa fa-university"></i><span>Fakultas</span></a></li>
                <li class="{{ (request()->is('prodi*')) ? 'active' : '' }}"><a href="/prodi"><i class="fa fa-list-alt"></i><span>Program Studi</span></a></li>
                <li class="{{ (request()->is('matakuliah*')) ? 'active' : '' }}"><a href="/matakuliah"><i class="fa fa-book"></i><span>Mata Kuliah</span></a></li>
                <li class="{{ (request()->is('pertemuan*')) ? 'active' : '' }}"><a href="/pertemuan"><i class="fa fa-circle"></i><span>Pertemuan</span></a></li>
                <li class="{{ (request()->is('kelas*')) ? 'active' : '' }}"><a href="/kelas"><i class="fa fa-th-large"></i><span>Kelas</span></a></li>
                <li class="{{ (request()->is('ruang*')) ? 'active' : '' }}"><a href="/ruang"><i class="fa fa-columns"></i><span>Ruang</span></a></li>
                <li class="{{ (request()->is('jadwal*')) ? 'active' : '' }}"><a href="/jadwal"><i class="fa fa-calendar"></i><span>Jadwal</span></a></li>
                <li class="{{ (request()->is('krs*')) ? 'active' : '' }}"><a href="/krs-detailprodi"><i class="fa fa-archive"></i><span>KRS</span></a></li>
                <li class="{{ (request()->is('angket*')) ? 'active' : '' }}"><a href="/angket"><i class="fa fa-bar-chart"></i><span>Angket</span></a></li>
                <li class="{{ request()->is('setting*') ? 'active' : '' }}"><a href="/setting"><i class="fa fa-gear"></i><span>Setting</span></a></li>
                <li class="{{ request()->is('pengumuman*') ? 'active' : '' }}"><a href="/pengumuman"><i class="fa fa-newspaper-o"></i><span>Pengumuman</span></a></li>
                <li class="{{ request()->is('rps*') ? 'active' : '' }}"><a href="/rps"><i class="fa fa-circle"></i><span>RPS</span></a></li>
            @endswitch
        </ul>
    </section>
</aside>
