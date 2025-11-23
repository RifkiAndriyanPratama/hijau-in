<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Statistik HijauIN</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-white dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 min-h-screen flex flex-col">
@include('landing.partials.nav')
<main class="flex-1 max-w-7xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-extrabold mb-10 text-center">Statistik Platform</h1>
    <div class="grid md:grid-cols-3 gap-6 mb-12">
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm text-center">
            <div class="text-5xl font-bold text-primary-600 mb-2">{{ $total }}</div>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Total laporan masuk</p>
        </div>
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm text-center">
            <div class="text-5xl font-bold text-amber-600 mb-2">{{ $pending }}</div>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Menunggu ditinjau / penugasan</p>
        </div>
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm text-center">
            <div class="text-5xl font-bold text-green-600 mb-2">{{ $selesai }}</div>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Sudah ditangani & diverifikasi</p>
        </div>
    </div>
    <p class="text-center text-sm text-neutral-500 dark:text-neutral-400 mb-14">Angka diperbarui otomatis setiap laporan dibuat atau status berubah.</p>
    <div class="grid md:grid-cols-2 gap-8">
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm">
            <h3 class="font-semibold mb-2">Alur Status</h3>
            <ol class="list-decimal list-inside text-sm text-neutral-600 dark:text-neutral-400 space-y-1">
                <li>Pending: laporan baru menunggu peninjauan.</li>
                <li>Disetujui: admin menyetujui dan menetapkan petugas.</li>
                <li>Dikerjakan: petugas sedang menangani di lapangan.</li>
                <li>Selesai: pekerjaan selesai & bukti foto diunggah.</li>
            </ol>
        </div>
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm">
            <h3 class="font-semibold mb-2">Metrik Tambahan (Potensial)</h3>
            <ul class="list-disc list-inside text-sm text-neutral-600 dark:text-neutral-400 space-y-1">
                <li>Waktu rata-rata dari pending ke selesai.</li>
                <li>Persentase laporan selesai bulan ini.</li>
                <li>Kategori masalah paling sering.</li>
                <li>Distribusi laporan per kecamatan.</li>
            </ul>
            <p class="mt-3 text-xs text-neutral-500 dark:text-neutral-400">Dapat ditambahkan nanti untuk analitik lanjutan.</p>
        </div>
    </div>
</main>
@include('landing.partials.footer')
</body>
</html>
