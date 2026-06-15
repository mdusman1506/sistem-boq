<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketPemeliharaan extends Model
{
    use HasFactory;

    protected $table = 'tb_tiket_pemeliharaan';

    protected $fillable = [
        'proyek_id',
        'pelapor_id',
        'subjek',
        'deskripsi',
        'foto_kerusakan',
        'foto_perbaikan',
        'status',
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }

    public function pelapor()
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }
}
