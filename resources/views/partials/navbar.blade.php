<nav class="navbar">
    <div><strong>WEB2 Laravel</strong></div>
    <div>
        <a href="{{ route('inventaris.index') }}" class="{{ request()->routeIs('inventaris.index') ? 'active' : '' }}">
            Inventaris
        </a>
        @auth
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('inventaris.create') }}"
                class="{{ request()->routeIs('inventaris.create') ? 'active' : '' }}">
                Tambah Barang
            </a>
        @else
            <a href="{{ route('inventaris.create') }}" onclick="alert('Fitur ini hanya dapat diakses Admin')"
                class="{{ request()->routeIs('inventaris.create') ? 'active' : '' }}">
                Tambah Barang 🔒
            </a>
        @endif
        @endauth
        @auth
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('kategori.index') }}">
                Kategori
            </a>
        @else
            <a href="{{ route('kategori.index') }}" onclick="alert('Fitur ini hanya dapat diakses Admin')">
                Kategori 🔒
            </a>
        @endif
        @endauth
         @auth
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('kategori.create') }}" class="{{ request()->routeIs('kategori.create') ? 'active' : '' }}">
                Tambah Kategori
            </a>
        @else
            <a href="{{ route('kategori.create') }}" onclick="alert('Fitur ini hanya dapat diakses Admin')">
                Tambah Kategori 🔒
            </a>
        @endif
        @endauth
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">

            @csrf

            <button type="submit" style="
        background:none;
        border:none;
        color:white;
        cursor:pointer;
        font-weight:bold;">
                Logout
            </button>

        </form>
    </div>
</nav>