<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konektors', function (Blueprint $table) {
            $table->id('id_konektor');
            $table->foreignId('id_stasiun')->constrained('stasiuns', 'id_stasiun')->onDelete('cascade');
            $table->string('tipe_konektor'); // Misal: CCS2, Type 2, CHAdeMO
            $table->integer('daya_kw'); // Misal: 50 kW, 150 kW
            $table->decimal('harga_per_kwh', 10, 2); // Misal: 2467.00
            $table->enum('status', ['Tersedia', 'Terpakai', 'Rusak'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konektors');
    }
};