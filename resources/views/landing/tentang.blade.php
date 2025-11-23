<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tentang HijauIN</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-white dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 min-h-screen flex flex-col">
@include('landing.partials.nav')
<main class="flex-1 max-w-6xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-extrabold mb-10 text-center">Tentang HijauIN</h1>
    <div class="grid md:grid-cols-2 gap-10 mb-12">
        <p class="text-neutral-700 dark:text-neutral-300 leading-relaxed">HijauIN memfasilitasi pelaporan masalah lingkungan seperti sampah menumpuk, pencemaran, kerusakan fasilitas hijau, hingga masalah drainase. Setiap laporan menyertakan foto awal, lokasi, dan deskripsi sehingga penanganan dapat diprioritaskan secara adil.</p>
        <p class="text-neutral-700 dark:text-neutral-300 leading-relaxed">Admin menugaskan petugas lapangan dan saat pekerjaan selesai, foto bukti diunggah untuk transparansi. Dengan rekam status <em>pending → disetujui → dikerjakan → selesai</em>, warga dapat memantau tindak lanjut secara real-time.</p>
    </div>
    <div class="grid md:grid-cols-3 gap-8 mb-14">
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm">
            <h3 class="font-semibold mb-2">Transparan</h3>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Semua tahapan terpublikasi sehingga mencegah manipulasi status.</p>
        </div>
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm">
            <h3 class="font-semibold mb-2">Kolaboratif</h3>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Warga, admin, dan petugas terhubung dalam satu alur terstruktur.</p>
        </div>
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm">
            <h3 class="font-semibold mb-2">Terukur</h3>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Statistik membantu evaluasi kebijakan lingkungan secara periodik.</p>
        </div>
    </div>
    <div class="p-6 rounded-xl border bg-white dark:bg-neutral-800 shadow-sm">
        <h3 class="font-semibold mb-2">Visi Kami</h3>
        <p class="text-sm text-neutral-600 dark:text-neutral-400">Mendorong kota yang lebih bersih dan sehat melalui partisipasi warga dan transparansi penanganan.</p>
    </div>
</main>
@include('landing.partials.footer')
</body>
</html>
