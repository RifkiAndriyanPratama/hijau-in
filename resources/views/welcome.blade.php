<!DOCTYPE html>
<html lang="id" class="dark">
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
        <section class="relative overflow-hidden py-24" id="hero">
            <div class="absolute inset-0 z-0" style="background-image:url('{{ asset('images/bg-hero.jpg') }}'); background-size:cover; background-position:center; background-repeat:no-repeat;">
                <div class="absolute inset-0 backdrop-blur-sm bg-black/20 w-full h-full"></div>
            </div>
            <div class="absolute inset-0 z-0 bg-black/60 dark:bg-black/70"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6 text-white">Lapor Masalah Lingkungan, Wujudkan Kota <span class="text-primary-400">Lebih Hijau</span>.</h1>
                    <p class="text-lg text-gray-200 mb-8 max-w-xl">HijauIN adalah platform kolaboratif antara masyarakat dan pemerintah untuk mempercepat penanganan masalah lingkungan secara transparan.</p>
                    <div class="flex flex-wrap gap-4 mb-10 relative z-10">
                        <a href="{{ route('lapor.create') }}" class="px-6 py-3 rounded-lg bg-primary-600 text-white font-semibold shadow hover:bg-primary-500 transition">Lapor Sekarang</a>
                        <a href="{{ route('statistik') }}" class="px-6 py-3 rounded-lg bg-white/10 backdrop-blur-md text-white font-medium border border-white/20 hover:bg-white/20 transition">Lihat Statistik</a>
                        <a href="{{ route('tentang') }}" class="px-6 py-3 rounded-lg bg-primary-50 text-primary-700 font-medium border border-primary-200 hover:bg-primary-100 transition">Tentang HijauIN</a>
                    </div>
                    <div class="flex gap-8 relative z-10" id="statistik">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">{{ $total }}</div>
                            <div class="text-sm text-gray-300">Total Laporan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-amber-500">{{ $pending }}</div>
                            <div class="text-sm text-gray-300">Menunggu</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-400">{{ $selesai }}</div>
                            <div class="text-sm text-gray-300">Selesai</div>
                        </div>
                    </div>
                </div>
                <div class="relative z-10 hidden md:block">
                    <img src="{{ asset('images/hero-green.jpg') }}" onerror="this.style.display='none'" alt="Ilustrasi lingkungan" class="rounded-2xl shadow-2xl border-4 border-white/10 w-full object-cover transform rotate-2 hover:rotate-0 transition duration-500" />
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

        <section class="py-20 bg-neutral-50 dark:bg-neutral-900">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-neutral-900 dark:text-white mb-4">Lapor Semudah 1-2-3-4</h2>
            <p class="text-neutral-600 dark:text-neutral-400">Tidak perlu birokrasi berbelit. Cukup gunakan HP Anda.</p>
        </div>

        <div class="grid md:grid-cols-4 gap-8 relative">
            <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-gray-200 dark:bg-gray-800 -z-0 transform scale-x-90"></div>

            <div class="relative z-10 bg-neutral-50 dark:bg-neutral-900 p-4 text-center group">
                <div class="w-24 h-24 mx-auto bg-white dark:bg-neutral-800 rounded-full border-4 border-primary-100 dark:border-primary-900 flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition duration-300">
                    <span class="text-4xl">📸</span> </div>
                <h3 class="font-bold text-lg mb-2 dark:text-white">1. Foto & Lapor</h3>
                <p class="text-sm text-neutral-500 dark:text-neutral-400">Ambil foto masalah lingkungan di sekitarmu dan kirim laporan.</p>
            </div>

            <div class="relative z-10 bg-neutral-50 dark:bg-neutral-900 p-4 text-center group">
                <div class="w-24 h-24 mx-auto bg-white dark:bg-neutral-800 rounded-full border-4 border-amber-100 dark:border-amber-900/30 flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition duration-300">
                    <span class="text-4xl">⏳</span>
                </div>
                <h3 class="font-bold text-lg mb-2 dark:text-white">2. Verifikasi</h3>
                <p class="text-sm text-neutral-500 dark:text-neutral-400">Admin memverifikasi laporan dan meneruskan ke petugas terkait.</p>
            </div>

            <div class="relative z-10 bg-neutral-50 dark:bg-neutral-900 p-4 text-center group">
                <div class="w-24 h-24 mx-auto bg-white dark:bg-neutral-800 rounded-full border-4 border-blue-100 dark:border-blue-900/30 flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition duration-300">
                    <span class="text-4xl">🛠️</span>
                </div>
                <h3 class="font-bold text-lg mb-2 dark:text-white">3. Tindak Lanjut</h3>
                <p class="text-sm text-neutral-500 dark:text-neutral-400">Petugas lapangan menangani masalah dan mengunggah bukti kerja.</p>
            </div>

            <div class="relative z-10 bg-neutral-50 dark:bg-neutral-900 p-4 text-center group">
                <div class="w-24 h-24 mx-auto bg-white dark:bg-neutral-800 rounded-full border-4 border-green-100 dark:border-green-900/30 flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition duration-300">
                    <span class="text-4xl">✅</span>
                </div>
                <h3 class="font-bold text-lg mb-2 dark:text-white">4. Selesai</h3>
                <p class="text-sm text-neutral-500 dark:text-neutral-400">Laporan ditutup. Kamu akan dapat notifikasi update.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white dark:bg-neutral-950 border-t border-neutral-100 dark:border-neutral-900">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold text-neutral-900 dark:text-white mb-2">Apa yang bisa dilaporkan?</h2>
                <p class="text-neutral-600 dark:text-neutral-400">Fokus kami pada masalah lingkungan publik.</p>
            </div>
            <a href="{{ route('lapor.create') }}" class="hidden md:inline-flex text-primary-600 font-semibold hover:underline">Lihat Semua Kategori &rarr;</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="p-6 rounded-2xl bg-gray-50 dark:bg-neutral-900 hover:bg-primary-50 dark:hover:bg-primary-900/20 border border-transparent hover:border-primary-200 transition duration-300 cursor-pointer group">
                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">🗑️</div>
                <h3 class="font-bold text-lg text-neutral-800 dark:text-neutral-200">Sampah Liar</h3>
                <p class="text-xs text-neutral-500 mt-1">Tumpukan sampah di bukan tempatnya.</p>
            </div>
             <div class="p-6 rounded-2xl bg-gray-50 dark:bg-neutral-900 hover:bg-primary-50 dark:hover:bg-primary-900/20 border border-transparent hover:border-primary-200 transition duration-300 cursor-pointer group">
                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">🌊</div>
                <h3 class="font-bold text-lg text-neutral-800 dark:text-neutral-200">Banjir / Drainase</h3>
                <p class="text-xs text-neutral-500 mt-1">Saluran air mampet atau genangan.</p>
            </div>
             <div class="p-6 rounded-2xl bg-gray-50 dark:bg-neutral-900 hover:bg-primary-50 dark:hover:bg-primary-900/20 border border-transparent hover:border-primary-200 transition duration-300 cursor-pointer group">
                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">🌳</div>
                <h3 class="font-bold text-lg text-neutral-800 dark:text-neutral-200">Taman Rusak</h3>
                <p class="text-xs text-neutral-500 mt-1">Pohon tumbang atau fasilitas taman.</p>
            </div>
             <div class="p-6 rounded-2xl bg-gray-50 dark:bg-neutral-900 hover:bg-primary-50 dark:hover:bg-primary-900/20 border border-transparent hover:border-primary-200 transition duration-300 cursor-pointer group">
                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">🏭</div>
                <h3 class="font-bold text-lg text-neutral-800 dark:text-neutral-200">Pencemaran</h3>
                <p class="text-xs text-neutral-500 mt-1">Asap pembakaran atau limbah cair.</p>
            </div>
        </div>
    </div>
</section>
    </main>
    <footer class="border-t border-neutral-200 dark:border-neutral-800 py-8 text-center text-sm text-neutral-600 dark:text-neutral-400">© {{ date('Y') }} HijauIN. Bersama kita hijaukan bumi.</footer>
</body>
</html>