<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nomor_telp' => 'nullable|string|max:20',
            'kata_sandi' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'nomor_telp' => $request->nomor_telp,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'peran' => 'Pengemudi',
            'status_akun' => 'Belum Verifikasi',
            'otp_code' => '123456', // OTP Dummy
        ]);

        session(['pending_user_id' => $user->id_user]);

        return redirect()->route('otp.show')->with('info', 'Kode OTP Dummy Anda adalah: 123456');
    }

    public function showOtp()
    {
        if (!session('pending_user_id')) {
            return redirect()->route('login');
        }
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $userId = session('pending_user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('register')->with('error', 'Sesi verifikasi kadaluarsa.');
        }

        if ($request->otp === $user->otp_code || $request->otp === '123456') {
            $user->update([
                'status_akun' => 'Aktif',
                'email_verified_at' => now(),
                'otp_code' => null,
            ]);

            session()->forget('pending_user_id');

            return redirect()->route('login')->with('success', 'Akun berhasil diverifikasi! Silakan login.');
        }

        return back()->with('error', 'Kode OTP salah. Gunakan kode dummy: 123456');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->kata_sandi, $user->kata_sandi)) {
            return back()->with('error', 'Email atau kata sandi salah.');
        }

        if ($user->status_akun === 'Belum Verifikasi') {
            session(['pending_user_id' => $user->id_user]);
            return redirect()->route('otp.show')->with('info', 'Akun Anda belum terverifikasi. Masukkan OTP (123456).');
        }

        if ($user->status_akun === 'Diblokir') {
            return back()->with('error', 'Akun Anda telah diblokir. Hubungi admin.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }
}