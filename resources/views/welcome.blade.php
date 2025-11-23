<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HijauIN - Kolaborasi Untuk Lingkungan</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-white dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 flex flex-col min-h-screen">
    <header class="border-b border-neutral-200 dark:border-neutral-800 bg-white/90 dark:bg-neutral-900/70 backdrop-blur sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo-hijauin.png') }}" alt="HijauIN" class="h-10 w-auto" />
                <span class="font-bold text-xl">HijauIN</span>
            </div>
            <nav class="hidden md:flex gap-8 text-sm font-medium">
                <a href="/" class="hover:text-primary-600">Home</a>
                <a href="{{ route('statistik') }}" class="hover:text-primary-600">Statistik</a>
                <a href="{{ route('tentang') }}" class="hover:text-primary-600">Tentang</a>
                <a href="{{ route('kontak') }}" class="hover:text-primary-600">Kontak</a>
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
    <main class="flex-1">
        <section class="relative overflow-hidden py-24 bg-neutral-50 dark:bg-neutral-950" id="hero">
            <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(circle_at_center,rgba(16,185,129,0.12),transparent_65%)] dark:bg-[radial-gradient(circle_at_center,rgba(16,185,129,0.18),transparent_70%)]"></div>
            <div class="relative max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">Lapor Masalah Lingkungan, Wujudkan Kota <span class="text-primary-600">Lebih Hijau</span>.</h1>
                    <p class="text-lg text-neutral-600 dark:text-neutral-300 mb-8 max-w-xl">HijauIN adalah platform kolaboratif antara masyarakat dan pemerintah untuk mempercepat penanganan masalah lingkungan secara transparan.</p>
                    <div class="flex flex-wrap gap-4 mb-10">
                        <a href="{{ route('lapor.create') }}" class="px-6 py-3 rounded-lg bg-primary-600 text-white font-semibold shadow hover:bg-primary-500 transition">Lapor Sekarang</a>
                        <a href="{{ route('statistik') }}" class="px-6 py-3 rounded-lg bg-neutral-100 text-neutral-700 font-medium border border-neutral-200 hover:bg-neutral-200 transition dark:bg-neutral-800 dark:text-neutral-200 dark:border-neutral-700 dark:hover:bg-neutral-700">Lihat Statistik</a>
                        <a href="{{ route('tentang') }}" class="px-6 py-3 rounded-lg bg-primary-50 text-primary-700 font-medium border border-primary-200 hover:bg-primary-100 transition">Tentang HijauIN</a>
                    </div>
                    <div class="flex gap-8" id="statistik">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600">{{ $total }}</div>
                            <div class="text-sm text-neutral-500">Total Laporan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-amber-600">{{ $pending }}</div>
                            <div class="text-sm text-neutral-500">Menunggu</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-600">{{ $selesai }}</div>
                            <div class="text-sm text-neutral-500">Selesai</div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="{{ asset('images/hero-green.jpg') }}" onerror="this.style.display='none'" alt="Ilustrasi lingkungan" class="rounded-2xl shadow-lg w-full object-cover" />
                </div>
            </div>
        </section>
        <section class="max-w-7xl mx-auto px-6 py-16">
            <div class="max-w-3xl mx-auto text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Apa itu HijauIN?</h2>
                <p class="text-neutral-700 dark:text-neutral-300 leading-relaxed">HijauIN membantu warga melaporkan masalah lingkungan seperti sampah menumpuk atau saluran tersumbat. Laporan diberi foto awal, lokasi, dan deskripsi. Admin meninjau lalu menunjuk petugas. Setelah selesai, petugas mengunggah foto bukti.</p>
                <p class="mt-4 text-neutral-700 dark:text-neutral-300 leading-relaxed">Dengan alur jelas <em>pending → disetujui → dikerjakan → selesai</em>, warga tidak perlu menebak status laporan. Semuanya terbuka dan mudah dipantau.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 mb-10">
                <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm">
                    <h3 class="font-semibold mb-2">Transparan</h3>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Status tiap laporan terlihat jelas dari awal sampai selesai.</p>
                </div>
                <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm">
                    <h3 class="font-semibold mb-2">Cepat</h3>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Penugasan petugas membantu laporan tidak menumpuk lama.</p>
                </div>
                <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm">
                    <h3 class="font-semibold mb-2">Kolaboratif</h3>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Warga, admin, dan petugas bekerja bersama menjaga lingkungan.</p>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('statistik') }}" class="inline-flex items-center px-6 py-3 rounded-lg bg-primary-600 text-white font-semibold shadow hover:bg-primary-500 transition">Lihat Statistik Platform</a>
            </div>
        </section>
    </main>
    <footer class="border-t border-neutral-200 dark:border-neutral-800 py-8 text-center text-sm text-neutral-600 dark:text-neutral-400">© {{ date('Y') }} HijauIN. Bersama kita hijaukan bumi.</footer>
</body>
</html>
