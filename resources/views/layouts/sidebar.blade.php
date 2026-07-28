<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-white d-flex align-items-center gap-2 px-3 py-3 bg-dark">
        <i class="bi bi-joystick fs-4 text-warning"></i>
        <span class="fw-bold fs-5">GameKu POS</span>
    </div>
    
    <!-- Menu Sidebar -->
    <div class="list-group list-group-flush mt-2">
        <a href="{{ route('dashboard') }}" 
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        
        @can('viewAny', App\Models\User::class)
            <a href="{{ route('admin.users') }}" 
               class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Users
            </a>
        @endcan
        <a href="{{ route('admin.produk.index') }}" 
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Produk
        </a>
    </div>
</div>