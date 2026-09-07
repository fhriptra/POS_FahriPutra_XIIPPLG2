<div id="sidebar-wrapper">
    <div class="sidebar-heading">
        <div class="brand-badge">
            <i class="bi bi-joystick"></i>
        </div>
        <div>
            <div class="brand-name fs-2">GameKu POS</div>
            <div class="brand-sub">POINT OF SALE</div>
        </div>
    </div>

    <!-- Menu Sidebar -->
    <div class="nav-section-label">Menu</div>
    <div class="list-group list-group-flush">
        <a href="{{ route('dashboard') }}"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
        </a>

        @can('viewAny', App\Models\User::class)
            <a href="{{ route('admin.users') }}"
               class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> <span>Users</span>
            </a>
        @endcan
        <a href="{{ route('jenis.index') }}"
        class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ request()->routeIs('admin.jenis*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> <span>Jenis Produk</span>
        </a>
        <a href="{{ route('produk.index') }}"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> <span>Produk</span>
        </a>
        <a href="{{ route('penjualan.index') }}"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i> <span>Penjualan</span>
        </a>
    </div>
</div>
