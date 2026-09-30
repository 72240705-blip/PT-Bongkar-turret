<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stasiuns', function (Blueprint $table) {
            $table->id('id_stasiun');
            $table->string('nama_stasiun');
            $table->text('alamat');
            $table->string('kota');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('status', ['Aktif', 'Perbaikan', 'Non-Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stasiuns');
    }
};