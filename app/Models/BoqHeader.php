<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoqHeader extends Model
{
    use HasFactory;

    protected $table = 'tb_boq_header';

    protected $fillable = [
        'proyek_id',
        'nomor_surat',
        'versi_revisi',
        'status_approval',
        'file_bukti_lapangan',
        'catatan_sitemanager',
        'keterangan_revisi',
        'is_client_approved',
        'client_approved_at',
        'client_approved_by'
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }

    public function boqDetails()
    {
        return $this->hasMany(BoqDetail::class, 'boq_header_id');
    }
}
