<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Statistik Platform - HijauIN</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-neutral-50 dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 min-h-screen flex flex-col font-sans">
    
    @include('landing.partials.nav')

    <section class="bg-emerald-900 relative py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-neutral-900/80 to-transparent"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
            <span class="text-emerald-400 font-bold tracking-wider uppercase text-sm">Transparansi Data</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mt-2 mb-6">Statistik Dampak HijauIN</h1>
            <p class="text-emerald-100 max-w-2xl mx-auto text-lg">
                Pantau seberapa cepat dan efektif kami menangani masalah lingkungan di kotamu. Data ini diperbarui secara real-time.
            </p>
        </div>
    </section>

    <main class="flex-1 max-w-7xl mx-auto px-6 -mt-12 relative z-20 pb-20">
        
        <div class="grid md:grid-cols-3 gap-6 mb-16">
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 shadow-xl border-b-4 border-primary-500 flex flex-col items-center text-center hover:-translate-y-1 transition duration-300">
                <div class="w-16 h-16 mb-4 rounded-full bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center text-primary-600">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <div class="text-5xl font-extrabold text-primary-600 mb-2">{{ $total }}</div>
                <h3 class="font-bold text-neutral-800 dark:text-white text-lg">Total Laporan</h3>
                <p class="text-sm text-neutral-500 mt-1">Jumlah partisipasi masyarakat</p>
            </div>

            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 shadow-xl border-b-4 border-amber-500 flex flex-col items-center text-center hover:-translate-y-1 transition duration-300">
                <div class="w-16 h-16 mb-4 rounded-full bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center text-amber-600">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="text-5xl font-extrabold text-amber-500 mb-2">{{ $pending }}</div>
                <h3 class="font-bold text-neutral-800 dark:text-white text-lg">Dalam Proses</h3>
                <p class="text-sm text-neutral-500 mt-1">Menunggu verifikasi & penugasan</p>
            </div>

            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 shadow-xl border-b-4 border-green-500 flex flex-col items-center text-center hover:-translate-y-1 transition duration-300">
                <div class="w-16 h-16 mb-4 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center text-green-600">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="text-5xl font-extrabold text-green-500 mb-2">{{ $selesai }}</div>
                <h3 class="font-bold text-neutral-800 dark:text-white text-lg">Masalah Teratasi</h3>
                <p class="text-sm text-neutral-500 mt-1">Lingkungan kembali bersih</p>
            </div>
        </div>

        <div class="mb-16">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold mb-2">Bagaimana Status Bekerja?</h2>
                <p class="text-neutral-600 dark:text-neutral-400">Transparansi proses dari laporan masuk hingga selesai.</p>
            </div>

            <div class="grid md:grid-cols-4 gap-4 relative">
                <div class="hidden md:block absolute top-8 left-0 w-full h-1 bg-neutral-200 dark:bg-neutral-800 -z-10 transform scale-x-90"></div>

                <div class="relative bg-white dark:bg-neutral-900 p-6 rounded-xl shadow-sm border border-neutral-100 dark:border-neutral-800 text-center">
                    <div class="w-12 h-12 mx-auto bg-amber-100 text-amber-600 rounded-full flex items-center justify-center font-bold text-xl mb-4 border-4 border-white dark:border-neutral-900">1</div>
                    <h3 class="font-bold mb-2">Pending</h3>
                    <p class="text-sm text-neutral-500">Laporan Anda masuk ke sistem dan menunggu admin membacanya.</p>
                </div>

                <div class="relative bg-white dark:bg-neutral-900 p-6 rounded-xl shadow-sm border border-neutral-100 dark:border-neutral-800 text-center">
                    <div class="w-12 h-12 mx-auto bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xl mb-4 border-4 border-white dark:border-neutral-900">2</div>
                    <h3 class="font-bold mb-2">Disetujui</h3>
                    <p class="text-sm text-neutral-500">Laporan valid. Admin menugaskan petugas ke lokasi.</p>
                </div>

                <div class="relative bg-white dark:bg-neutral-900 p-6 rounded-xl shadow-sm border border-neutral-100 dark:border-neutral-800 text-center">
                    <div class="w-12 h-12 mx-auto bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold text-xl mb-4 border-4 border-white dark:border-neutral-900">3</div>
                    <h3 class="font-bold mb-2">Dikerjakan</h3>
                    <p class="text-sm text-neutral-500">Petugas sedang membersihkan/memperbaiki di lapangan.</p>
                </div>

                <div class="relative bg-white dark:bg-neutral-900 p-6 rounded-xl shadow-sm border border-neutral-100 dark:border-neutral-800 text-center">
                    <div class="w-12 h-12 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold text-xl mb-4 border-4 border-white dark:border-neutral-900">4</div>
                    <h3 class="font-bold mb-2">Selesai</h3>
                    <p class="text-sm text-neutral-500">Masalah beres. Bukti foto hasil kerja diunggah.</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-neutral-900 to-neutral-800 rounded-2xl p-8 md:p-10 text-white shadow-2xl flex flex-col md:flex-row items-center gap-8">
            <div class="flex-1">
                <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    Analitik Lanjutan (Coming Soon)
                </h3>
                <p class="text-neutral-300 mb-6 leading-relaxed">
                    Kami sedang mengembangkan dashboard data yang lebih dalam. Di masa depan, Anda bisa melihat:
                </p>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-neutral-400">
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Rata-rata waktu penyelesaian
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Peta persebaran sampah
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Leaderboard kontributor aktif
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Tren laporan bulanan
                    </li>
                </ul>
            </div>
            <div class="md:w-1/3 text-center">
                <div class="inline-block p-4 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm mb-4">
                    <svg class="w-12 h-12 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <p class="text-sm text-neutral-400">Kami berkomitmen menggunakan data untuk kebijakan lingkungan yang lebih baik.</p>
            </div>
        </div>

    </main>

    @include('landing.partials.footer')
</body>
</html>