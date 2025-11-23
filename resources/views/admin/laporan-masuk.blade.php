<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold">Laporan Masuk</h1>
            <div class="text-sm text-neutral-500">Pending / Disetujui / Dikerjakan</div>
        </div>
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-600/10 text-green-600 text-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-600/10 text-red-600 text-sm">{{ session('error') }}</div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($laporans as $laporan)
                <div class="border rounded-xl bg-neutral-900/60 backdrop-blur-xl border-neutral-800 p-4 flex flex-col">
                    @php $thumb = $laporan->fotoLaporan->first(); @endphp
                    @if($thumb)
                        <img src="{{ asset('storage/'.$thumb->path_file) }}" alt="Foto" class="w-full h-40 object-cover rounded mb-3">
                    @endif
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <div>
                            <div class="font-semibold">{{ $laporan->lokasi }}</div>
                            <small class="text-xs text-neutral-400">{{ $laporan->created_at->format('d M Y, H:i') }}</small>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full border border-neutral-700 @class([
                            'text-amber-400'=> $laporan->status->value==='pending',
                            'text-blue-400'=> $laporan->status->value==='disetujui',
                            'text-indigo-400'=> $laporan->status->value==='dikerjakan',
                        ])">{{ ucfirst($laporan->status->value) }}</span>
                    </div>
                    <p class="text-sm text-neutral-300 line-clamp-4">{{ $laporan->keterangan }}</p>
                    <div class="mt-4 space-y-2">
                        @if($laporan->status->value==='pending')
                            <form method="POST" action="{{ route('admin.laporan.approveAssign',$laporan) }}" class="space-y-2">
                                @csrf
                                <select name="petugas_id" class="w-full bg-neutral-800 border border-neutral-700 rounded px-2 py-1 text-sm text-neutral-200" required>
                                    <option value="">Pilih Petugas (Admin)</option>
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                                <button class="w-full text-xs font-semibold px-3 py-2 rounded bg-green-600 hover:bg-green-500 text-white">Setujui & Tugaskan</button>
                            </form>
                        @elseif($laporan->status->value==='disetujui')
                            <form method="POST" action="{{ route('admin.laporan.start',$laporan) }}">
                                @csrf
                                <button class="w-full text-xs font-semibold px-3 py-2 rounded bg-indigo-600 hover:bg-indigo-500 text-white">Mulai Kerjakan</button>
                            </form>
                        @elseif($laporan->status->value==='dikerjakan')
                            <form method="POST" action="{{ route('admin.laporan.finish',$laporan) }}" enctype="multipart/form-data" class="space-y-2">
                                @csrf
                                <input type="file" name="bukti_fotos[]" multiple accept="image/*" required class="w-full text-xs file:mr-2 file:px-2 file:py-1 file:rounded file:border-0 file:bg-neutral-700 file:text-neutral-100 border border-neutral-700 rounded bg-neutral-800 text-neutral-200" />
                                <button class="w-full text-xs font-semibold px-3 py-2 rounded bg-emerald-600 hover:bg-emerald-500 text-white">Unggah Bukti & Selesaikan</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-neutral-400 py-12">Tidak ada laporan masuk.</div>
            @endforelse
        </div>
        <div class="mt-8">{{ $laporans->links() }}</div>
    </div>
</x-app-layout>
