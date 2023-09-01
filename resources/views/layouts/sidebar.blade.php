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
            <li class="{{ (request()->is('admin*')) ? 'active' : '' }}"><a href="/admin"><i class="fa fa-users"></i><span>Admin</span></a></li>

            <li class="treeview {{ request()->is('fakultas*') || request()->is('kelas*') || request()->is('matakuliah*') || request()->is('tahunajaran*') || request()->is('prodi*') || request()->is('ruang*') ? 'active' : '' }}">
                <a href="#"><i class="fa fa-circle"></i><span>Master Data</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('fakultas*')) ? 'active' : '' }}"><a href="/fakultas"><i class="fa fa-university"></i><span>Fakultas</span></a></li>
                    <li class="{{ (request()->is('kelas*')) ? 'active' : '' }}"><a href="/kelas"><i class="fa fa-circle"></i><span>Kelas</span></a></li>
                    <li class="{{ (request()->is('matakuliah*')) ? 'active' : '' }}"><a href="/matakuliah"><i class="fa fa-circle"></i><span>Mata Kuliah</span></a></li>
                    <li class="{{ (request()->is('prodi*')) ? 'active' : '' }}"><a href="/prodi"><i class="fa fa-circle"></i><span>Program Studi</span></a></li>
                    <li class="{{ (request()->is('ruang*')) ? 'active' : '' }}"><a href="/ruang"><i class="fa fa-circle"></i><span>Ruang</span></a></li>
                    <li class="{{ (request()->is('tahunajaran*')) ? 'active' : '' }}"><a href="/tahunajaran"><i class="fa fa-circle"></i><span>Tahun Ajaran</span></a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
