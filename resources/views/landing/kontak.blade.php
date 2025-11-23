<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kontak & Creator - HijauIN</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-neutral-50 dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 min-h-screen flex flex-col font-sans">
    
    @include('landing.partials.nav')

    <section class="relative bg-emerald-900 py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-neutral-900/50"></div>
        <div class="relative max-w-5xl mx-auto px-6 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Tim & Kontak</h1>
            <p class="text-emerald-100 max-w-2xl mx-auto text-lg">Kenalan dengan para creator di balik HijauIN dan hubungi kami jika Anda memiliki pertanyaan.</p>
        </div>
    </section>

    <main class="flex-1 max-w-6xl mx-auto px-6 -mt-10 relative z-10 pb-20">
        
        <div class="grid md:grid-cols-2 gap-6 mb-12">
            <div class="p-8 rounded-2xl bg-white dark:bg-neutral-900 shadow-lg border-b-4 border-emerald-500 flex items-center gap-6 hover:-translate-y-1 transition duration-300">
                <div class="w-14 h-14 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 flex-shrink-0">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-neutral-900 dark:text-white">Email Resmi</h3>
                    <a href="mailto:admin@hijauin.com" class="text-neutral-600 dark:text-neutral-400 hover:text-emerald-600 transition">admin@hijauin.com</a>
                </div>
            </div>

            <div class="p-8 rounded-2xl bg-white dark:bg-neutral-900 shadow-lg border-b-4 border-blue-500 flex items-center gap-6 hover:-translate-y-1 transition duration-300">
                <div class="w-14 h-14 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 flex-shrink-0">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-neutral-900 dark:text-white">Lokasi</h3>
                    <p class="text-neutral-600 dark:text-neutral-400">UIN Sunan Kalijaga Yogyakarta</p>
                </div>
            </div>
        </div>

        <div class="mb-16">
            <div class="text-center mb-10">
                <span class="text-emerald-600 font-bold tracking-wider uppercase text-sm">The Developers</span>
                <h2 class="text-3xl font-bold mt-2 text-neutral-900 dark:text-white">Meet the Creators</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <a href="https://github.com/fiksDevvv" target="_blank" class="group bg-white dark:bg-neutral-900 rounded-2xl p-6 shadow-md hover:shadow-xl border border-neutral-200 dark:border-neutral-800 transition-all duration-300 flex flex-col items-center text-center hover:-translate-y-2">
                    <div class="relative mb-4">
                        <div class="absolute inset-0 bg-emerald-500 blur-lg opacity-20 rounded-full group-hover:opacity-40 transition"></div>
                        <img src="https://github.com/fiksDevvv.png" alt="fiksDevvv" class="w-24 h-24 rounded-full border-4 border-white dark:border-neutral-800 relative z-10 object-cover">
                    </div>
                    <h3 class="font-bold text-xl text-neutral-900 dark:text-white group-hover:text-emerald-600 transition">Taufik</h3>
                    <p class="text-sm text-neutral-500 mb-4">@fiksDevvv</p>
                    <span class="px-3 py-1 rounded-full bg-neutral-100 dark:bg-neutral-800 text-xs font-medium text-neutral-600 dark:text-neutral-400 group-hover:bg-emerald-100 group-hover:text-emerald-700 transition">DevOps</span>
                </a>

                <a href="https://github.com/RifkiAndriyanPratama" target="_blank" class="group bg-white dark:bg-neutral-900 rounded-2xl p-6 shadow-md hover:shadow-xl border border-neutral-200 dark:border-neutral-800 transition-all duration-300 flex flex-col items-center text-center hover:-translate-y-2">
                    <div class="relative mb-4">
                        <div class="absolute inset-0 bg-blue-500 blur-lg opacity-20 rounded-full group-hover:opacity-40 transition"></div>
                        <img src="https://github.com/RifkiAndriyanPratama.png" alt="Rifki" class="w-24 h-24 rounded-full border-4 border-white dark:border-neutral-800 relative z-10 object-cover">
                    </div>
                    <h3 class="font-bold text-xl text-neutral-900 dark:text-white group-hover:text-blue-600 transition">Rifki Andriyan</h3>
                    <p class="text-sm text-neutral-500 mb-4">@RifkiAndriyanPratama</p>
                    <span class="px-3 py-1 rounded-full bg-neutral-100 dark:bg-neutral-800 text-xs font-medium text-neutral-600 dark:text-neutral-400 group-hover:bg-blue-100 group-hover:text-blue-700 transition">Backend Developer</span>
                </a>

                <a href="https://github.com/Sin-cai" target="_blank" class="group bg-white dark:bg-neutral-900 rounded-2xl p-6 shadow-md hover:shadow-xl border border-neutral-200 dark:border-neutral-800 transition-all duration-300 flex flex-col items-center text-center hover:-translate-y-2">
                    <div class="relative mb-4">
                        <div class="absolute inset-0 bg-purple-500 blur-lg opacity-20 rounded-full group-hover:opacity-40 transition"></div>
                        <img src="https://github.com/Sin-cai.png" alt="Sin-cai" class="w-24 h-24 rounded-full border-4 border-white dark:border-neutral-800 relative z-10 object-cover">
                    </div>
                    <h3 class="font-bold text-xl text-neutral-900 dark:text-white group-hover:text-purple-600 transition">Sin-cai</h3>
                    <p class="text-sm text-neutral-500 mb-4">@Sin-cai</p>
                    <span class="px-3 py-1 rounded-full bg-neutral-100 dark:bg-neutral-800 text-xs font-medium text-neutral-600 dark:text-neutral-400 group-hover:bg-purple-100 group-hover:text-purple-700 transition">Frontend Developer</span>
                </a>
            </div>
        </div>

        <div class="rounded-2xl bg-gradient-to-r from-neutral-900 to-neutral-800 text-white p-8 md:p-12 text-center shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-emerald-500 opacity-10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-4">Dukung Pengembangan HijauIN</h3>
                <p class="text-neutral-300 max-w-2xl mx-auto mb-8">
                    Proyek ini bersifat open source. Jika Anda menemukan bug atau memiliki ide fitur baru, jangan ragu untuk berkontribusi melalui GitHub.
                </p>
                <a href="https://github.com/fiksDevvv" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-neutral-900 font-bold rounded-lg hover:bg-emerald-50 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    Kunjungi Repository
                </a>
            </div>
        </div>

    </main>

    @include('landing.partials.footer')
</body>
</html>