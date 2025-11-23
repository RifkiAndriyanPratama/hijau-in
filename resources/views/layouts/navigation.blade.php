<nav x-data="{ open: false }" id="main-nav" class="sticky top-0 z-50 bg-emerald-600/90 dark:bg-neutral-950/70 backdrop-blur-md supports-[backdrop-filter]:bg-emerald-600/80 dark:supports-[backdrop-filter]:bg-neutral-950/60 border-b border-emerald-500/40 dark:border-emerald-700/40 transition-colors duration-300 text-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/logo-hijauin.png') }}" alt="HijauIN" class="h-14 md:h-16 w-auto" />
                        <span class="font-bold text-xl md:text-2xl text-white">HijauIN</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link href="/laporan-saya" :active="request()->routeIs('laporan.saya')">
                        Laporan Saya
                    </x-nav-link>
                    @auth
                        @if(strtolower(auth()->user()->role->nama_role) === 'admin')
                            <x-nav-link href="{{ route('admin.laporan.masuk') }}" :active="request()->routeIs('admin.laporan.masuk')">
                                Laporan Masuk
                            </x-nav-link>
                        @endif
                    @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-5 py-3 border border-transparent text-base leading-5 font-medium rounded-md text-white bg-white/0 hover:text-emerald-100 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-md text-emerald-100 hover:text-white hover:bg-emerald-500/30 focus:outline-none focus:bg-emerald-500/40 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-emerald-400/40 dark:border-emerald-700/40 bg-emerald-600/20">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-emerald-100">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
// Efek scroll: tambah bayangan & perkuat blur saat menggulir
document.addEventListener('DOMContentLoaded', () => {
    const nav = document.getElementById('main-nav');
    const activate = () => {
        if (window.scrollY > 10) {
            nav.classList.add('backdrop-blur-lg','shadow-lg','bg-white/70','dark:bg-neutral-900/60');
        } else {
            nav.classList.remove('backdrop-blur-lg','shadow-lg','bg-white/70','dark:bg-neutral-900/60');
        }
    };
    activate();
    window.addEventListener('scroll', activate, { passive: true });
});
</script>
