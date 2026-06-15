<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyek extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_proyek';

    protected $fillable = [
        'klien_id',
        'site_manager_id',
        'nama_proyek',
        'status_proyek',
    ];

    public function klien()
    {
        return $this->belongsTo(Klien::class, 'klien_id');
    }

    public function siteManager()
    {
        return $this->belongsTo(User::class, 'site_manager_id');
    }

    public function boqHeaders()
    {
        return $this->hasMany(BoqHeader::class, 'proyek_id');
    }

    public function laporanHarian()
    {
        return $this->hasMany(LaporanHarian::class, 'proyek_id')->orderBy('tanggal', 'desc');
    }

    public function kendalaLapangan()
    {
        return $this->hasMany(KendalaLapangan::class, 'proyek_id')->orderBy('created_at', 'desc');
    }
}
