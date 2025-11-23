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
        $laporanSaya = Laporan::with('fotoLaporan')
            ->where('pelapor_id', Auth::id())
            ->latest()
            ->paginate(10);
        // Statistik global untuk meniru tampilan beranda
        $total = Laporan::count();
        $pending = Laporan::where('status','pending')->count();
        $selesai = Laporan::where('status','selesai')->count();
        return view('dashboard', compact('laporanSaya','total','pending','selesai'));
    }

    // Hanya daftar laporan saya (tanpa hero dan statistik)
    public function myReports()
    {
        $laporanSaya = Laporan::with('fotoLaporan')
            ->where('pelapor_id', Auth::id())
            ->latest()
            ->paginate(12);
        return view('laporan-saya', compact('laporanSaya'));
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
            'tipe_masalah' => 'required|string|in:' . implode(',', \App\Models\Laporan::TIPE_MASALAH),
            'fotos' => 'required|array|max:5',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $laporan = Laporan::create([
            'pelapor_id' => Auth::id(),
            // nama_pelapor diisi otomatis di model boot
            'status' => 'pending',
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'tipe_masalah' => $request->tipe_masalah,
        ]);

        // Upload dan simpan foto
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('laporan', 'public');
                FotoLaporan::create([
                    'laporan_id' => $laporan->id,
                    'path_file' => $path,
                    'jenis' => 'awal',
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dikirim!');
    }

    public function destroy(Laporan $laporan)
    {
        if ($laporan->pelapor_id !== Auth::id()) {
            abort(403);
        }
        $laporan->delete();
        return redirect()->route('laporan.saya')->with('success','Laporan berhasil dihapus.');
    }
}
