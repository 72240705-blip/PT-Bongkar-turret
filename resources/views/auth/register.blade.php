<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengemudi - EVChargeHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4 py-8">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <div class="text-center mb-6">
            <div class="inline-block p-3 bg-emerald-100 rounded-full mb-2">
                <i class="fa-solid fa-user-plus text-emerald-600 text-3xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Registrasi Akun Pengemudi</h2>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                <ul class="list-disc pl-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                <input type="text" name="nomor_telp" value="{{ old('nomor_telp') }}" placeholder="08xxxxxxxxxx" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                <input type="password" name="kata_sandi" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                <input type="password" name="kata_sandi_confirmation" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
            <button type="submit" class="w-full py-3 bg-emerald-600 text-white rounded-lg font-bold hover:bg-emerald-700 transition">
                Daftar & Dapatkan OTP
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-emerald-600 font-semibold hover:underline">Masuk di sini</a>
        </p>
    </div>
</body>
</html>