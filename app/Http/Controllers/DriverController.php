<?php

namespace App\Http\Controllers;

use App\Models\Stasiun;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Stasiun::with('konektors')->where('status', 'Aktif');

        // Fitur Pencarian berdasarkan Nama atau Kota
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_stasiun', 'like', "%{$search}%")
                  ->orWhere('kota', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        $stasiuns = $query->get();

        return view('driver.dashboard', compact('stasiuns'));
    }
}