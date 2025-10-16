<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelass')->insert([
            ['nama_kelas' => 'Kelas A', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kelas' => 'Kelas B', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kelas' => 'Kelas P', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kelas' => 'Kelas N', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kelas' => 'Kelas X', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kelas' => 'Kelas Y', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
