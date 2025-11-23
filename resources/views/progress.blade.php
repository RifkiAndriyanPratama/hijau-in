<x-app-layout>
    <div class="min-h-screen bg-neutral-50 dark:bg-neutral-950 py-12">
        <div class="max-w-5xl mx-auto px-6">
            
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Daftar Progress Laporan</h1>
                    <p class="text-neutral-500 dark:text-neutral-400 mt-1">Pantau status tindak lanjut laporan Anda di sini.</p>
                </div>
                
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <div class="relative w-full md:w-64">
                        <input type="text" placeholder="Cari laporan..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border-neutral-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 text-sm focus:ring-primary-500 focus:border-primary-500 shadow-sm transition">
                        <svg class="w-4 h-4 absolute left-3 top-3.5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <button class="p-2.5 bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-xl text-neutral-600 hover:bg-neutral-50 dark:hover:bg-neutral-800 transition shadow-sm" title="Filter">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                    </button>
                </div>
            </div>

            <div class="space-y-6">
                @forelse ($laporanSaya as $laporan)
                    <div class="bg-white dark:bg-neutral-900 rounded-2xl p-6 shadow-sm border border-neutral-200 dark:border-neutral-800 hover:shadow-md transition-all duration-300 group">
                        
                        <div class="flex flex-col md:flex-row justify-between md:items-start gap-4 mb-4">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-primary-50 dark:bg-primary-900/20 flex items-center justify-center flex-shrink-0 text-primary-600">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-neutral-900 dark:text-white">{{ $laporan->lokasi }}</h3>
                                    <p class="text-sm text-neutral-500 dark:text-neutral-400 flex items-center gap-1 mt-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $laporan->created_at->format('d F Y, H:i') }} WIB
                                    </p>
                                </div>
                            </div>

                            @php 
                                $statusValue = $laporan->status instanceof \App\Enums\LaporanStatus ? $laporan->status->value : (string) $laporan->status;
                            @endphp
                            <span class="self-start px-4 py-1.5 rounded-full text-xs font-bold tracking-wide border
                                @class([
                                    'bg-amber-50 text-amber-700 border-amber-200' => $statusValue === 'pending',
                                    'bg-blue-50 text-blue-700 border-blue-200' => $statusValue === 'disetujui',
                                    'bg-indigo-50 text-indigo-700 border-indigo-200' => $statusValue === 'dikerjakan',
                                    'bg-green-50 text-green-700 border-green-200' => $statusValue === 'selesai',
                                ])">
                                @if($statusValue === 'pending') ⏳ Menunggu Antrian
                                @elseif($statusValue === 'disetujui') 📝 Diverifikasi Admin
                                @elseif($statusValue === 'dikerjakan') 🛠️ Sedang Ditangani
                                @else ✅ Masalah Selesai
                                @endif
                            </span>
                        </div>

                        <div class="pl-0 md:pl-14">
                            <div class="bg-neutral-50 dark:bg-neutral-800/50 p-4 rounded-xl text-neutral-600 dark:text-neutral-300 text-sm leading-relaxed border border-neutral-100 dark:border-neutral-700 relative">
                                <svg class="absolute top-2 left-2 w-4 h-4 text-neutral-300 dark:text-neutral-600 transform -translate-x-1 -translate-y-1" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.8742 16.0605 15.9408 15.7952C16.6008 15.6278 17.0685 15.1977 17.2292 14.6208C17.3899 14.0439 17.2084 13.4539 16.738 13.1148L16.2993 12.797C15.5927 12.2867 15.1819 11.4483 15.1819 10.5593V7.63158C15.1819 6.18146 16.3281 5 17.7424 5H19.4421C20.8564 5 22.0026 6.18146 22.0026 7.63158V12.6732C22.0026 14.9138 21.1878 17.0137 19.6828 18.6494L18.3891 20.0543C17.7308 20.7693 16.589 20.7693 15.9307 20.0543L14.9259 18.9635C14.3262 18.3123 14.017 18 14.017 18V21ZM2 21L2 18C2 16.8954 2.85719 16.0605 3.9238 15.7952C4.58376 15.6278 5.05154 15.1977 5.21222 14.6208C5.37291 14.0439 5.19138 13.4539 4.72099 13.1148L4.28233 12.797C3.57573 12.2867 3.16491 11.4483 3.16491 10.5593V7.63158C3.16491 6.18146 4.3111 5 5.7254 5H7.42513C8.83943 5 9.98561 6.18146 9.98561 7.63158V12.6732C9.98561 14.9138 9.17084 17.0137 7.66579 18.6494L6.37215 20.0543C5.71381 20.7693 4.57202 20.7693 3.91368 20.0543L2.90894 18.9635C2.30921 18.3123 2 18 2 18V21Z"/></svg>
                                {{ $laporan->keterangan }}
                            </div>
                        </div>

                        <div class="mt-6 pl-0 md:pl-14 flex items-center justify-end gap-3 pt-4 border-t border-neutral-100 dark:border-neutral-800">
                            @if($laporan->fotoLaporan->count() > 0)
                                <button type="button" class="mr-auto text-sm text-primary-600 hover:text-primary-700 font-semibold flex items-center gap-1 group-hover:underline">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    Lihat {{ $laporan->fotoLaporan->count() }} Bukti Foto
                                </button>
                            @endif

                            <form method="POST" action="{{ route('laporan.destroy',$laporan) }}" onsubmit="return confirm('Hapus laporan ini? Tindakan tidak bisa dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs px-4 py-2 rounded-lg bg-red-50 text-red-600 font-semibold hover:bg-red-100 transition flex items-center gap-2 border border-red-100">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white dark:bg-neutral-900 rounded-2xl border border-dashed border-neutral-300 dark:border-neutral-700">
                        <div class="w-16 h-16 bg-neutral-100 dark:bg-neutral-800 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl grayscale opacity-50">🔍</div>
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white">Tidak ada progress</h3>
                        <p class="text-neutral-500 dark:text-neutral-400 mb-6">Anda belum memiliki riwayat laporan apapun.</p>
                        <a href="{{ route('lapor.create') }}" class="inline-flex items-center px-6 py-2.5 rounded-lg bg-primary-600 text-white font-semibold shadow hover:bg-primary-500 transition">
                            Buat Laporan Baru
                        </a>
                    </div>
                @endforelse

                <div class="pt-4">
                    {{ $laporanSaya->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>