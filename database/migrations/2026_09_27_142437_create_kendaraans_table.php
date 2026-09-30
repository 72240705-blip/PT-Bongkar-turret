<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            
            // Menggunakan unsignedBigInteger tanpa relasi foreign key kaku di level database
            $table->unsignedBigInteger('user_id')->index();

            $table->string('merk_model');
            $table->string('plat_nomor');
            $table->decimal('kapasitas_baterai_kwh', 8, 2);
            $table->string('tipe_konektor');
            $table->boolean('is_utama')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};