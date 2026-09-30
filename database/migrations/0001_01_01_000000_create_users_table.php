<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('nomor_telp')->nullable();
            $table->string('kata_sandi');
            $table->enum('peran', ['Pengemudi', 'Operator', 'Admin'])->default('Pengemudi');
            $table->enum('status_akun', ['Aktif', 'Belum Verifikasi', 'Diblokir'])->default('Belum Verifikasi');
            $table->string('otp_code', 6)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};