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
            <li class="{{ (request()->is('fakultas*')) ? 'active' : '' }}"><a href="/fakultas"><i class="fa fa-university"></i><span>Fakultas</span></a></li>
        </ul>
    </section>
</aside>
