<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asisten extends Model
{
    use HasFactory;
    protected $table = 'asistens';

    protected $fillable = [
        'nama_asisten',
    ];

    public function kelasMatkuls()
    {
        return $this->hasMany(MatkulKelas::class);
    }
}
