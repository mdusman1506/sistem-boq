<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterBarangJasa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_master_barang_jasa';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'tipe',
        'harga_material',
        'harga_jasa',
    ];

    public function boqDetails()
    {
        return $this->hasMany(BoqDetail::class, 'barang_jasa_id');
    }
}
