<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matkul_kelass', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matkul_id')->constrained('matkuls')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelass')->onDelete('cascade');
            $table->foreignId('dosen_id')->constrained('dosens')->onDelete('cascade');
            $table->foreignId('asisten_id')->constrained('asistens')->onDelete('cascade');
            $table->foreignId('asisten2_id')->nullable()->constrained('asistens')->onDelete('cascade');
            $table->string('lab');
            $table->string('hari')->nullable();
            $table->string('jam')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matkul_kelass');
    }
};
