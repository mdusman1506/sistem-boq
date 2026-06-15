<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Klien extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_klien';

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'kontak_person',
        'telepon',
    ];

    public function proyek()
    {
        return $this->hasMany(Proyek::class, 'klien_id');
    }
}
