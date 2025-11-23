<x-app-layout>
    <div class="py-0">
        <!-- Hero ala halaman awal -->
        <section class="relative overflow-hidden py-12 border-b border-neutral-200 dark:border-neutral-800">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-white dark:from-neutral-900 dark:to-neutral-800"></div>
            <div class="relative max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold leading-tight mb-4">Halo, {{ auth()->user()->name }} 👋</h1>
                    <p class="text-base text-neutral-700 dark:text-neutral-300 mb-6 max-w-xl">Selamat datang di Dashboard HijauIN. Pantau progres laporan Anda dan lihat perkembangan penanganan masalah lingkungan secara transparan.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('lapor.create') }}" class="px-5 py-2.5 rounded-lg bg-primary-600 text-white font-semibold shadow hover:bg-primary-500 transition">Buat Laporan</a>
                        <a href="#laporan-saya" class="px-5 py-2.5 rounded-lg bg-primary-50 text-primary-700 font-medium border border-primary-200 hover:bg-primary-100 transition">Lihat Laporan Saya</a>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4" id="statistik">
                    <div class="p-5 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm text-center">
                        <div class="text-2xl font-bold text-primary-600">{{ $total }}</div>
                        <div class="text-xs text-neutral-500">Total Laporan</div>
                    </div>
                    <div class="p-5 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm text-center">
                        <div class="text-2xl font-bold text-amber-600">{{ $pending }}</div>
                        <div class="text-xs text-neutral-500">Menunggu</div>
                    </div>
                    <div class="p-5 rounded-xl border bg-white dark:bg-neutral-900 shadow-sm text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $selesai }}</div>
                        <div class="text-xs text-neutral-500">Selesai</div>
                    </div>
                </div>
            </div>
        </section>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 flex-wrap mt-20 mb-8">
                <h2 id="laporan-saya" class="text-xl font-bold scroll-mt-32 md:scroll-mt-36">Daftar Laporan Saya</h2>
            </div>

            <div class="bg-white dark:bg-neutral-900 overflow-hidden shadow-sm sm:rounded-xl border border-neutral-200 dark:border-neutral-800 mb-16">
                <div class="p-6 text-neutral-800 dark:text-neutral-200">
                    <h3 class="text-lg font-semibold sr-only">Daftar Laporan Saya</h3>
                    @if (session('success'))
                        <div class="mt-2 mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($laporanSaya as $laporan)
                            <div class="border rounded-xl overflow-hidden bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-800 shadow-sm">
                                @php $thumb = $laporan->fotoLaporan->first(); @endphp
                                @if($thumb)
                                    <button type="button" data-photo-preview="{{ asset('storage/'.$thumb->path_file) }}" class="block w-full group focus:outline-none">
                                        <img src="{{ asset('storage/'.$thumb->path_file) }}" alt="Foto" class="w-full h-40 object-cover group-hover:opacity-90">
                                    </button>
                                @else
                                    <div class="w-full h-40 flex items-center justify-center bg-neutral-100 dark:bg-neutral-800 text-neutral-400">Tidak ada foto</div>
                                @endif
                                <div class="p-4">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <div class="font-semibold leading-tight">{{ $laporan->lokasi }}</div>
                                            <small class="text-xs text-neutral-500">{{ $laporan->created_at->format('d M Y, H:i') }}</small>
                                        </div>
                                        @php
                                            $statusValue = $laporan->status instanceof \App\Enums\LaporanStatus ? $laporan->status->value : (string) $laporan->status;
                                        @endphp
                                        <span class="text-xs px-2.5 py-1 rounded-full border whitespace-nowrap
                                            @class([
                                                'bg-amber-50 text-amber-700 border-amber-200'=> $statusValue === 'pending',
                                                'bg-blue-50 text-blue-700 border-blue-200'=> $statusValue === 'disetujui',
                                                'bg-indigo-50 text-indigo-700 border-indigo-200'=> $statusValue === 'dikerjakan',
                                                'bg-green-50 text-green-700 border-green-200'=> $statusValue === 'selesai',
                                            ])">
                                            {{ ucfirst($statusValue) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-neutral-700 dark:text-neutral-300 mt-2">{{ Str::limit($laporan->keterangan, 140) }}</p>
                                    <div class="mt-4 flex items-center justify-end gap-3">
                                        <form method="POST" action="{{ route('laporan.destroy',$laporan) }}" onsubmit="return confirm('Hapus laporan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-xs px-3 py-1.5 rounded bg-red-600 text-white hover:bg-red-700">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <div class="border rounded-xl bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-800 p-8 text-center">
                                    <div class="mx-auto mb-3 w-12 h-12 rounded-full bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center">📭</div>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-300">Anda belum pernah membuat laporan.</p>
                                    <a href="{{ route('lapor.create') }}" class="inline-flex mt-4 items-center px-4 py-2 rounded-md bg-primary-600 text-white text-sm font-semibold shadow hover:bg-primary-500 transition">Buat Laporan Pertama</a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-6 flex items-center justify-between text-xs text-neutral-600 dark:text-neutral-400">
                        <div>
                            Halaman {{ $laporanSaya->currentPage() }} dari {{ $laporanSaya->lastPage() }} · Total {{ $laporanSaya->total() }} laporan
                        </div>
                        <div>
                            {{ $laporanSaya->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="photo-modal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden">
        <div class="relative max-w-3xl w-full p-4">
            <button data-close-modal class="absolute top-2 right-2 text-white text-2xl leading-none">&times;</button>
            <img src="" alt="Preview" class="max-h-[80vh] mx-auto rounded shadow-lg">
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('photo-modal');
            const img = modal.querySelector('img');
            document.querySelectorAll('[data-photo-preview]').forEach(btn => {
                btn.addEventListener('click', () => {
                    img.src = btn.getAttribute('data-photo-preview');
                    modal.classList.remove('hidden');
                });
            });
            modal.querySelector('[data-close-modal]')?.addEventListener('click', () => {
                modal.classList.add('hidden');
                img.src = '';
            });
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    img.src = '';
                }
            });
        });
    </script>
</x-app-layout>