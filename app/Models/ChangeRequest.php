<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeRequest extends Model
{
    use HasFactory;

    protected $table = 'tb_change_requests';

    protected $fillable = [
        'proyek_id',
        'klien_id',
        'diajukan_oleh',
        'subjek',
        'deskripsi_perubahan',
        'lampiran',
        'status',
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }

    public function klien()
    {
        return $this->belongsTo(Klien::class, 'klien_id');
    }

    public function pelapor()
    {
        return $this->belongsTo(User::class, 'diajukan_oleh');
    }
}
