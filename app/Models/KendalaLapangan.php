<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KendalaLapangan extends Model
{
    use HasFactory;

    protected $table = 'tb_kendala_lapangan';

    protected $fillable = [
        'proyek_id',
        'user_id',
        'judul_kendala',
        'deskripsi',
        'foto_kendala',
        'status',
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
