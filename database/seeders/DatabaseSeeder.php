<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 1 Akun Pengemudi Contoh (Opsional untuk testing cepat)
        User::create([
            'nama_lengkap' => 'Arry Pengemudi',
            'email' => 'arry@example.com',
            'kata_sandi' => Hash::make('password123'),
            'peran' => 'Pengemudi',
            'status_akun' => 'Aktif',
        ]);

        // 2. Jalankan StasiunSeeder (Lokasi Jogja)
        $this->call([
            StasiunSeeder::class,
        ]);
    }
}