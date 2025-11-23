<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Buat Laporan Baru</h2>
    </x-slot>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold tracking-tight">Laporkan Masalah Lingkungan</h1>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-2">Isi detail berikut. Foto dan koordinat membantu verifikasi lebih cepat.</p>
        </div>
          <form method="POST" action="{{ route('lapor.store') }}" enctype="multipart/form-data" id="form-laporan"
              class="space-y-8 bg-white/80 dark:bg-neutral-900/60 backdrop-blur-xl supports-[backdrop-filter]:bg-white/60 dark:supports-[backdrop-filter]:bg-neutral-900/50 border border-neutral-200/60 dark:border-neutral-700 rounded-2xl p-8 shadow-lg shadow-neutral-900/5 dark:shadow-black/30 text-neutral-800 dark:text-neutral-200">
            @csrf
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs uppercase tracking-wide font-semibold mb-2 text-neutral-700 dark:text-neutral-200">Tipe Masalah</label>
                        <select name="tipe_masalah" required
                            class="peer w-full rounded-lg px-3 py-2 text-sm bg-white/90 dark:bg-neutral-800/80 border border-neutral-300 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition shadow-sm text-neutral-800 dark:text-neutral-100 placeholder:text-neutral-500 dark:placeholder:text-neutral-500">
                            @foreach(\App\Models\Laporan::TIPE_MASALAH as $tipe)
                                <option value="{{ $tipe }}">{{ ucwords(str_replace('_',' ',$tipe)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-wide font-semibold mb-2 text-neutral-700 dark:text-neutral-200">Lokasi (alamat / patokan)</label>
                           <input type="text" name="lokasi" required maxlength="255" placeholder="Contoh: Dekat TPS Jalan Mawar"
                               class="w-full rounded-lg px-3 py-2 text-sm bg-white/90 dark:bg-neutral-800/80 border border-neutral-300 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition shadow-sm text-neutral-800 dark:text-neutral-100 placeholder:text-neutral-500 dark:placeholder:text-neutral-500" />
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-wide font-semibold mb-2 text-neutral-700 dark:text-neutral-200">Keterangan</label>
                        <textarea name="keterangan" rows="5" required placeholder="Jelaskan kondisi, dampak, dan perkiraan waktu muncul"
                                  class="w-full rounded-lg px-3 py-2 text-sm bg-white/90 dark:bg-neutral-800/80 border border-neutral-300 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition shadow-sm resize-y text-neutral-800 dark:text-neutral-100 placeholder:text-neutral-500 dark:placeholder:text-neutral-500"></textarea>
                        <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-1">Informasi jelas membantu prioritas penanganan.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" id="btn-geolocate" class="px-4 py-2 rounded-md bg-primary-600/90 hover:bg-primary-500 text-neutral-50 text-xs font-semibold tracking-wide shadow-sm transition focus:outline-none focus:ring-2 focus:ring-primary-500">Gunakan Lokasi Saya</button>
                        <p id="geo-status" class="text-xs text-neutral-500 dark:text-neutral-400">Koordinat belum diambil.</p>
                    </div>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                </div>
                <div class="space-y-6">
                    <label class="block text-xs uppercase tracking-wide font-semibold text-neutral-700 dark:text-neutral-200">Foto Bukti (maks 5)</label>
                    <div id="drop-zone" class="border border-dashed rounded-xl p-6 text-center cursor-pointer transition bg-neutral-100/70 hover:bg-neutral-50 dark:bg-neutral-800/60 dark:hover:bg-neutral-800 supports-[backdrop-filter]:bg-neutral-100/40 dark:supports-[backdrop-filter]:bg-neutral-800/40 backdrop-blur-md border-neutral-300 dark:border-neutral-600 text-neutral-700 dark:text-neutral-200">
                        <p class="text-sm font-medium mb-1">Tarik & Letakkan foto di sini</p>
                        <p class="text-xs text-neutral-600 dark:text-neutral-400">atau klik untuk memilih. Format: jpg/png/jpeg/gif, maks 2MB.</p>
                        <p class="text-xs mt-2 text-neutral-600 dark:text-neutral-300" id="file-count">0 / 5 dipilih</p>
                        <input id="fotosInput" class="sr-only" type="file" name="fotos[]" multiple accept="image/*" required>
                    </div>
                    <div id="preview-wrapper" class="grid grid-cols-3 gap-3"></div>
                </div>
            </div>
            <div class="pt-2 flex flex-col md:flex-row gap-4 md:gap-2 md:justify-between md:items-center">
                <p class="text-[11px] text-neutral-500 dark:text-neutral-400">Pastikan data benar sebelum kirim. Foto membantu verifikasi.</p>
                <x-primary-button class="bg-primary-600 hover:bg-primary-500 shadow-sm px-6 py-2.5 rounded-lg text-sm font-semibold">Buat Laporan</x-primary-button>
            </div>
        </form>
    </div>
    <script>
    (function(){
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('fotosInput');
        const previewWrapper = document.getElementById('preview-wrapper');
        const fileCount = document.getElementById('file-count');
        const geobtn = document.getElementById('btn-geolocate');
        const geoStatus = document.getElementById('geo-status');
        const latEl = document.getElementById('latitude');
        const lngEl = document.getElementById('longitude');
        const MAX_FILES = 5; const MAX_SIZE = 2 * 1024 * 1024; // 2MB

        function updateCount(){
            fileCount.textContent = `${fileInput.files.length} / ${MAX_FILES} dipilih`;
        }
        function renderPreviews(){
            previewWrapper.innerHTML='';
            [...fileInput.files].forEach((file, idx)=>{
                const url = URL.createObjectURL(file);
                const cell = document.createElement('div');
                cell.className='relative group';
                cell.innerHTML = `<img src="${url}" alt="preview" class="h-24 w-full object-cover rounded-lg shadow"/><button type="button" data-idx="${idx}" class="absolute top-1 right-1 bg-black/60 text-white text-xs px-2 py-0.5 rounded opacity-0 group-hover:opacity-100 transition">Hapus</button>`;
                previewWrapper.appendChild(cell);
            });
        }
        previewWrapper.addEventListener('click', e=>{
            if(e.target.matches('button[data-idx]')){
                const removeIdx = parseInt(e.target.getAttribute('data-idx'));
                const dt = new DataTransfer();
                [...fileInput.files].forEach((f,i)=>{ if(i!==removeIdx) dt.items.add(f); });
                fileInput.files = dt.files; updateCount(); renderPreviews();
            }
        });
        function validateAndAssign(files){
            const dt = new DataTransfer();
            let count = 0;
            for(const f of files){
                if(count >= MAX_FILES) break;
                if(!f.type.startsWith('image/')) continue;
                if(f.size > MAX_SIZE){
                    alert(`File ${f.name} melebihi 2MB dan di-skip.`); continue;
                }
                dt.items.add(f); count++;
            }
            fileInput.files = dt.files; updateCount(); renderPreviews();
        }
        dropZone.addEventListener('click', ()=> fileInput.click());
        fileInput.addEventListener('change', ()=> validateAndAssign(fileInput.files));
        ['dragenter','dragover'].forEach(ev=> dropZone.addEventListener(ev, e=>{e.preventDefault(); dropZone.classList.add('bg-primary-100');}));
        ['dragleave','drop'].forEach(ev=> dropZone.addEventListener(ev, e=>{e.preventDefault(); if(ev==='drop'){validateAndAssign(e.dataTransfer.files);} dropZone.classList.remove('bg-primary-100');}));

        geobtn.addEventListener('click', ()=>{
            if(!navigator.geolocation){ geoStatus.textContent='Geolokasi tidak didukung.'; return; }
            geoStatus.textContent='Mengambil lokasi...';
            navigator.geolocation.getCurrentPosition(pos=>{
                latEl.value = pos.coords.latitude.toFixed(7);
                lngEl.value = pos.coords.longitude.toFixed(7);
                geoStatus.textContent='Koordinat diambil.';
                geoStatus.classList.remove('text-neutral-500');
                geoStatus.classList.add('text-green-600');
            }, err=>{
                geoStatus.textContent='Gagal mengambil lokasi.';
                geoStatus.classList.remove('text-neutral-500');
                geoStatus.classList.add('text-red-600');
            }, { enableHighAccuracy:true, timeout:10000, maximumAge:0 });
        });
    })();
    </script>
</x-app-layout>