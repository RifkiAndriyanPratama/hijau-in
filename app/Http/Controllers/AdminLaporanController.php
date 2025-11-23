<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\FotoLaporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminLaporanController extends Controller
{
    protected function authorizeAdmin()
    {
        $user = Auth::user();
        if (!$user || strtolower($user->role->nama_role) !== 'admin') {
            abort(403);
        }
    }

    // Laporan masuk (pending / disetujui / dikerjakan) yang belum selesai
    public function index()
    {
        $this->authorizeAdmin();
        $laporans = Laporan::with(['pelapor','petugas','fotoLaporan'=>fn($q)=>$q->where('jenis','awal')])
            ->whereIn('status',['pending','disetujui','dikerjakan'])
            ->latest()
            ->paginate(12);

        $admins = User::whereHas('role', fn($q)=>$q->whereIn('nama_role',['Admin']))->get();
        return view('admin.laporan-masuk', compact('laporans','admins'));
    }

    // Setujui & tugaskan petugas
    public function approveAssign(Request $request, Laporan $laporan)
    {
        $this->authorizeAdmin();
        $request->validate([
            'petugas_id' => 'required|exists:users,id'
        ]);
        if ($laporan->status->value !== 'pending') {
            return back()->with('error','Status harus pending untuk disetujui');
        }
        $laporan->update([
            'status' => 'disetujui',
            'petugas_id' => $request->petugas_id,
            'dinas_id' => Auth::id(),
        ]);
        return back()->with('success','Laporan disetujui dan petugas ditugaskan');
    }

    // Tandai mulai dikerjakan (oleh petugas yang ditugaskan)
    public function startWork(Laporan $laporan)
    {
        $this->authorizeAdmin();
        if ($laporan->status->value !== 'disetujui') {
            return back()->with('error','Status harus disetujui');
        }
        $laporan->update(['status'=>'dikerjakan']);
        return back()->with('success','Status diubah ke dikerjakan');
    }

    // Upload bukti dan tandai selesai
    public function finish(Request $request, Laporan $laporan)
    {
        $this->authorizeAdmin();
        if ($laporan->status->value !== 'dikerjakan') {
            return back()->with('error','Status harus dikerjakan');
        }
        $request->validate([
            'bukti_fotos' => 'required|array|max:5',
            'bukti_fotos.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);
        if ($request->hasFile('bukti_fotos')) {
            foreach ($request->file('bukti_fotos') as $foto) {
                $path = $foto->store('laporan/bukti','public');
                FotoLaporan::create([
                    'laporan_id' => $laporan->id,
                    'path_file' => $path,
                    'jenis' => 'bukti'
                ]);
            }
        }
        $laporan->update(['status'=>'selesai']);
        return back()->with('success','Laporan ditandai selesai dengan bukti foto');
    }
}
