<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\FotoLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanPublikController extends Controller
{
    // Tampilkan dashboard (daftar laporan milik user)
    public function index()
    {
        $laporanSaya = Laporan::where('pelapor_id', Auth::id())
                            ->latest()
                            ->paginate(10);
        return view('dashboard', compact('laporanSaya'));
    }

    // Tampilkan form buat laporan
    public function create()
    {
        return view('lapor.create'); // Kita akan buat view ini
    }

    // Simpan laporan baru
    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'fotos' => 'required|array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi foto
        ]);

        $laporan = Laporan::create([
            'pelapor_id' => Auth::id(),
            'nama_pelapor' => Auth::user()->nama,
            'status' => 'pending',
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
        ]);

        // Upload dan simpan foto
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('laporan', 'public');
                FotoLaporan::create([
                    'laporan_id' => $laporan->id,
                    'path_file' => $path,
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dikirim!');
    }
}
