<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - EVChargeHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login EVChargeHub</h2>

        @if(session('success'))
            <div class="bg-emerald-100 text-emerald-800 px-4 py-3 rounded-lg mb-4 text-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                <input type="password" name="kata_sandi" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
            <button type="submit" class="w-full py-3 bg-emerald-600 text-white rounded-lg font-bold hover:bg-emerald-700 transition">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun? <a href="{{ route('register') }}" class="text-emerald-600 font-semibold hover:underline">Daftar sekarang</a>
        </p>
    </div>
</body>
</html>