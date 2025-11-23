<x-app-layout>
    <div class="min-h-screen bg-neutral-50 dark:bg-neutral-950 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Laporan Saya</h1>
                    <p class="text-neutral-500 dark:text-neutral-400 mt-1">Pantau riwayat dan status penanganan laporan Anda.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl bg-white dark:bg-neutral-900 text-neutral-700 dark:text-neutral-200 font-medium border border-neutral-200 dark:border-neutral-800 hover:bg-neutral-50 transition shadow-sm">
                        &larr; Dashboard
                    </a>
                    <a href="{{ route('lapor.create') }}" class="px-5 py-2.5 rounded-xl bg-primary-600 text-white font-bold shadow-lg hover:bg-primary-500 transition flex items-center gap-2">
                        <span>📸</span> Buat Laporan
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative flex items-center justify-between">
                    <span class="font-medium">{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-700 font-bold text-xl leading-none">&times;</button>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($laporanSaya as $laporan)
                    <div class="group bg-white dark:bg-neutral-900 rounded-2xl shadow-sm hover:shadow-xl border border-neutral-200 dark:border-neutral-800 overflow-hidden transition-all duration-300 hover:-translate-y-1">
                        <div class="relative h-52 overflow-hidden bg-neutral-100">
                            @php 
                                $thumb = $laporan->fotoLaporan->first(); 
                                $statusValue = $laporan->status instanceof \App\Enums\LaporanStatus ? $laporan->status->value : (string) $laporan->status;
                            @endphp
                            
                            @if($thumb)
                                <button type="button" data-photo-preview="{{ asset('storage/'.$thumb->path_file) }}" class="w-full h-full block focus:outline-none cursor-zoom-in">
                                    <img src="{{ asset('storage/'.$thumb->path_file) }}" alt="Foto Laporan" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                </button>
                            @else
                                <div class="w-full h-full flex items-center justify-center text-neutral-400">
                                    <span class="text-4xl">📷</span>
                                </div>
                            @endif

                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm border backdrop-blur-md
                                    @class([
                                        'bg-amber-100/90 text-amber-800 border-amber-200' => $statusValue === 'pending',
                                        'bg-blue-100/90 text-blue-800 border-blue-200' => $statusValue === 'disetujui',
                                        'bg-indigo-100/90 text-indigo-800 border-indigo-200' => $statusValue === 'dikerjakan',
                                        'bg-green-100/90 text-green-800 border-green-200' => $statusValue === 'selesai',
                                    ])">
                                    {{ ucfirst($statusValue) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5">
                            <div class="mb-3">
                                <h3 class="font-bold text-lg text-neutral-900 dark:text-white line-clamp-1" title="{{ $laporan->lokasi }}">{{ $laporan->lokasi }}</h3>
                                <p class="text-xs text-neutral-500 mt-1">📅 {{ $laporan->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 line-clamp-2 mb-5 h-10 leading-relaxed">
                                {{ $laporan->keterangan }}
                            </p>

                            <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
                                <span class="text-xs font-semibold text-primary-600 bg-primary-50 px-2.5 py-1 rounded-md">
                                    #{{ $laporan->id }}
                                </span>
                                <form method="POST" action="{{ route('laporan.destroy',$laporan) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="flex items-center gap-1 text-xs font-medium text-red-500 hover:text-red-700 transition px-2 py-1 rounded hover:bg-red-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white dark:bg-neutral-900 rounded-2xl border border-dashed border-neutral-300 dark:border-neutral-700">
                        <div class="w-20 h-20 bg-neutral-100 dark:bg-neutral-800 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                            📭
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-1">Belum ada laporan</h3>
                        <p class="text-neutral-500 mb-6">Anda belum pernah mengirimkan laporan masalah lingkungan.</p>
                        <a href="{{ route('lapor.create') }}" class="inline-flex items-center px-6 py-2.5 rounded-lg bg-primary-600 text-white font-semibold shadow hover:bg-primary-500 transition">
                            Buat Laporan Pertama
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-10 border-t border-neutral-200 dark:border-neutral-800 pt-6">
                {{ $laporanSaya->links() }}
            </div>
        </div>
    </div>

    <div id="photo-modal" class="fixed inset-0 bg-black/90 backdrop-blur-sm flex items-center justify-center z-[60] hidden opacity-0 transition-opacity duration-300">
        <div class="relative max-w-4xl w-full p-4 transform scale-95 transition-transform duration-300">
            <button data-close-modal class="absolute -top-10 right-4 text-white text-xl font-bold hover:text-gray-300 flex items-center gap-2">
                Tutup <span>&times;</span>
            </button>
            <img src="" alt="Preview" class="max-h-[85vh] w-auto mx-auto rounded-lg shadow-2xl border-2 border-white/20">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('photo-modal');
            const img = modal.querySelector('img');
            const content = modal.querySelector('div');

            function openModal(src) {
                img.src = src;
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                }, 10);
            }

            function closeModal() {
                modal.classList.add('opacity-0');
                content.classList.remove('scale-100');
                content.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    img.src = '';
                }, 300);
            }

            document.querySelectorAll('[data-photo-preview]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    openModal(btn.getAttribute('data-photo-preview'));
                });
            });

            modal.querySelector('[data-close-modal]').addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
            });
        });
    </script>
</x-app-layout>