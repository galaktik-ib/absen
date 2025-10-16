<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulKelas extends Model
{
    use HasFactory;

    protected $table = 'matkul_kelass';

    protected $fillable = [
        'matkul_id',
        'kelas_id',
        'dosen_id',
        'asisten_id',
        'asisten2_id',
        'lab',
        'hari',
        'jam', 
    ];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function asisten()
    {
        return $this->belongsTo(Asisten::class);
    }

    public function absens()
    {
        return $this->hasMany(Absen::class);
    }

    public function asisten2()
    {
        return $this->belongsTo(Asisten::class, 'asisten2_id');
    }
}
