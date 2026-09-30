<?php

namespace Database\Seeders;

use App\Models\Stasiun;
use App\Models\Konektor;
use Illuminate\Database\Seeder;

class StasiunSeeder extends Seeder
{
    public function run(): void
    {
        // 1. SPKLU Dekat UKDW / Timoho
        $stasiun1 = Stasiun::create([
            'nama_stasiun' => 'SPKLU PLN Dr. Sutomo (Dekat UKDW)',
            'alamat' => 'Jl. Dr. Sutomo No.45, Baciro, Kec. Gondokusuman, Kota Yogyakarta',
            'kota' => 'Yogyakarta',
            'latitude' => -7.7928000,
            'longitude' => 110.3789000,
            'status' => 'Aktif',
        ]);
        Konektor::create(['id_stasiun' => $stasiun1->id_stasiun, 'tipe_konektor' => 'CCS2 (Fast)', 'daya_kw' => 50, 'harga_per_kwh' => 2467, 'status' => 'Tersedia']);
        Konektor::create(['id_stasiun' => $stasiun1->id_stasiun, 'tipe_konektor' => 'Type 2 (AC)', 'daya_kw' => 22, 'harga_per_kwh' => 1650, 'status' => 'Tersedia']);

        // 2. SPKLU Area Tugu Jogja
        $stasiun2 = Stasiun::create([
            'nama_stasiun' => 'SPKLU PLN UP3 Yogyakarta (Tugu)',
            'alamat' => 'Jl. Margo Utomo No.58, Gowongan, Kec. Jetis, Kota Yogyakarta',
            'kota' => 'Yogyakarta',
            'latitude' => -7.7850000,
            'longitude' => 110.3665000,
            'status' => 'Aktif',
        ]);
        Konektor::create(['id_stasiun' => $stasiun2->id_stasiun, 'tipe_konektor' => 'CCS2 Ultra Fast', 'daya_kw' => 150, 'harga_per_kwh' => 2800, 'status' => 'Terpakai']);
        Konektor::create(['id_stasiun' => $stasiun2->id_stasiun, 'tipe_konektor' => 'CHAdeMO', 'daya_kw' => 50, 'harga_per_kwh' => 2467, 'status' => 'Tersedia']);

        // 3. SPKLU Area UGM
        $stasiun3 = Stasiun::create([
            'nama_stasiun' => 'SPKLU Kawasan UGM Gejayan',
            'alamat' => 'Jl. Pancasila, Bulaksumur, Caturtunggal, Sleman',
            'kota' => 'Sleman',
            'latitude' => -7.7705000,
            'longitude' => 110.3778000,
            'status' => 'Aktif',
        ]);
        Konektor::create(['id_stasiun' => $stasiun3->id_stasiun, 'tipe_konektor' => 'Type 2 (AC)', 'daya_kw' => 11, 'harga_per_kwh' => 1650, 'status' => 'Tersedia']);

        // 4. SPKLU Area Plaza Ambarrukmo
        $stasiun4 = Stasiun::create([
            'nama_stasiun' => 'SPKLU Plaza Ambarrukmo',
            'alamat' => 'Jl. Laksda Adisucipto No.80, Caturtunggal, Sleman',
            'kota' => 'Sleman',
            'latitude' => -7.7825000,
            'longitude' => 110.4010000,
            'status' => 'Aktif',
        ]);
        Konektor::create(['id_stasiun' => $stasiun4->id_stasiun, 'tipe_konektor' => 'CCS2 (Fast)', 'daya_kw' => 50, 'harga_per_kwh' => 2467, 'status' => 'Tersedia']);
    }
}