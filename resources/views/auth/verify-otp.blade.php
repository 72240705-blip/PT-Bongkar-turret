<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - EVChargeHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Masukkan Kode OTP</h2>
        <p class="text-gray-500 text-sm mb-4">Gunakan kode dummy: <strong class="text-emerald-600 font-bold">123456</strong></p>

        @if(session('info'))
            <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg mb-4 text-sm">{{ session('info') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded-lg mb-4 text-sm">{{ session('error') }}</div>
        @endif

        <form action="{{ route('otp.post') }}" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="otp" maxlength="6" required placeholder="123456" class="w-full text-center text-2xl tracking-widest font-mono py-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            <button type="submit" class="w-full py-3 bg-emerald-600 text-white rounded-lg font-bold hover:bg-emerald-700 transition">
                Verifikasi
            </button>
        </form>
    </div>
</body>
</html>