<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoqDetail extends Model
{
    use HasFactory;

    protected $table = 'tb_boq_detail';

    protected $fillable = [
        'boq_header_id',
        'barang_jasa_id',
        'lokasi_lantai',
        'lokasi_zona',
        'qty_kontrak',
        'qty_aktual',
        'harga_material_satuan',
        'harga_jasa_satuan',
    ];

    public function boqHeader()
    {
        return $this->belongsTo(BoqHeader::class, 'boq_header_id');
    }

    public function barangJasa()
    {
        return $this->belongsTo(MasterBarangJasa::class, 'barang_jasa_id');
    }
}
