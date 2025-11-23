<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between flex-wrap gap-4 mb-8">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold mb-1">Laporan Saya</h1>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Daftar semua laporan yang Anda buat dan status penanganannya.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('lapor.create') }}" class="px-4 py-2 rounded-md bg-primary-600 text-white text-sm font-semibold shadow hover:bg-primary-500 transition">Buat Laporan</a>
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-md bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-200 text-sm font-medium border border-neutral-200 dark:border-neutral-700 hover:bg-neutral-200 dark:hover:bg-neutral-700 transition">Kembali ke Dashboard</a>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 font-medium text-sm text-green-600">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                                @php $statusValue = $laporan->status instanceof \App\Enums\LaporanStatus ? $laporan->status->value : (string) $laporan->status; @endphp
                                <span class="text-xs px-2.5 py-1 rounded-full border whitespace-nowrap @class([
                                    'bg-amber-50 text-amber-700 border-amber-200'=> $statusValue === 'pending',
                                    'bg-blue-50 text-blue-700 border-blue-200'=> $statusValue === 'disetujui',
                                    'bg-indigo-50 text-indigo-700 border-indigo-200'=> $statusValue === 'dikerjakan',
                                    'bg-green-50 text-green-700 border-green-200'=> $statusValue === 'selesai',
                                ])">{{ ucfirst($statusValue) }}</span>
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

            <div class="mt-8 flex items-center justify-between text-xs text-neutral-600 dark:text-neutral-400">
                <div>
                    Halaman {{ $laporanSaya->currentPage() }} dari {{ $laporanSaya->lastPage() }} · Total {{ $laporanSaya->total() }} laporan
                </div>
                <div>
                    {{ $laporanSaya->links() }}
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
