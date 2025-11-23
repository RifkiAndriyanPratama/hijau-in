<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Laporan;
use App\Enums\LaporanStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LaporanFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Role::factory()->create(['nama_role'=>'Superadmin']);
        Role::factory()->create(['nama_role'=>'Admin']);
        Role::factory()->create(['nama_role'=>'Masyarakat']);
    }

    public function test_masyarakat_can_create_laporan_and_admin_can_approve(): void
    {
        $masyarakatRole = Role::where('nama_role','Masyarakat')->first();
        $adminRole = Role::where('nama_role','Admin')->first();
        $secondAdminRole = Role::where('nama_role','Admin')->first();

        $masyarakat = User::factory()->create(['role_id'=>$masyarakatRole->id]);
        $admin = User::factory()->create(['role_id'=>$adminRole->id]);
        $penanggungJawab = User::factory()->create(['role_id'=>$secondAdminRole->id]);

        // Create laporan by masyarakat
        $this->actingAs($masyarakat);
        $laporan = Laporan::factory()->create([
            'pelapor_id'=>$masyarakat->id,
            'nama_pelapor'=>$masyarakat->name,
        ]);
        $this->assertSame(LaporanStatus::Pending, $laporan->status);

        // Approve & assign (Penanggung Jawab) by admin
        $this->actingAs($admin);
        $laporan->update([
            'status'=>LaporanStatus::Disetujui->value,
            'petugas_id'=>$penanggungJawab->id,
            'dinas_id'=>$admin->id,
        ]);
        $laporan->refresh();
        $this->assertSame(LaporanStatus::Disetujui, $laporan->status);

        // Penanggung Jawab starts work
        $this->actingAs($penanggungJawab);
        $laporan->update(['status'=>LaporanStatus::Dikerjakan->value]);
        $laporan->refresh();
        $this->assertSame(LaporanStatus::Dikerjakan, $laporan->status);

        // Finish
        $laporan->update(['status'=>LaporanStatus::Selesai->value]);
        $laporan->refresh();
        $this->assertSame(LaporanStatus::Selesai, $laporan->status);

        // Attempt illegal transition (Selesai -> Pending) should throw
        $this->expectException(\RuntimeException::class);
        $laporan->update(['status'=>LaporanStatus::Pending->value]);
    }
}