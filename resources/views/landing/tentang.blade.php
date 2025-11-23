<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tentang Kami - HijauIN</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-neutral-50 dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 min-h-screen flex flex-col font-sans">
    
    @include('landing.partials.nav')

    <section class="relative bg-emerald-900 py-24 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/diagmonds-light.png')] opacity-10"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-neutral-900/80"></div>
        <div class="relative max-w-4xl mx-auto px-6 text-center text-white z-10">
            <span class="text-emerald-400 font-bold tracking-widest uppercase text-sm mb-2 block">Profil Platform</span>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">Mewujudkan Lingkungan <br> <span class="text-emerald-400">Bersih & Transparan</span></h1>
            <p class="text-lg text-emerald-100 max-w-2xl mx-auto leading-relaxed">
                HijauIN bukan sekadar aplikasi pelaporan. Kami adalah gerakan kolaboratif untuk memulihkan kualitas lingkungan hidup melalui teknologi dan partisipasi warga.
            </p>
        </div>
    </section>

    <main class="flex-1 max-w-7xl mx-auto px-6 -mt-16 relative z-20 pb-20">
        
        <div class="bg-white dark:bg-neutral-900 rounded-3xl p-8 md:p-12 shadow-2xl border-b-4 border-emerald-500 mb-16 text-center">
            <div class="inline-block p-4 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 mb-6">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h2 class="text-3xl font-bold mb-4 text-neutral-900 dark:text-white">Visi Kami</h2>
            <p class="text-xl text-neutral-600 dark:text-neutral-300 font-medium max-w-3xl mx-auto italic">
                "Mendorong terciptanya kota yang lebih bersih, sehat, dan nyaman melalui partisipasi aktif warga serta transparansi total dalam penanganan masalah lingkungan."
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center mb-20">
            <div class="order-2 md:order-1">
                <h2 class="text-3xl font-bold mb-6 text-neutral-900 dark:text-white">Bagaimana Kami Bekerja?</h2>
                <div class="space-y-6 text-neutral-600 dark:text-neutral-400 leading-relaxed">
                    <p>
                        <strong class="text-emerald-600 dark:text-emerald-400">Masalah lingkungan sering terabaikan</strong> karena warga bingung harus melapor ke mana, atau laporan mereka hilang tanpa kabar. HijauIN hadir memutus rantai birokrasi tersebut.
                    </p>
                    <p>
                        Kami memfasilitasi pelaporan masalah seperti sampah menumpuk, pencemaran limbah, hingga drainase tersumbat. Setiap laporan wajib menyertakan <strong>foto bukti, lokasi akurat, dan deskripsi</strong> agar penanganan bisa diprioritaskan secara adil.
                    </p>
                    <p>
                        Admin akan menugaskan petugas lapangan yang kompeten. Setelah pekerjaan selesai, petugas wajib mengunggah <strong>foto hasil (After)</strong> sebagai bukti transparansi kepada pelapor.
                    </p>
                </div>
            </div>
            <div class="order-1 md:order-2 relative">
                <div class="absolute top-0 right-0 -mr-4 -mt-4 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl"></div>
                <div class="relative bg-white dark:bg-neutral-800 p-8 rounded-2xl shadow-lg border border-neutral-100 dark:border-neutral-700">
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-3 bg-neutral-50 dark:bg-neutral-900 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold">1</div>
                            <span class="font-medium">Warga Melapor</span>
                        </div>
                        <div class="flex items-center justify-center"><svg class="w-6 h-6 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg></div>
                        <div class="flex items-center gap-4 p-3 bg-neutral-50 dark:bg-neutral-900 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-bold">2</div>
                            <span class="font-medium">Verifikasi Admin</span>
                        </div>
                        <div class="flex items-center justify-center"><svg class="w-6 h-6 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg></div>
                        <div class="flex items-center gap-4 p-3 bg-neutral-50 dark:bg-neutral-900 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold">3</div>
                            <span class="font-medium">Penanganan & Bukti Foto</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-16">
            <h2 class="text-center text-2xl font-bold mb-10 text-neutral-900 dark:text-white">Nilai Inti Kami</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="group bg-white dark:bg-neutral-900 p-8 rounded-2xl shadow-sm hover:shadow-xl border border-neutral-200 dark:border-neutral-800 transition duration-300">
                    <div class="w-14 h-14 bg-blue-50 dark:bg-blue-900/20 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-neutral-900 dark:text-white">Transparan</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 text-sm leading-relaxed">
                        Tidak ada status yang disembunyikan. Warga bisa melihat perjalanan laporan mereka dari awal hingga selesai secara real-time.
                    </p>
                </div>

                <div class="group bg-white dark:bg-neutral-900 p-8 rounded-2xl shadow-sm hover:shadow-xl border border-neutral-200 dark:border-neutral-800 transition duration-300">
                    <div class="w-14 h-14 bg-purple-50 dark:bg-purple-900/20 text-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-neutral-900 dark:text-white">Kolaboratif</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 text-sm leading-relaxed">
                        Sinergi tiga arah: Warga yang peduli, Admin yang responsif, dan Petugas lapangan yang sigap. Semua terhubung dalam satu sistem.
                    </p>
                </div>

                <div class="group bg-white dark:bg-neutral-900 p-8 rounded-2xl shadow-sm hover:shadow-xl border border-neutral-200 dark:border-neutral-800 transition duration-300">
                    <div class="w-14 h-14 bg-orange-50 dark:bg-orange-900/20 text-orange-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-neutral-900 dark:text-white">Terukur</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 text-sm leading-relaxed">
                        Data adalah kunci perbaikan. Statistik laporan membantu kami mengevaluasi kebijakan lingkungan secara periodik dan tepat sasaran.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-neutral-900 rounded-2xl p-10 text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white mb-4">Siap Berpartisipasi?</h2>
                <p class="text-neutral-400 mb-8 max-w-xl mx-auto">Jangan biarkan masalah lingkungan di sekitarmu menumpuk. Jadilah agen perubahan hari ini.</p>
                <a href="{{ route('lapor.create') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-emerald-600 rounded-full hover:bg-emerald-500 transition transform hover:-translate-y-1 shadow-lg">
                    Buat Laporan Sekarang
                </a>
            </div>
        </div>

    </main>

    @include('landing.partials.footer')
</body>
</html>