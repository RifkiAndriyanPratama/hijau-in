<x-app-layout>
    <div class="min-h-screen bg-neutral-50 dark:bg-neutral-950 py-12">
        <div class="max-w-5xl mx-auto px-6">
            
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Daftar Progress Laporan</h1>
                    <p class="text-neutral-500 dark:text-neutral-400 mt-1">Pantau status tindak lanjut laporan Anda di sini.</p>
                </div>
                
                <div class="flex items-center gap-2">
                    <div class="relative">
                        <input type="text" placeholder="Cari laporan..." class="pl-10 pr-4 py-2 rounded-xl border-neutral-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 text-sm focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                        <svg class="w-4 h-4 absolute left-3 top-3 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <button class="p-2 bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-xl text-neutral-600 hover:bg-neutral-50 dark:hover:bg-neutral-800 transition shadow-sm" title="Filter">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                    </button>
                </div>
            </div>

            <div class="space-y-6">
                @forelse ($laporanSaya as $laporan)
                    <div class="bg-white dark:bg-neutral-900 rounded-2xl p-6 shadow-sm border border-neutral-200 dark:border-neutral-800 hover:shadow-md transition-shadow duration-300">
                        <div class="flex flex-col md:flex-row justify-between md:items-start gap-4 mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    <span class="font-bold text-lg text-neutral-900 dark:text-white">{{ $laporan->lokasi }}</span>
                                </div>
                                <p class="text-sm text-neutral-500 dark:text-neutral-400 ml-6">{{ $laporan->created_at->format('d F Y, H:i') }} WIB</p>
                            </div>
                            @php 
                                $statusValue = $laporan->status instanceof \App\Enums\LaporanStatus ? $laporan->status->value : (string) $laporan->status;
                            @endphp
                            <span class="self-start px-4 py-1.5 rounded-full text-sm font-medium border
                                @class([
                                    'bg-amber-50 text-amber-700 border-amber-200' => $statusValue === 'pending',
                                    'bg-blue-50 text-blue-700 border-blue-200' => $statusValue === 'disetujui',
                                    'bg-indigo-50 text-indigo-700 border-indigo-200' => $statusValue === 'dikerjakan',
                                    'bg-green-50 text-green-700 border-green-200' => $statusValue === 'selesai',
                                ])">
                                @if($statusValue === 'pending') Laporan dalam antrian
                                @elseif($statusValue === 'disetujui') Laporan diverifikasi
                                @elseif($statusValue === 'dikerjakan') Sedang ditindaklanjuti
                                @else Masalah telah diselesaikan
                                @endif
                            </span>
                        </div>

                        <div class="ml-0 md:ml-6">
                            <h3 class="font-semibold text-neutral-800 dark:text-neutral-200 mb-2">Deskripsi Masalah:</h3>
                            <div class="bg-neutral-50 dark:bg-neutral-800 p-4 rounded-xl text-neutral-600 dark:text-neutral-300 text-sm leading-relaxed border border-neutral-100 dark:border-neutral-700">
                                "{{ $laporan->keterangan }}"
                            </div>
                        </div>

                        <div class="mt-6 ml-0 md:ml-6 flex items-center justify-end gap-3 pt-4 border-t border-neutral-100 dark:border-neutral-800">
                            @if($laporan->fotoLaporan->count() > 0)
                                <button type="button" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1 mr-auto">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    Lihat {{ $laporan->fotoLaporan->count() }} Bukti Foto
                                </button>
                            @endif

                            <form method="POST" action="{{ route('laporan.destroy',$laporan) }}" onsubmit="return confirm('Hapus laporan ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm px-4 py-2 rounded-lg bg-red-50 text-red-600 font-medium hover:bg-red-100 transition flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white dark:bg-neutral-900 rounded-2xl border border-dashed border-neutral-200 dark:border-neutral-800">
                        <div class="w-16 h-16 bg-neutral-100 dark:bg-neutral-800 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🔍</div>
                        <h3 class="text-lg font-medium text-neutral-900 dark:text-white">Tidak ada progress</h3>
                        <p class="text-neutral-500 dark:text-neutral-400">Anda belum memiliki riwayat laporan apapun.</p>
                    </div>
                @endforelse

                <div class="pt-4">
                    {{ $laporanSaya->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>