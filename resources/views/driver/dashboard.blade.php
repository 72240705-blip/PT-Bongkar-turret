<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengemudi - EVChargeHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body class="bg-slate-100 min-h-screen text-slate-800 flex flex-col font-sans">

    <!-- Header / Navbar Atas Rapi -->
    <header class="bg-emerald-600 text-white shadow-md sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">
            
            <!-- Logo & Brand -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white text-emerald-600 flex items-center justify-center font-bold text-xl shadow-inner">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div>
                    <h1 class="font-bold text-white text-lg leading-tight tracking-wide">EVChargeHub</h1>
                    <p class="text-[11px] text-emerald-100 font-medium">Stasiun Pengisian Listrik</p>
                </div>
            </div>

            <!-- Profile User & Logout -->
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-[10px] text-emerald-200 uppercase font-semibold tracking-wider">Pengemudi</p>
                    <p class="text-xs font-bold text-white">{{ auth()->user()->nama_lengkap }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3.5 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 border border-emerald-500/50">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
                    </button>
                </form>
            </div>

        </div>
    </header>

    <!-- Main Layout -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 w-full flex-grow">
        
        <!-- Form Pencarian Atas -->
        <div class="mb-6">
            <form action="{{ route('dashboard') }}" method="GET" class="flex gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan lokasi atau nama stasiun..." class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none text-sm placeholder-slate-400">
                </div>
                <button type="submit" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-2xl hover:bg-emerald-700 shadow-md transition text-sm flex items-center gap-2">
                    <i class="fa-solid fa-search"></i> Cari Lokasi
                </button>
            </form>
        </div>

        <!-- Layout Utama dengan Sidebar Terkunci + Konten Kanan -->
        <div class="flex flex-col lg:flex-row gap-6 items-start">
            
            <!-- SIDEBAR NAVIGASI KIRI (LEBAR DIKUNCI MATI) -->
            <aside class="w-full lg:w-64 flex-shrink-0 bg-white rounded-2xl border border-slate-200/80 p-3 shadow-sm sticky top-20">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-3 mb-2">NAVIGASI UTAMA</p>
                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}" class="w-full px-3.5 py-2.5 rounded-xl bg-emerald-50 text-emerald-700 font-bold text-xs flex items-center gap-3 transition border border-emerald-200/60">
                        <i class="fa-solid fa-compass text-emerald-600 text-sm"></i> Beranda
                    </a>
                    <a href="{{ route('kendaraan.index') }}" class="w-full px-3.5 py-2.5 rounded-xl text-slate-600 hover:text-emerald-700 hover:bg-slate-50 font-medium text-xs flex items-center gap-3 transition">
                        <i class="fa-solid fa-car text-slate-400 text-sm"></i> Kendaraan Saya
                    </a>
                    <a href="#" class="w-full px-3.5 py-2.5 rounded-xl text-slate-600 hover:text-emerald-700 hover:bg-slate-50 font-medium text-xs flex items-center gap-3 transition">
                        <i class="fa-solid fa-clock-rotate-left text-slate-400 text-sm"></i> Riwayat
                    </a>
                    <a href="#" class="w-full px-3.5 py-2.5 rounded-xl text-slate-600 hover:text-emerald-700 hover:bg-slate-50 font-medium text-xs flex items-center gap-3 transition">
                        <i class="fa-solid fa-user text-slate-400 text-sm"></i> Profil
                    </a>
                </nav>
            </aside>

            <!-- KONTEN BERANDA (DAFTAR STASIUN + PETA) -->
            <div class="flex-1 w-full grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- DAFTAR STASIUN -->
                <div class="lg:col-span-5 space-y-3 max-h-[72vh] overflow-y-auto pr-1">
                    <div class="flex items-center justify-between px-1 mb-1">
                        <h2 class="font-bold text-slate-800 text-base">Daftar Stasiun</h2>
                        <span class="text-xs px-2.5 py-1 bg-slate-200 text-slate-700 font-bold rounded-full">{{ count($stasiuns) }} Lokasi</span>
                    </div>

                    @php
                        $isEmpty = true;
                    @endphp

                    @php foreach($stasiuns as$stasiun): @endphp
                        @php $isEmpty = false; @endphp
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-sm hover:shadow-md hover:border-emerald-500 transition cursor-pointer" onclick="showDetail({{ json_encode($stasiun) }})">
                            <div class="flex justify-between items-start gap-2">
                                <h3 class="font-bold text-slate-800 text-sm leading-snug">{{ $stasiun->nama_stasiun }}</h3>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                                    {{ $stasiun->kota }}
                                </span>
                            </div>
                            
                            <p class="text-xs text-slate-500 my-2 flex items-center gap-1.5">
                                <i class="fa-solid fa-location-dot text-rose-500"></i>
                                <span class="truncate">{{ $stasiun->alamat }}</span>
                            </p>

                            <!-- Ringkasan Konektor -->
                            <div class="mt-3 pt-3 border-t border-slate-100 flex justify-between items-center">
                                <span class="text-xs text-slate-500">
                                    <i class="fa-solid fa-plug text-emerald-600 mr-1"></i> {{ count($stasiun->konektors) }} Konektor Tersedia
                                </span>
                                <span class="text-xs font-bold text-emerald-600 hover:underline">
                                    Lihat Detail &rarr;
                                </span>
                            </div>
                        </div>
                    @php endforeach; @endphp

                    @if($isEmpty)
                        <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-400">
                            <i class="fa-solid fa-charging-station text-4xl mb-3 text-slate-300"></i>
                            <p class="text-sm font-medium">Stasiun pengisian tidak ditemukan.</p>
                        </div>
                    @endif
                </div>

                <!-- PETA INTERAKTIF -->
                <div class="lg:col-span-7">
                    <div class="bg-white p-2 rounded-2xl border border-slate-200 shadow-sm h-[72vh] sticky top-20">
                        <div id="map" class="w-full h-full rounded-xl z-10"></div>
                    </div>
                </div>

            </div>

        </div>

    </main>

    <!-- MODAL DETAIL STASIUN -->
    <div id="detailModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl relative">
            <button onclick="closeModal()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-charging-station"></i>
                </div>
                <div>
                    <span id="modalKota" class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200"></span>
                    <h3 id="modalNama" class="font-bold text-slate-800 text-lg leading-snug mt-1"></h3>
                </div>
            </div>

            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 mb-4 text-xs text-slate-600 flex items-start gap-2">
                <i class="fa-solid fa-location-dot text-rose-500 mt-0.5"></i>
                <p id="modalAlamat"></p>
            </div>

            <div class="flex items-center justify-between text-xs mb-4 px-1">
                <span class="text-slate-500">Status Stasiun:</span>
                <span id="modalStatus" class="font-bold text-emerald-600"></span>
            </div>

            <hr class="border-slate-100 my-4">

            <h4 class="font-bold text-slate-800 text-sm mb-3">Pilih Tipe Konektor:</h4>
            <div id="modalKonektors" class="space-y-2.5 max-h-48 overflow-y-auto pr-1"></div>

            <div class="mt-6 flex justify-end">
                <button onclick="closeModal()" class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-xs transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Script Leaflet & Modal Logic -->
    <script>
        const defaultLat = -7.7829;
        const defaultLng = 110.3670;
        const map = L.map('map').setView([defaultLat, defaultLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const stasiuns = @json($stasiuns);
        const markers = {};

        stasiuns.forEach(stasiun => {
            if(stasiun.latitude && stasiun.longitude) {
                const marker = L.marker([stasiun.latitude, stasiun.longitude]).addTo(map);
                
                const popupContent = `
                    <div style="padding: 2px;">
                        <b style="font-size: 13px; color: #1e293b;">${stasiun.nama_stasiun}</b><br>
                        <span style="font-size: 11px; color: #64748b;">${stasiun.alamat}</span>
                    </div>
                `;
                
                marker.bindPopup(popupContent);
                markers[stasiun.nama_stasiun] = marker;

                marker.on('click', function() {
                    showDetail(stasiun);
                });
            }
        });

        function showDetail(stasiun) {
            map.flyTo([stasiun.latitude, stasiun.longitude], 16, { duration: 1.2 });
            if(markers[stasiun.nama_stasiun]) {
                markers[stasiun.nama_stasiun].openPopup();
            }

            document.getElementById('modalNama').innerText = stasiun.nama_stasiun;
            document.getElementById('modalKota').innerText = stasiun.kota;
            document.getElementById('modalAlamat').innerText = stasiun.alamat;
            document.getElementById('modalStatus').innerText = stasiun.status;

            const konektorContainer = document.getElementById('modalKonektors');
            konektorContainer.innerHTML = '';

            if (stasiun.konektors && stasiun.konektors.length > 0) {
                stasiun.konektors.forEach(k => {
                    const statusBg = k.status === 'Tersedia' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700';
                    
                    const html = `
                        <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-xs">
                            <div>
                                <div class="font-bold text-slate-800">${k.tipe_konektor} <span class="font-normal text-slate-500">(${k.daya_kw} kW)</span></div>
                                <div class="mt-1 flex items-center gap-2">
                                    <span class="font-bold text-emerald-600">Rp ${Number(k.harga_per_kwh).toLocaleString('id-ID')}/kWh</span>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold ${statusBg}">${k.status}</span>
                                </div>
                            </div>
                            <button class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg text-xs transition">
                                Pilih
                            </button>
                        </div>
                    `;
                    konektorContainer.innerHTML += html;
                });
            } else {
                konektorContainer.innerHTML = '<p class="text-xs text-slate-400 italic">Konektor belum tersedia.</p>';
            }

            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>

</body>
</html>