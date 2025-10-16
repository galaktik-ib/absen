<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $table = 'absens';

    protected $fillable = [
        'matkul_kelas_id',
        'tanggal',
    ];

    public function matkulKelas()
    {
        return $this->belongsTo(MatkulKelas::class);
    }
}
