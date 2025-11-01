<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('lapor.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mb-4">
                Buat Laporan Baru
            </a>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Daftar Laporan Saya</h3>
                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-4 space-y-4">
                        @forelse ($laporanSaya as $laporan)
                            <div class="p-4 border rounded-md">
                                <div class="flex justify-between">
                                    <span class="font-bold">{{ $laporan->lokasi }}</span>
                                    <span class="text-sm font-medium
                                        @if($laporan->status == 'pending') text-yellow-600 @endif
                                        @if($laporan->status == 'disetujui') text-blue-600 @endif
                                        @if($laporan->status == 'dikerjakan') text-indigo-600 @endif
                                        @if($laporan->status == 'selesai') text-green-600 @endif
                                    ">
                                        {{ Str::ucfirst($laporan->status) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">{{ $laporan->keterangan }}</p>
                                <small class="text-xs text-gray-500">{{ $laporan->created_at->format('d M Y, H:i') }}</small>
                            </div>
                        @empty
                            <p>Anda belum pernah membuat laporan.</p>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $laporanSaya->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>