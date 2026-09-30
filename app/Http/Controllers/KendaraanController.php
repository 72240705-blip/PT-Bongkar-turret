<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        $kendaraans = Kendaraan::where('user_id', $userId)
            ->orderBy('is_utama', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('driver.kendaraan.index', compact('kendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk_model' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:20',
            'kapasitas_baterai_kwh' => 'required|numeric|min:1',
            'tipe_konektor' => 'required|string',
        ]);

        $userId = Auth::id();
        $isFirstVehicle = Kendaraan::where('user_id', $userId)->count() === 0;
        $isUtama = $isFirstVehicle || $request->has('is_utama');

        if ($isUtama) {
            Kendaraan::where('user_id', $userId)->update(['is_utama' => 0]);
        }

        Kendaraan::create([
            'user_id' => $userId,
            'merk_model' => $request->merk_model,
            'plat_nomor' => strtoupper($request->plat_nomor),
            'kapasitas_baterai_kwh' => $request->kapasitas_baterai_kwh,
            'tipe_konektor' => $request->tipe_konektor,
            'is_utama' => $isUtama ? 1 : 0,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function setUtama($id)
    {
        $userId = Auth::id();

        Kendaraan::where('user_id', $userId)->update(['is_utama' => 0]);
        Kendaraan::where('id', $id)->where('user_id', $userId)->update(['is_utama' => 1]);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan utama berhasil diubah!');
    }

    public function destroy($id)
    {
        $userId = Auth::id();

        $kendaraan = Kendaraan::where('id', $id)->where('user_id', $userId)->firstOrFail();
        $isUtama = $kendaraan->is_utama;

        $kendaraan->delete();

        if ($isUtama) {
            $nextVehicle = Kendaraan::where('user_id', $userId)->first();
            if ($nextVehicle) {
                $nextVehicle->update(['is_utama' => 1]);
            }
        }

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus!');
    }
}