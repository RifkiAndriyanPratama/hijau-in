<x-app-layout>
    <div class="bg-neutral-50 dark:bg-neutral-950 min-h-screen">
        
        <div class="relative bg-primary-900 pb-32 pt-12 overflow-hidden">
            <div class="absolute inset-0 opacity-20">
                <img src="{{ asset('images/bg-hero.jpg') }}" class="w-full h-full object-cover" alt="Background">
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-primary-900/50 to-primary-900"></div>

            <div class="relative max-w-7xl mx-auto px-6 z-10">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Halo, {{ auth()->user()->name }}! 👋</h1>
                        <p class="text-primary-200 text-lg">Selamat datang kembali. Mari pantau lingkunganmu hari ini.</p>
                    </div>
                    <div>
                        <a href="{{ route('lapor.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-primary-700 font-bold shadow-lg hover:bg-neutral-100 transition transform hover:-translate-y-1">
                            <span>📸</span> Buat Laporan Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 -mt-20 relative z-20">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white dark:bg-neutral-900 rounded-2xl p-6 shadow-xl border-b-4 border-primary-500 flex items-center justify-between">
                    <div>
                        <p class="text-neutral-500 dark:text-neutral-400 text-sm font-medium uppercase tracking-wider">Total Laporan</p>
                        <h3 class="text-3xl font-bold text-neutral-800 dark:text-white mt-1">{{ $total }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-primary-50 dark:bg-primary-900/50 flex items-center justify-center text-2xl">📝</div>
                </div>
                
                <div class="bg-white dark:bg-neutral-900 rounded-2xl p-6 shadow-xl border-b-4 border-amber-500 flex items-center justify-between">
                    <div>
                        <p class="text-neutral-500 dark:text-neutral-400 text-sm font-medium uppercase tracking-wider">Sedang Diproses</p>
                        <h3 class="text-3xl font-bold text-neutral-800 dark:text-white mt-1">{{ $pending }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-amber-50 dark:bg-amber-900/50 flex items-center justify-center text-2xl">⏳</div>
                </div>

                <div class="bg-white dark:bg-neutral-900 rounded-2xl p-6 shadow-xl border-b-4 border-green-500 flex items-center justify-between">
                    <div>
                        <p class="text-neutral-500 dark:text-neutral-400 text-sm font-medium uppercase tracking-wider">Selesai</p>
                        <h3 class="text-3xl font-bold text-neutral-800 dark:text-white mt-1">{{ $selesai }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/50 flex items-center justify-center text-2xl">✅</div>
                </div>
            </div>

            <div class="mb-8 flex items-center justify-between">
                <h2 id="laporan-saya" class="text-2xl font-bold text-neutral-800 dark:text-white">Riwayat Laporan</h2>
                
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative flex items-center gap-2 text-sm">
                        <span>✅ {{ session('success') }}</span>
                        <button @click="show = false" class="font-bold">&times;</button>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
                @forelse ($laporanSaya as $laporan)
                    <div class="group bg-white dark:bg-neutral-900 rounded-2xl shadow-sm hover:shadow-xl border border-neutral-200 dark:border-neutral-800 overflow-hidden transition-all duration-300 hover:-translate-y-1">
                        
                        <div class="relative h-48 overflow-hidden bg-gray-100">
                            @php 
                                $thumb = $laporan->fotoLaporan->first(); 
                                $statusValue = $laporan->status instanceof \App\Enums\LaporanStatus ? $laporan->status->value : (string) $laporan->status;
                            @endphp
                            
                            @if($thumb)
                                <img src="{{ asset('storage/'.$thumb->path_file) }}" 
                                     alt="Foto Laporan" 
                                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110 cursor-pointer"
                                     data-photo-preview="{{ asset('storage/'.$thumb->path_file) }}">
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
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h3 class="font-bold text-neutral-900 dark:text-white line-clamp-1">{{ $laporan->lokasi }}</h3>
                                    <p class="text-xs text-neutral-500 mt-1 flex items-center gap-1">
                                        📅 {{ $laporan->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                            
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 line-clamp-2 mb-4 min-h-[2.5em]">
                                {{ $laporan->keterangan }}
                            </p>

                            <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
                                <span class="text-xs font-medium text-primary-600 bg-primary-50 px-2 py-1 rounded">
                                    #Laporan-{{ $laporan->id }}
                                </span>

                                <form method="POST" action="{{ route('laporan.destroy',$laporan) }}" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-neutral-400 hover:text-red-600 transition p-1" title="Hapus Laporan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-white dark:bg-neutral-900 rounded-2xl border border-dashed border-neutral-300 dark:border-neutral-700">
                        <div class="w-20 h-20 bg-primary-50 dark:bg-neutral-800 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-4xl">🌱</span>
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white">Belum ada laporan</h3>
                        <p class="text-neutral-500 mb-6 max-w-md mx-auto">Jadilah pahlawan lingkungan hari ini. Laporkan masalah di sekitarmu sekarang juga.</p>
                        <a href="{{ route('lapor.create') }}" class="inline-block px-6 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-500 transition">
                            Buat Laporan Pertama
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mb-20">
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
                // delay
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

            // Close on Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        });
    </script>
</x-app-layout>