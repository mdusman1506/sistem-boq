<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Proyek;
use App\Models\ChangeRequest;
use App\Models\BoqHeader;
use App\Models\BoqDetail;
use App\Models\MasterBarangJasa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WhiteBoxSystemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed users
        User::factory()->create(['role' => 'Admin']);
        User::factory()->create(['role' => 'Klien']);
        User::factory()->create(['role' => 'Site Manager']);
    }

    /**
     * Test role based access control for CCO index
     */
    public function test_only_admin_and_direktur_can_access_cco_index()
    {
        $admin = User::where('role', 'Admin')->first();
        $this->actingAs($admin)->get('/cco')->assertStatus(200);

        $klien = User::where('role', 'Klien')->first();
        $this->actingAs($klien)->get('/cco')->assertStatus(403);
    }

    /**
     * Test processing CCO logic duplicates BOQ correctly
     */
    public function test_processing_cco_creates_new_boq_revision()
    {
        $admin = User::where('role', 'Admin')->first();
        
        // Create mock data
        $proyek = Proyek::factory()->create();
        $barang = MasterBarangJasa::factory()->create();
        
        $boqLama = BoqHeader::create([
            'proyek_id' => $proyek->id,
            'nomor_surat' => 'SURAT-001',
            'versi_revisi' => 'Original',
            'status_approval' => 'Approved',
            'is_client_approved' => true,
        ]);

        BoqDetail::create([
            'boq_header_id' => $boqLama->id,
            'barang_jasa_id' => $barang->id,
            'qty_kontrak' => 10,
            'harga_material_satuan' => 1000,
            'harga_jasa_satuan' => 500
        ]);

        $cco = ChangeRequest::create([
            'proyek_id' => $proyek->id,
            'klien_id' => $klienId ?? 1,
            'subjek' => 'Perubahan Desain',
            'deskripsi_perubahan' => 'Menambahkan dinding',
            'status' => 'Pending',
        ]);

        $this->actingAs($admin)->post("/cco/{$cco->id}/process")->assertSessionHas('success');

        $this->assertDatabaseHas('tb_cco', [
            'id' => $cco->id,
            'status' => 'Diproses'
        ]);

        // Assert new BOQ is created with 'Draft' status
        $this->assertDatabaseHas('tb_boq_header', [
            'proyek_id' => $proyek->id,
            'status_approval' => 'Draft',
        ]);
        
        // Assert there are now 2 BOQ headers for this project
        $this->assertEquals(2, BoqHeader::where('proyek_id', $proyek->id)->count());
    }
}
