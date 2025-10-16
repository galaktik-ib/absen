<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelass';

    protected $fillable = [
        'nama_kelas',
    ];

    public function kelasMatkuls()
    {
        return $this->hasMany(MatkulKelas::class);
    }
}
