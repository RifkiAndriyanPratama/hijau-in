<x-app-layout>
    <div class="min-h-screen bg-neutral-50 dark:bg-neutral-950 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Laporan Masuk</h1>
                    <p class="text-neutral-500 dark:text-neutral-400 mt-1">Kelola laporan yang masuk, tugaskan petugas, dan update progress.</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800 border border-amber-200">Pending</span>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">Disetujui</span>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800 border border-indigo-200">Dikerjakan</span>
                </div>
            </div>

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="hover:text-green-900 dark:hover:text-green-200">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="hover:text-red-900 dark:hover:text-red-200">&times;</button>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($laporans as $laporan)
                    <div class="group bg-white dark:bg-neutral-900 rounded-2xl shadow-sm hover:shadow-xl border border-neutral-200 dark:border-neutral-800 overflow-hidden flex flex-col transition-all duration-300">
                        
                        <div class="relative h-48 bg-neutral-100 dark:bg-neutral-800 overflow-hidden">
                            @php 
                                $thumb = $laporan->fotoLaporan->first(); 
                                $statusVal = $laporan->status->value;
                            @endphp
                            @if($thumb)
                                <img src="{{ asset('storage/'.$thumb->path_file) }}" alt="Foto Laporan" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-neutral-400">
                                    <span class="text-4xl">📷</span>
                                </div>
                            @endif
                            
                            <div class="absolute top-3 right-3">
                                <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm border backdrop-blur-md
                                    @class([
                                        'bg-amber-100/90 text-amber-800 border-amber-200' => $statusVal === 'pending',
                                        'bg-blue-100/90 text-blue-800 border-blue-200' => $statusVal === 'disetujui',
                                        'bg-indigo-100/90 text-indigo-800 border-indigo-200' => $statusVal === 'dikerjakan',
                                        'bg-green-100/90 text-green-800 border-green-200' => $statusVal === 'selesai',
                                    ])">
                                    {{ ucfirst($statusVal) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 flex-1 flex flex-col">
                            <div class="mb-4">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="font-bold text-lg text-neutral-900 dark:text-white line-clamp-1">{{ $laporan->lokasi }}</h3>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-neutral-500 dark:text-neutral-400 mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $laporan->created_at->format('d M Y, H:i') }}
                                </div>
                                <p class="text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3 bg-neutral-50 dark:bg-neutral-800 p-3 rounded-lg border border-neutral-100 dark:border-neutral-700">
                                    "{{ $laporan->keterangan }}"
                                </p>
                            </div>

                            <div class="mt-auto pt-4 border-t border-neutral-100 dark:border-neutral-800">
                                
                                {{-- AKSI UNTUK STATUS PENDING --}}
                                @if($statusVal === 'pending')
                                    <form method="POST" action="{{ route('admin.laporan.approveAssign', $laporan) }}" class="space-y-3">
                                        @csrf
                                        <div>
                                            <label class="text-xs font-medium text-neutral-500 dark:text-neutral-400 mb-1 block">Tugaskan Petugas:</label>
                                            <select name="petugas_id" class="w-full text-sm rounded-lg border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-700 dark:text-neutral-200 focus:ring-primary-500 focus:border-primary-500" required>
                                                <option value="">-- Pilih Petugas --</option>
                                                @foreach($admins as $admin)
                                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="w-full flex justify-center items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Setujui & Tugaskan
                                        </button>
                                    </form>

                                {{-- AKSI UNTUK STATUS DISETUJUI --}}
                                @elseif($statusVal === 'disetujui')
                                    <div class="text-center mb-3">
                                        <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded">Petugas: {{ $laporan->petugas->name ?? 'Belum ada' }}</span>
                                    </div>
                                    <form method="POST" action="{{ route('admin.laporan.start', $laporan) }}">
                                        @csrf
                                        <button class="w-full flex justify-center items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Mulai Kerjakan
                                        </button>
                                    </form>

                                {{-- AKSI UNTUK STATUS DIKERJAKAN --}}
                                @elseif($statusVal === 'dikerjakan')
                                    <form method="POST" action="{{ route('admin.laporan.finish', $laporan) }}" enctype="multipart/form-data" class="space-y-3">
                                        @csrf
                                        <div>
                                            <label class="text-xs font-medium text-neutral-500 dark:text-neutral-400 mb-1 block">Bukti Penyelesaian:</label>
                                            <input type="file" name="bukti_fotos[]" multiple accept="image/*" required class="block w-full text-xs text-neutral-500 file:mr-2 file:py-2 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-primary-900 dark:file:text-primary-300 cursor-pointer border border-neutral-300 dark:border-neutral-700 rounded-lg bg-neutral-50 dark:bg-neutral-800" />
                                        </div>
                                        <button class="w-full flex justify-center items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Selesaikan Laporan
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-neutral-100 dark:bg-neutral-800 mb-4">
                            <svg class="w-8 h-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-neutral-900 dark:text-white">Tidak ada laporan masuk</h3>
                        <p class="text-neutral-500 dark:text-neutral-400">Semua laporan telah diproses atau belum ada laporan baru.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-10 border-t border-neutral-200 dark:border-neutral-800 pt-6">
                {{ $laporans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>