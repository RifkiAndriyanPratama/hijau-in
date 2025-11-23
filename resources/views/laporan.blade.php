<x-app-layout>
    <div class="min-h-screen bg-neutral-50 dark:bg-neutral-950 py-12">
        <div class="max-w-3xl mx-auto px-6">
            <div class="mb-8">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm text-neutral-500 hover:text-primary-600 transition mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Dashboard
                </a>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Buat Laporan Baru</h1>
                <p class="text-neutral-500 dark:text-neutral-400 mt-2">Sampaikan masalah lingkungan di sekitarmu agar segera ditindaklanjuti.</p>
            </div>

            <div class="bg-white dark:bg-neutral-900 rounded-2xl shadow-sm border border-neutral-200 dark:border-neutral-800 overflow-hidden">
                <form method="POST" action="{{ route('lapor.store') }}" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf

                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Lokasi Kejadian</label>
                        <input type="text" id="lokasi" name="lokasi" placeholder="Contoh: Jl. Merpati No. 12, RT 05/RW 02" required
                            class="w-full rounded-xl border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 focus:ring-primary-500 focus:border-primary-500 transition shadow-sm placeholder:text-neutral-400">
                        @error('lokasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Detail Laporan</label>
                        <textarea id="keterangan" name="keterangan" rows="5" placeholder="Jelaskan masalahnya secara detail (misal: Tumpukan sampah menghalangi jalan, bau menyengat, dll)" required
                            class="w-full rounded-xl border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 focus:ring-primary-500 focus:border-primary-500 transition shadow-sm placeholder:text-neutral-400"></textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Foto Bukti (Maks. 5 Foto)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-neutral-300 dark:border-neutral-700 border-dashed rounded-xl hover:bg-neutral-50 dark:hover:bg-neutral-800/50 transition group cursor-pointer relative">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-neutral-400 group-hover:text-primary-500 transition" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-neutral-600 dark:text-neutral-400 justify-center">
                                    <label for="fotos" class="relative cursor-pointer rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                        <span>Upload foto</span>
                                        <input id="fotos" name="fotos[]" type="file" class="sr-only" multiple accept="image/*" onchange="updateFileCount(this)">
                                    </label>
                                    <p class="pl-1">atau tarik ke sini</p>
                                </div>
                                <p class="text-xs text-neutral-500">PNG, JPG, GIF maksimal 2MB</p>
                                <p id="file-count" class="text-sm font-bold text-primary-600 mt-2 hidden"></p>
                            </div>
                        </div>
                        @error('fotos')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition transform hover:-translate-y-0.5">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateFileCount(input) {
            const fileCountElement = document.getElementById('file-count');
            if (input.files && input.files.length > 0) {
                fileCountElement.textContent = input.files.length + " file dipilih";
                fileCountElement.classList.remove('hidden');
            } else {
                fileCountElement.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>