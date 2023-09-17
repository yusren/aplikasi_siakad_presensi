<!-- Footer -->
<footer class="footer">
    <div class="container">
        <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('dashboard') }}">
                    <span>
                        <i class="nav-icon bi bi-house"></i>
                        <span class="nav-text">Home</span>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('jadwal.index') }}">
                    <span>
                        <i class="nav-icon bi bi-calendar"></i>
                        <span class="nav-text">Jadwal</span>
                    </span>
                </a>
            </li>
            <li class="nav-item centerbutton">
                <div class="nav-link">
                    <span class="theme-radial-gradient">
                        <i class="close bi bi-x"></i>
                        {{-- <img src="{{ asset('mahasiswa/img/centerbutton.svg') }}" class="nav-icon" alt="" /> --}}
                        <i class="nav-icon bi bi-file-earmark-bar-graph"></i>
                    </span>
                    <div class="nav-menu-popover justify-content-between">
                        <button type="button" class="btn btn-lg btn-icon-text" onclick="window.location.replace('{{ route('krs.index', ['aksiKrs' => 'lihat']) }}');">
                            <i class="bi bi-file-ruled size-32"></i><span>Lihat KRS</span>
                        </button>

                        <button type="button" class="btn btn-lg btn-icon-text" onclick="window.location.replace('{{ route('krs.index', ['aksiKrs' => 'entri']) }}');">
                            <i class="bi bi-file-ruled size-32"></i><span>Entri KRS</span>
                        </button>

                        <button type="button" class="btn btn-lg btn-icon-text" onclick="window.location.replace('{{ route('krs.khs') }}');">
                            <i class="bi bi-file-earmark-spreadsheet size-32"></i><span>Lihat KHS</span>
                        </button>

                        <button type="button" class="btn btn-lg btn-icon-text" onclick="window.location.replace('{{ route('krs.rekap') }}');">
                            <i class="bi bi-receipt size-32"></i><span>Lihat Rekap</span>
                        </button>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.edit') }}">
                    <span>
                        <i class="nav-icon bi bi-gear"></i>
                        <span class="nav-text">Setting</span>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.edit', ['user' => auth()->user()->id, 'role' => 'mahasiswa']) }}">
                    <span>
                        <i class="nav-icon bi bi-person-circle"></i>
                        <span class="nav-text">Profile</span>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</footer>
<!-- Footer ends-->
