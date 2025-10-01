<ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
aria-label="Main navigation" data-accordion="false" id="navigation">
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link">
        <i class="nav-icon bi bi-palette"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route(name: 'tagihan.index') }}" class="nav-link">
        <i class="nav-icon bi bi-palette"></i>
        <p>Tagihan</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('pelanggan.index') }}" class="nav-link">
        <i class="nav-icon bi bi-palette"></i>
        <p>Pelanggan</p>
    </a>
</li>
<li class="nav-item menu-open">
    <a href="#" class="nav-link active">
        <i class="nav-icon bi bi-speedometer"></i>
        <p>
            Laporan
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('laporan.pembayaran') }}" class="nav-link active">
                <i class="nav-icon bi bi-circle"></i>
                <p>Pembayaran</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('laporan.tagihan') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Tagihan</p>
            </a>
        </li>
    </ul>
</li>
{{-- <li class="nav-item menu-open">
    <a href="#" class="nav-link active">
        <i class="nav-icon bi bi-speedometer"></i>
        <p>
            Master Data
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ asset('/')}}lte/dist/index.html" class="nav-link active">
                <i class="nav-icon bi bi-circle"></i>
                <p>Pembayaran</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ asset('/')}}lte/dist/index2.html" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Pelanggan</p>
            </a>
        </li>
    </ul>
</li> --}}
</ul>
