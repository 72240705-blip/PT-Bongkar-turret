<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendaraan Saya - EVChargeHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-100 min-h-screen text-slate-800 flex flex-col font-sans">

    <!-- Header / Navbar Atas -->
    <header class="bg-emerald-600 text-white shadow-md sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white text-emerald-600 flex items-center justify-center font-bold text-xl shadow-inner">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div>
                    <h1 class="font-bold text-white text-lg leading-tight tracking-wide">EVChargeHub</h1>
                    <p class="text-[11px] text-emerald-100 font-medium">Stasiun Pengisian Listrik</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-[10px] text-emerald-200 uppercase font-semibold tracking-wider">Pengemudi</p>
                    <p class="text-xs font-bold text-white">{{ auth()->user()->nama_lengkap ?? auth()->user()->name }}</p>
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

    <!-- Main Layout dengan Sidebar di Kiri -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 w-full flex-grow">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- SIDEBAR NAVIGASI KIRI -->
            <aside class="lg:col-span-3 bg-white rounded-2xl border border-slate-200/80 p-3 shadow-sm sticky top-20">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-3 mb-2">NAVIGASI UTAMA</p>
                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}" class="w-full px-3.5 py-2.5 rounded-xl text-slate-600 hover:text-emerald-700 hover:bg-slate-50 font-medium text-xs flex items-center gap-3 transition">
                        <i class="fa-solid fa-compass text-slate-400 text-sm"></i> Beranda
                    </a>
                    <a href="{{ route('kendaraan.index') }}" class="w-full px-3.5 py-2.5 rounded-xl bg-emerald-50 text-emerald-700 font-bold text-xs flex items-center gap-3 transition border border-emerald-200/60">
                        <i class="fa-solid fa-car text-emerald-600 text-sm"></i> Kendaraan
                    </a>
                    <a href="#" class="w-full px-3.5 py-2.5 rounded-xl text-slate-600 hover:text-emerald-700 hover:bg-slate-50 font-medium text-xs flex items-center gap-3 transition">
                        <i class="fa-solid fa-clock-rotate-left text-slate-400 text-sm"></i> Riwayat
                    </a>
                    <a href="#" class="w-full px-3.5 py-2.5 rounded-xl text-slate-600 hover:text-emerald-700 hover:bg-slate-50 font-medium text-xs flex items-center gap-3 transition">
                        <i class="fa-solid fa-user text-slate-400 text-sm"></i> Profil
                    </a>
                </nav>
            </aside>

            <!-- KONTEN UTAMA KENDARAAN -->
            <section class="lg:col-span-9 space-y-4">
                
                <!-- Header Halaman -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex justify-between items-center">
                    <div>
                        <h2 class="font-bold text-slate-800 text-lg">Kelola Kendaraan Listrik</h2>
                        <p class="text-xs text-slate-500">Daftarkan profil kendaraan Anda untuk memudahkan transaksi pengisian daya.</p>
                    </div>
                    @if(count($kendaraans) > 0)
                        <button id="btnTambah" onclick="showForm()" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs shadow-sm transition flex items-center gap-2">
                            <i class="fa-solid fa-plus"></i> Tambah Kendaraan
                        </button>
                    @endif
                </div>

                <!-- Alert Pesan Sukses -->
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold rounded-2xl flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- TAMPILAN EMPTY STATE -->
                @if(count($kendaraans) == 0)
                    <div id="emptyStateSection" class="bg-white rounded-2xl border border-slate-200/80 p-12 text-center shadow-sm">
                        <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl border border-emerald-100">
                            <i class="fa-solid fa-car-side"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 text-base mb-1">Belum Ada Kendaraan Terdaftar</h3>
                        <p class="text-xs text-slate-500 max-w-md mx-auto mb-6">
                            Anda belum mendaftarkan kendaraan listrik. Tambahkan kendaraan pertama Anda agar sistem dapat menyesuaikan tipe konektor dan tarif pengisian.
                        </p>
                        <button onclick="showForm()" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs shadow-md transition inline-flex items-center gap-2">
                            <i class="fa-solid fa-plus"></i> Tambah Kendaraan Pertama Saya
                        </button>
                    </div>
                @endif

                <!-- FORM INLINE TAMBAH KENDARAAN (CREATE) -->
                <div id="formSection" class="bg-white rounded-2xl border border-emerald-500/40 p-6 shadow-sm border-2 hidden">
                    <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg font-bold">
                                <i class="fa-solid fa-car"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-base">Form Pendaftaran Kendaraan</h3>
                                <p class="text-[11px] text-slate-500">Masukkan rincian data kendaraan listrik Anda di bawah ini.</p>
                            </div>
                        </div>
                        <button onclick="hideForm()" class="text-slate-400 hover:text-slate-600 text-xs font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-xmark"></i> Batal
                        </button>
                    </div>

                    <form action="{{ route('kendaraan.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Merk & Model Kendaraan</label>
                                <input type="text" name="merk_model" placeholder="Contoh: Denza D9 EV" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none transition">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Plat Nomor Kendaraan</label>
                                <input type="text" name="plat_nomor" placeholder="Contoh: B 8888 EV" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none uppercase transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Kapasitas Baterai (kWh)</label>
                                <input type="number" step="0.1" name="kapasitas_baterai_kwh" placeholder="Contoh: 103" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Tipe Konektor</label>
                                <select name="tipe_konektor" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none transition">
                                    <option value="CCS2 / DC Fast Charging">CCS2 / DC Fast Charging</option>
                                    <option value="Type 2 / AC">Type 2 / AC</option>
                                    <option value="GB/T">GB/T</option>
                                    <option value="CHAdeMO">CHAdeMO</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-3 flex justify-end gap-2">
                            <button type="button" onclick="hideForm()" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-xs transition">
                                Batal
                            </button>
                            <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs shadow-md transition flex items-center gap-2">
                                <i class="fa-solid fa-floppy-disk"></i> Simpan Kendaraan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- TAMPILAN DAFTAR KENDARAAN -->
                @if(count($kendaraans) > 0)
                    <div id="listSection" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($kendaraans as $k)
                            <div class="bg-white rounded-2xl border {{ $k->is_utama ? 'border-emerald-500 ring-2 ring-emerald-500/20' : 'border-slate-200/80' }} p-5 shadow-sm relative flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start gap-2 mb-3">
                                        <div>
                                            <h3 class="font-bold text-slate-800 text-base">{{ $k->merk_model }}</h3>
                                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded bg-slate-100 text-slate-600 border border-slate-200 mt-1 inline-block">
                                                {{ $k->plat_nomor }}
                                            </span>
                                        </div>
                                        @if($k->is_utama)
                                            <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200 flex items-center gap-1">
                                                <i class="fa-solid fa-star text-emerald-600"></i> Utama
                                            </span>
                                        @endif
                                    </div>

                                    <div class="space-y-2 py-3 border-t border-b border-slate-100 text-xs text-slate-600 my-2">
                                        <div class="flex justify-between">
                                            <span class="text-slate-400">Kapasitas Baterai:</span>
                                            <span class="font-bold text-slate-700">{{ $k->kapasitas_baterai_kwh }} kWh</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-slate-400">Tipe Konektor:</span>
                                            <span class="font-bold text-emerald-600">{{ $k->tipe_konektor }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-2 flex justify-between items-center gap-2">
                                    @if(!$k->is_utama)
                                        <form action="{{ route('kendaraan.set-utama', $k->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            <button type="submit" class="w-full py-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-700 font-semibold rounded-xl text-xs transition">
                                                Jadikan Utama
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Tombol Hapus (DELETE) -->
                                    <button type="button" onclick="openDeleteModal({{ $k->id }}, '{{ addslashes($k->merk_model) }}')" class="px-3.5 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold rounded-xl text-xs transition border border-rose-200 flex items-center gap-1.5">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </section>

        </div>

    </main>

    <!-- MODAL POPUP KONFIRMASI HAPUS (DELETE) -->
    <div id="deleteModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-xl text-center border border-slate-200">
            <div class="w-14 h-14 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-1">Hapus Kendaraan?</h3>
            <p class="text-xs text-slate-500 mb-6">Apakah Anda yakin ingin menghapus <span id="deleteVehicleName" class="font-bold text-slate-800"></span>? Tindakan ini tidak dapat dibatalkan.</p>

            <form id="deleteForm" method="POST" class="flex gap-2 justify-center">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-xs transition">
                    Batal
                </button>
                <button type="submit" class="w-full py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl text-xs shadow-md transition">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <script>
        function showForm() {
            const emptyState = document.getElementById('emptyStateSection');
            const form = document.getElementById('formSection');
            const list = document.getElementById('listSection');
            const btnTambah = document.getElementById('btnTambah');
            
            if (emptyState) emptyState.classList.add('hidden');
            if (list) list.classList.add('hidden');
            if (btnTambah) btnTambah.classList.add('hidden');
            
            form.classList.remove('hidden');
        }

        function hideForm() {
            const emptyState = document.getElementById('emptyStateSection');
            const form = document.getElementById('formSection');
            const list = document.getElementById('listSection');
            const btnTambah = document.getElementById('btnTambah');
            
            form.classList.add('hidden');
            
            if (emptyState) emptyState.classList.remove('hidden');
            if (list) list.classList.remove('hidden');
            if (btnTambah) btnTambah.classList.remove('hidden');
        }

        function openDeleteModal(id, nama) {
            document.getElementById('deleteForm').action = `/kendaraan/${id}`;
            document.getElementById('deleteVehicleName').innerText = nama;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>

</body>
</html>