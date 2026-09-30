<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVChargeHub - Solusi Pengisian Daya Kendaraan Listrik</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Header / Navbar -->
    <header class="bg-emerald-600 text-white shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-bolt text-yellow-300 text-2xl"></i>
                <span class="font-bold text-xl tracking-wide">EVChargeHub</span>
            </div>
            <div class="space-x-3">
                <a href="/login" class="px-4 py-2 rounded-lg text-sm font-semibold bg-emerald-700 hover:bg-emerald-800 transition">Masuk</a>
                <a href="/register" class="px-4 py-2 rounded-lg text-sm font-semibold bg-yellow-400 text-emerald-950 hover:bg-yellow-300 transition">Daftar</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block p-4 bg-emerald-100 rounded-full mb-6">
                <i class="fa-solid fa-charging-station text-emerald-600 text-5xl"></i>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                Temukan & Isi Daya Kendaraan Listrik Anda
            </h1>
            <p class="text-base md:text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Layanan pengisian daya kendaraan listrik terpadu. Cari stasiun terdekat, pantau status pengisian secara langsung, dan lakukan pembayaran dengan mudah.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/register" class="px-6 py-3 rounded-xl bg-white border border-gray-300 text-gray-700 font-bold hover:bg-gray-100 transition">
                    Belum Punya Akun?
                </a>
                <a href="/login" class="px-6 py-3 rounded-xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 shadow-lg transition"
>
                    Login
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 text-center py-4 text-sm border-t border-gray-800">
        &copy; {{ date('Y') }} EVChargeHub. Project by PT Bongkar Turret.
    </footer>

</body>
</html>