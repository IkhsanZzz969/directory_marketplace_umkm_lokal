<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-logo">
            <div class="nav-logo-icon">
                <img src="{{ asset('assets/img/laba-transparent.png') }}" alt="" srcset="">
            </div>
            Laba
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('catalog') }}"
                class="nav-link {{ request()->is('katalog-produk') ? 'active' : '' }}">Produk</a>
            <a href="{{ route('msme-shop') }}" class="nav-link {{ request()->is('toko-umkm') ? 'active' : '' }}">Toko
                UMKM</a>
            {{-- <a href="#tips" class="nav-link">Tips & Artikel</a> --}}
        </div>
        <div class="nav-actions">
            @guest
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Masuk</a>
                <a href="{{ route('login') }}?mode=register" class="btn btn-primary btn-sm">Daftar Gratis</a>
            @endguest
            @auth
                @if (request()->is('shop.manage'))
                    <a href="{{ route('profile') }}" class="btn btn-ghost btn-sm"><i
                            class="fa-solid fa-arrow-left fa-xs"></i>
                        Kembali ke Profil</a>
                @endif
                <div class="nav-avatar" onclick="location.href='{{ route('profile') }}'">
                    <img src="{{ auth()->user()->avatar_url }}" alt="Profile Avatar" style="border-radius: 50%;">
                </div>
            @endauth
        </div>
    </div>
</nav>
