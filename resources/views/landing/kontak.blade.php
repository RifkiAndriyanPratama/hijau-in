<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kontak & Creator HijauIN</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-white dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 min-h-screen flex flex-col">
@include('landing.partials.nav')
<main class="flex-1 max-w-5xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-extrabold mb-10 text-center">Kontak & Creator</h1>
    <div class="grid md:grid-cols-4 gap-8 text-sm mb-14">
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm">
            <h3 class="font-semibold mb-2">Email</h3>
            <p class="text-neutral-600 dark:text-neutral-400"><a href="mailto:admin@hijauin.com" class="hover:text-primary-600">admin@hijauin.com</a></p>
        </div>
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm">
            <h3 class="font-semibold mb-2">Alamat</h3>
            <p class="text-neutral-600 dark:text-neutral-400">UIN Sunan Kalijaga Yogyakarta</p>
        </div>
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm md:col-span-2">
            <h3 class="font-semibold mb-2">Creator</h3>
            <ul class="text-neutral-600 dark:text-neutral-400 space-y-1">
                <li><a href="https://github.com/fiksDevvv" target="_blank" class="hover:text-primary-600">@fiksDevvv</a></li>
                <li><a href="https://github.com/RifkiAndriyanPratama" target="_blank" class="hover:text-primary-600">@RifkiAndriyanPratama</a></li>
                <li><a href="https://github.com/Sin-cai" target="_blank" class="hover:text-primary-600">@Sin-cai</a></li>
            </ul>
        </div>
    </div>
    <div class="p-6 rounded-xl border bg-white dark:bg-neutral-800 shadow-sm">
        <h3 class="font-semibold mb-2">Dukungan</h3>
        <p class="text-sm text-neutral-600 dark:text-neutral-400">Ingin berkontribusi fitur baru? Kirimkan issue atau pull request di repositori GitHub para creator.</p>
    </div>
</main>
@include('landing.partials.footer')
</body>
</html>
