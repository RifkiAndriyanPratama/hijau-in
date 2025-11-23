<header class="border-b border-neutral-200 dark:border-neutral-800 bg-white/90 dark:bg-neutral-900/70 backdrop-blur sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('images/logo-hijauin.png') }}" alt="HijauIN" class="h-10 w-auto" />
                <span class="font-bold text-xl">HijauIN</span>
            </a>
        </div>
        <nav class="hidden md:flex gap-8 text-sm font-medium">
            <a href="/" class="hover:text-primary-600 {{ request()->is('/') ? 'text-primary-600 font-semibold' : '' }}">Home</a>
            <a href="{{ route('statistik') }}" class="hover:text-primary-600 {{ request()->routeIs('statistik') ? 'text-primary-600 font-semibold' : '' }}">Statistik</a>
            <a href="{{ route('tentang') }}" class="hover:text-primary-600 {{ request()->routeIs('tentang') ? 'text-primary-600 font-semibold' : '' }}">Tentang</a>
            <a href="{{ route('kontak') }}" class="hover:text-primary-600 {{ request()->routeIs('kontak') ? 'text-primary-600 font-semibold' : '' }}">Kontak</a>
        </nav>
        <div class="flex items-center gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="px-5 py-2 rounded-md bg-primary-600 text-white font-semibold shadow hover:bg-primary-500 transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-5 py-2 rounded-md border border-primary-200 text-primary-700 font-medium hover:bg-primary-50">Masuk</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-5 py-2 rounded-md bg-primary-600 text-white font-semibold shadow hover:bg-primary-500 transition">Daftar</a>
                @endif
            @endauth
        </div>
    </div>
</header>
