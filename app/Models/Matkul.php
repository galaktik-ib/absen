<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $table = 'matkuls';
    protected $fillable = [
        'nama_matkul',
    ];
    public function kelasMatkuls()
    {
        return $this->hasMany(MatkulKelas::class);
    }
}
