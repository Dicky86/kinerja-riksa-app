<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kompensasi - Kinerja Riksa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Plugin Alpine.js Persist (Wajib di atas script utama alpine agar tema tersimpan) -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine.js untuk kontrol state (Dashboard, Impor, Pengaturan, Tema, Modal Logout, dan Modal Profil) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body class="bg-slate-50 flex flex-col h-screen overflow-hidden" 
      x-data="{ 
          currentMenu: 'dashboard', 
          theme: $persist('light'),
          showLogoutModal: false,
          showProfileCard: false,
          fileName: 'Belum ada file',      <!-- TAMBAHKAN INI -->
          fileStatus: 'Menunggu file',     <!-- TAMBAHKAN INI -->
          initTheme() {
              if (this.theme === 'system') {
                  return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
              }
              return this.theme;
          }
      }"
      :class="initTheme() === 'dark' ? 'dark' : ''">

    <!-- HEADER UTAMA -->
    <header class="h-20 border-b grid grid-cols-3 items-center px-6 z-20 shadow-sm shrink-0 w-full transition-colors duration-200"
            :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
        <div class="flex items-center">
            <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xs mr-3 shrink-0">KR</div>
            <div class="flex flex-col justify-center">
                <span class="font-bold text-sm tracking-wide">KINERJA RIKSA</span>
                <span class="text-[10px] font-medium tracking-tight whitespace-nowrap" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Kementerian Ketenagakerjaan Republik Indonesia</span>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center text-center">
            <h1 class="text-xs md:text-sm font-bold tracking-tight">Hubungan Kerja - Kompensasi</h1>
            <span class="text-[11px] mt-0.5 text-slate-400">Data contoh · 5 baris sumber</span>
        </div>
        
        <div class="flex items-center justify-end space-x-6">
            <button class="relative transition" :class="initTheme() === 'dark' ? 'text-slate-300 hover:text-white' : 'text-slate-400 hover:text-slate-600'">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            
            <!-- Tombol Profil Pengguna di Kanan Atas (Memicu Popup Modal di Tengah) -->
            <div class="flex items-center space-x-3 border-l pl-6" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-200'">
                <button @click="showProfileCard = true" class="flex items-center space-x-3 focus:outline-none group">
                    <div class="w-8 h-8 rounded-full bg-blue-100 border border-blue-200 flex items-center justify-center text-blue-700 font-bold text-xs overflow-hidden shrink-0">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm font-semibold group-hover:text-blue-600 transition">Pengguna KINERJA</span>
                </button>
            </div>
        </div>
    </header>

    <!-- AREA BAWAH (SIDEBAR + KONTEN) -->
    <div class="flex-1 flex overflow-hidden">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-[#162133] text-slate-300 flex flex-col shrink-0 border-r border-slate-800 relative pb-32">
            <div class="flex-1 overflow-y-auto py-6 px-4">
                
                <!-- Menu Home -->
                <a href="{{ route('home') }}" class="flex items-center px-3 py-3 rounded-xl hover:bg-[#1e293b] hover:text-white text-slate-300 group font-medium text-sm transition mb-6">
                    <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Home
                </a>

                <div class="text-[10px] font-semibold text-slate-500 mb-3 px-2 tracking-wider uppercase">MENU UTAMA</div>
                <nav class="space-y-1">
                    <!-- Dashboard Capaian -->
                    <a href="#" @click.prevent="currentMenu = 'dashboard'" :class="currentMenu === 'dashboard' ? 'bg-[#1e293b] text-white' : 'hover:bg-[#1e293b] hover:text-white text-slate-300'" class="flex items-center px-3 py-3 rounded-xl group font-medium text-sm transition">
                        <svg class="w-5 h-5 mr-3 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard Capaian
                    </a>
                    <!-- Impor Data -->
                    <a href="#" @click.prevent="currentMenu = 'import'" :class="currentMenu === 'import' ? 'bg-[#1e293b] text-white' : 'hover:bg-[#1e293b] hover:text-white text-slate-300'" class="flex items-center px-3 py-3 rounded-xl transition text-sm">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Impor Data
                    </a>
                    <!-- Pengaturan -->
                    <a href="#" @click.prevent="currentMenu = 'settings'" :class="currentMenu === 'settings' ? 'bg-[#1e293b] text-white' : 'hover:bg-[#1e293b] hover:text-white text-slate-300'" class="flex items-center px-3 py-3 rounded-xl transition text-sm">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pengaturan
                    </a>
                </nav>
            </div>
            
            <!-- Area Bawah Sidebar -->
            <div class="absolute bottom-0 w-full bg-[#162133]">
                <div class="px-4 py-2 border-t border-slate-700">
                    <button @click="showLogoutModal = true" class="w-full flex items-center px-3 py-2.5 hover:bg-[#1e293b] text-slate-400 hover:text-white rounded-xl transition text-sm text-left">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </div>
                <div class="px-6 pb-6 pt-2 text-[10px] text-slate-500 leading-relaxed">
                    Dashboard terintegrasi untuk pemantauan capaian berdasarkan data unggahan yang telah divalidasi.
                </div>
            </div>
        </aside>

        <!-- AREA KONTEN ISI UTAMA -->
        <main class="flex-1 overflow-y-auto p-8 bg-slate-50 space-y-8 relative">
            
            <!-- ======================================================= -->
            <!-- TAB: HALAMAN PENGATURAN (SAMA PERSIS DENGAN GAMBAR 1) -->
            <!-- ======================================================= -->
            <div x-show="currentMenu === 'settings'" x-transition class="space-y-6" style="display: none;">
                <div class="p-8 rounded-3xl border shadow-sm transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    
                    <div class="mb-6">
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">PREFERENSI SESI</span>
                        <h2 class="text-3xl font-serif font-bold mt-1 tracking-tight">Pengaturan</h2>
                        <p class="text-sm mt-1" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Perbarui informasi profil dan tampilan website. Berlaku selama sesi dashboard ini.</p>
                    </div>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold mb-2" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-700'">Nama Pengguna</label>
                                <input type="text" value="Pengguna KINERJA" class="w-full border rounded-2xl px-4 py-3 text-sm outline-none transition"
                                       :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100 focus:border-blue-400' : 'bg-slate-50 border-slate-200 text-slate-700 focus:border-blue-500'">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold mb-2" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-700'">Jabatan</label>
                                <input type="text" value="Analis Capaian" class="w-full border rounded-2xl px-4 py-3 text-sm outline-none transition"
                                       :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100 focus:border-blue-400' : 'bg-slate-50 border-slate-200 text-slate-700 focus:border-blue-500'">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold mb-2" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-700'">Unit Organisasi</label>
                                <input type="text" value="Kementerian Ketenagakerjaan" class="w-full border rounded-2xl px-4 py-3 text-sm outline-none transition"
                                       :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100 focus:border-blue-400' : 'bg-slate-50 border-slate-200 text-slate-700 focus:border-blue-500'">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold mb-2" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-700'">Email</label>
                                <input type="email" value="pengguna@kemnaker.go.id" class="w-full border rounded-2xl px-4 py-3 text-sm outline-none transition"
                                       :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100 focus:border-blue-400' : 'bg-slate-50 border-slate-200 text-slate-700 focus:border-blue-500'">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-700'">Avatar / Foto Profil</label>
                            <p class="text-xs" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Ganti foto profil dengan memilih gambar avatar pada editor Canva.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-2.5" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-700'">Tampilan Website</label>
                            <div class="flex items-center space-x-3">
                                <button type="button" @click="theme = 'light'" 
                                        :class="theme === 'light' ? 'border-blue-600 text-blue-600 font-bold bg-blue-50/50' : (initTheme() === 'dark' ? 'border-slate-600 text-slate-300 hover:bg-slate-800' : 'border-slate-200 text-slate-600 hover:bg-slate-50')"
                                        class="px-5 py-2.5 border rounded-xl text-xs transition">
                                    Terang
                                </button>
                                <button type="button" @click="theme = 'dark'" 
                                        :class="theme === 'dark' ? 'border-blue-500 text-white font-bold bg-slate-800' : (initTheme() === 'dark' ? 'border-slate-600 text-slate-300 hover:bg-slate-800' : 'border-slate-200 text-slate-600 hover:bg-slate-50')"
                                        class="px-5 py-2.5 border rounded-xl text-xs transition">
                                    Gelap
                                </button>
                                <button type="button" @click="theme = 'system'" 
                                        :class="theme === 'system' ? 'border-blue-600 text-blue-600 font-bold bg-blue-50/50' : (initTheme() === 'dark' ? 'border-slate-600 text-slate-300 hover:bg-slate-800' : 'border-slate-200 text-slate-600 hover:bg-slate-50')"
                                        class="px-5 py-2.5 border rounded-xl text-xs transition">
                                    Mengikuti Sistem
                                </button>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="button" @click="alert('Pengaturan berhasil disimpan!')" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-xl text-sm transition shadow-sm inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================================================= -->
            <!-- TAB: HALAMAN IMPOR DATA (KHUSUS KOMPENSASI) -->
            <!-- ======================================================= -->
            <div x-show="currentMenu === 'import'" x-transition class="space-y-6" style="display: none;" x-data="{ showPreview: false }">
                <div class="p-8 rounded-3xl border shadow-sm transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    
                    <div class="flex justify-between items-start border-b pb-4 mb-6" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'">
                        <div>
                            <h3 class="text-lg font-bold">Unggah dan Periksa Data</h3>
                            <p class="text-xs mt-0.5" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Data aktual dari CSV atau Excel akan ditampilkan sebagai pratinjau sebelum disimpan ke dashboard aktif.</p>
                        </div>
                    </div>

                    <!-- KOTAK UNGGAH FILE -->
                    <div class="max-w-3xl mx-auto">
                        <div x-data="{ isDragging: false }"
                             @dragover.prevent="isDragging = true"
                             @dragleave.prevent="isDragging = false"
                             @drop.prevent="isDragging = false; 
                                            const dt = $event.dataTransfer;
                                            if (dt.files.length) {
                                                document.getElementById('csvFileInput').files = dt.files;
                                                fileName = dt.files[0].name;
                                            }"
                             @click="document.getElementById('csvFileInput').click()"
                             :class="isDragging ? (initTheme() === 'dark' ? 'bg-slate-700 border-blue-400' : 'bg-blue-100 border-blue-400') : (initTheme() === 'dark' ? 'border-slate-600 bg-slate-800/40 hover:bg-slate-700/50' : 'border-blue-200 bg-blue-50/30 hover:bg-blue-50/60')"
                             class="border-2 border-dashed rounded-2xl p-10 flex flex-col items-center justify-center text-center relative cursor-pointer transition-all duration-200">
                            
                            <!-- Input File Tersembunyi (CSV Default) -->
                            <input type="file" id="csvFileInput" class="hidden" accept=".csv" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : 'Belum ada file'; showPreview = false;">
                            
                            <!-- Input File Tersembunyi (Khusus Excel) -->
                            <input type="file" id="excelFileInput" class="hidden" accept=".xls,.xlsx" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : 'Belum ada file'; showPreview = false;">

                            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <h4 class="text-base font-bold mb-1">Unggah File Data</h4>
                            <p class="text-xs max-w-md mb-2" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Klik area ini atau tarik dan lepas file CSV/Excel ke sini.</p>
                            
                            <!-- Menampilkan Nama File yang Sedang Dipilih -->
                            <p class="text-sm font-bold text-teal-600 dark:text-teal-400 mb-6 bg-teal-50 dark:bg-teal-900/30 px-3 py-1 rounded-full" 
                               x-show="fileName !== 'Belum ada file'" 
                               x-text="'📁 ' + fileName" 
                               style="display: none;"></p>
                            
                            <div class="flex flex-wrap items-center justify-center gap-3 mt-2">
                                <button type="button" @click.stop="document.getElementById('csvFileInput').click()" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-5 py-2.5 rounded-xl transition shadow-sm cursor-pointer z-10 relative">Pilih File CSV</button>
                                
                                <button type="button" @click.stop="document.getElementById('excelFileInput').click()" class="border hover:bg-opacity-80 text-xs font-semibold px-5 py-2.5 rounded-xl transition cursor-pointer z-10 relative" :class="initTheme() === 'dark' ? 'border-slate-600 text-slate-200 bg-slate-800' : 'border-slate-200 text-slate-700 bg-white'">Impor File Excel</button>
                                
                                <!-- TOMBOL OKE: Memunculkan Tabel Pratinjau -->
                                <button type="button" @click.stop="if(fileName !== 'Belum ada file') { showPreview = true; } else { alert('Silakan pilih atau unggah file terlebih dahulu!'); }" class="bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold px-8 py-2.5 rounded-xl transition shadow-sm cursor-pointer z-10 relative">Oke</button>
                            </div>
                        </div>
                    </div>

                    <!-- TABEL PRATINJAU DATA (Muncul Saat Tombol Oke Diklik) -->
                    <div x-show="showPreview" x-transition class="mt-10 pt-8 border-t" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'" style="display: none;">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-4 gap-4">
                            <div>
                                <h3 class="text-base font-bold">Pratinjau Data Unggahan</h3>
                                <p class="text-xs mt-0.5" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Pastikan struktur kolom dan data di bawah ini sudah benar sebelum disimpan.</p>
                            </div>
                            <!-- Tombol Final untuk Menyimpan ke Database Backend -->
                            <button type="button" @click="alert('Kirim file ke Backend Laravel. Data akan disingkronisasi dengan Dashboard.'); currentMenu = 'dashboard'; showPreview = false; fileName = 'Belum ada file';" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-5 py-2.5 rounded-xl transition shadow-sm cursor-pointer flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                Simpan ke Dashboard
                            </button>
                        </div>
                        
                        <div class="overflow-x-auto rounded-lg border" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-200'">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr class="bg-[#162133] text-white text-[10px] font-bold uppercase tracking-wider">
                                        <th class="py-3 px-4">NO SURAT</th>
                                        <th class="py-3 px-4">TANGGAL SURAT</th>
                                        <th class="py-3 px-4">PERUSAHAAN</th>
                                        <th class="py-3 px-4">PROVINSI</th>
                                        <th class="py-3 px-4">NOMINAL PEMBAYARAN</th>
                                        <th class="py-3 px-4">STATUS</th>
                                        <th class="py-3 px-4">JUMLAH PEKERJA</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y text-sm" :class="initTheme() === 'dark' ? 'divide-slate-700 text-slate-300' : 'divide-slate-200 text-slate-700'">
                                    <tr>
                                        <!-- Colspan diubah menjadi 7 menyesuaikan 7 header kolom tabel kompensasi di atas -->
                                        <td class="py-6 px-4 text-center italic text-xs text-slate-400" colspan="7">
                                            Data dari file <span class="font-bold text-slate-600 dark:text-slate-300" x-text="fileName"></span> akan dimuat dan ditampilkan di sini oleh Backend/Script.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ======================================================= -->
            <!-- TAB: DASHBOARD UTAMA KOMPENSASI -->
            <!-- ======================================================= -->
            <div x-show="currentMenu === 'dashboard'" x-transition class="space-y-8">
                
                <!-- Judul Section (Ukuran & Style disamakan plekk dengan Kasus Ijazah) -->
                <div>
                    <span class="text-xs font-bold text-emerald-600 tracking-wider uppercase">BINA PEMERIKSAAN NORMA KETENAGAKERJAAN</span>
                    <h2 class="text-2xl font-bold mt-1 tracking-tight" :class="initTheme() === 'dark' ? 'text-slate-100' : 'text-slate-900'">Dashboard Capaian Kinerja</h2>
                    <p class="text-xs md:text-sm mt-1" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Pantau KPI, grafik, peta provinsi, tabel, dan notifikasi berdasarkan substansi, periode, serta data unggahan yang dipilih.</p>
                </div>

                <!-- Area Filter Substansi & Capaian -->
                <div class="p-6 rounded-2xl border shadow-sm transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-5">
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-500'">Substansi</label>
                            <select class="w-full border rounded-xl px-3 py-2.5 text-sm outline-none transition"
                                    :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100' : 'bg-slate-50 border-slate-200 text-slate-700'">
                                <option>Hubungan Kerja</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-500'">Jenis Capaian</label>
                            <select class="w-full border rounded-xl px-3 py-2.5 text-sm outline-none transition"
                                    :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100' : 'bg-slate-50 border-slate-200 text-slate-700'">
                                <option>Kompensasi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-500'">Tahun</label>
                            <select class="w-full border rounded-xl px-3 py-2.5 text-sm outline-none transition"
                                    :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100' : 'bg-slate-50 border-slate-200 text-slate-700'">
                                <option>Semua Tahun</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-500'">Bulan</label>
                            <select class="w-full border rounded-xl px-3 py-2.5 text-sm outline-none transition"
                                    :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100' : 'bg-slate-50 border-slate-200 text-slate-700'">
                                <option>Semua Bulan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kolom Cari Data & Tombol Data Contoh (Disamakan persis Kasus Ijazah) -->
                    <div class="pt-4 border-t flex flex-col md:flex-row items-end gap-4" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'">
                        <div class="flex-1 w-full">
                            <label class="block text-xs font-semibold mb-1.5" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-500'">Cari data</label>
                            <input type="text" class="w-full border rounded-xl px-4 py-2.5 text-sm outline-none transition"
                                   :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100' : 'bg-slate-50 border-slate-200 text-slate-700'" placeholder="Cari berdasarkan kata kunci...">
                        </div>
                        <div>
                            <button type="button" class="bg-slate-800 hover:bg-slate-900 text-white font-medium px-6 py-2.5 rounded-xl text-sm transition shadow-sm flex items-center">
                                <svg class="w-4 h-4 mr-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                Data Contoh
                            </button>
                        </div>
                    </div>
                </div>

                <!-- KPI CARDS KOMPENSASI -->
                <div class="p-6 rounded-2xl border shadow-sm transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div>
                            <h3 class="text-base font-bold">Analisis Kompensasi</h3>
                            <p class="text-xs" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Kolom sumber: No Surat, Tanggal Surat, Perusahaan, Provinsi, Nominal Pembayaran, Status, Jumlah Pekerja.</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 text-xs">
                            <span class="px-3 py-1 rounded-full font-medium" :class="initTheme() === 'dark' ? 'bg-slate-800 text-slate-300' : 'bg-slate-100 text-slate-600'">Substansi: Hubungan Kerja</span>
                            <span class="px-3 py-1 rounded-full font-medium" :class="initTheme() === 'dark' ? 'bg-slate-800 text-slate-300' : 'bg-slate-100 text-slate-600'">Sumber: Data contoh</span>
                            <span class="px-3 py-1 rounded-full font-medium" :class="initTheme() === 'dark' ? 'bg-slate-800 text-slate-300' : 'bg-slate-100 text-slate-600'">5 baris</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div class="p-4 rounded-xl border flex flex-col justify-between transition-colors" :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <span class="text-xs font-semibold" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Jumlah Pengaduan</span>
                            <div class="my-3"><span class="text-3xl font-extrabold">5</span></div>
                            <span class="text-[11px] text-slate-400">No Surat unik</span>
                        </div>
                        <div class="p-4 rounded-xl border flex flex-col justify-between transition-colors" :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <span class="text-xs font-semibold" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Sudah Dibayar</span>
                            <div class="my-3"><span class="text-3xl font-extrabold">3</span></div>
                            <span class="text-[11px] text-slate-400">Status sudah dibayar/lunas</span>
                        </div>
                        <div class="p-4 rounded-xl border flex flex-col justify-between transition-colors" :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <span class="text-xs font-semibold" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Rentang Nominal</span>
                            <div class="my-3"><span class="text-base font-extrabold">Rp 12jt – 30jt</span></div>
                            <span class="text-[11px] text-slate-400">Minimum & maksimum</span>
                        </div>
                        <div class="p-4 rounded-xl border flex flex-col justify-between transition-colors" :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <span class="text-xs font-semibold" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Jumlah Pekerja</span>
                            <div class="my-3"><span class="text-3xl font-extrabold">43</span></div>
                            <span class="text-[11px] text-slate-400">Total pekerja terdampak</span>
                        </div>
                        <div class="p-4 rounded-xl border flex flex-col justify-between transition-colors" :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <span class="text-xs font-semibold" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Rata-rata/Pekerja</span>
                            <div class="my-3"><span class="text-base font-extrabold">Rp 2,3 Jt</span></div>
                            <span class="text-[11px] text-slate-400">Nominal / pekerja</span>
                        </div>
                    </div>
                </div>

                <!-- CHARTS GRID KOMPENSASI -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="p-6 rounded-2xl border shadow-sm flex flex-col" :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                        <h3 class="text-sm font-bold mb-1">Tren nominal kompensasi</h3>
                        <p class="text-[11px] text-slate-400 mb-4">Berdasarkan Tanggal Surat.</p>
                        <div id="chart-tren" class="flex-1 w-full min-h-[250px]"></div>
                    </div>
                    <div class="p-6 rounded-2xl border shadow-sm flex flex-col" :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                        <h3 class="text-sm font-bold mb-1">Jumlah Pengaduan per Provinsi</h3>
                        <p class="text-[11px] text-slate-400 mb-4">Berdasarkan provinsi filter aktif.</p>
                        <div id="chart-provinsi" class="flex-1 w-full min-h-[250px]"></div>
                    </div>
                    <div class="p-6 rounded-2xl border shadow-sm flex flex-col" :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                        <h3 class="text-sm font-bold mb-1">Status kompensasi</h3>
                        <p class="text-[11px] text-slate-400 mb-4">Persentase status pembayaran.</p>
                        <div id="chart-status" class="flex-1 w-full flex justify-center items-center min-h-[200px]"></div>
                    </div>
                    <div class="p-6 rounded-2xl border shadow-sm flex flex-col" :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                        <h3 class="text-sm font-bold mb-1">Rentang Besaran Kompensasi</h3>
                        <p class="text-[11px] text-slate-400 mb-4">Jumlah pengaduan unik tiap rentang.</p>
                        <div id="chart-rentang" class="w-full min-h-[200px]"></div>
                    </div>
                </div>

                <!-- PETA PROVINSI & RINGKASAN WILAYAH -->
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-base font-bold" :class="initTheme() === 'dark' ? 'text-slate-100' : 'text-slate-800'">Peta Provinsi Kompensasi</h3>
                            <p class="text-xs text-slate-400">Sebaran wilayah kompensasi mengikuti filter aktif.</p>
                        </div>
                        <span class="bg-teal-50 text-teal-700 border border-teal-200 text-xs px-3 py-1 rounded-full font-semibold">Kolom wilayah tersedia</span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 p-6 rounded-2xl border shadow-sm flex flex-col items-center justify-center min-h-[300px]" :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700' : 'bg-white border-slate-200'">
                            <div class="w-full h-48 rounded-xl border border-dashed flex items-center justify-center relative overflow-hidden" :class="initTheme() === 'dark' ? 'bg-slate-800/50 border-slate-700' : 'bg-teal-50/50 border-teal-200'">
                                <div class="flex items-center space-x-8 opacity-75">
                                    <div class="w-24 h-10 bg-teal-300 rounded-full transform -rotate-6 flex items-center justify-center relative"><div class="w-3 h-3 bg-teal-800 rounded-full absolute -top-1"></div></div>
                                    <div class="w-36 h-8 bg-teal-300 rounded-full flex items-center justify-center space-x-3"><div class="w-3 h-3 bg-teal-800 rounded-full"></div><div class="w-3 h-3 bg-teal-800 rounded-full"></div><div class="w-3 h-3 bg-teal-800 rounded-full"></div></div>
                                    <div class="w-20 h-12 bg-teal-300 rounded-full transform rotate-12 flex items-center justify-center"><div class="w-3 h-3 bg-teal-800 rounded-full"></div></div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 rounded-2xl border shadow-sm flex flex-col justify-between" :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <div>
                                <h4 class="text-sm font-bold">Ringkasan Wilayah</h4>
                                <p class="text-[11px] mb-4 text-slate-400">Legenda mengikuti kolom Provinsi pada data kompensasi.</p>
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between items-center border-b border-dashed pb-2" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'"><span class="text-slate-400 font-medium">Jawa Barat</span><span class="font-bold">1</span></div>
                                    <div class="flex justify-between items-center border-b border-dashed pb-2" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'"><span class="text-slate-400 font-medium">Jawa Tengah</span><span class="font-bold">1</span></div>
                                    <div class="flex justify-between items-center border-b border-dashed pb-2" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'"><span class="text-slate-400 font-medium">DKI Jakarta</span><span class="font-bold">1</span></div>
                                    <div class="flex justify-between items-center border-b border-dashed pb-2" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'"><span class="text-slate-400 font-medium">Jawa Timur</span><span class="font-bold">1</span></div>
                                    <div class="flex justify-between items-center pb-1"><span class="text-slate-400 font-medium">Banten</span><span class="font-bold">1</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TABEL 5 BARIS KOMPENSASI -->
                <div class="rounded-2xl border shadow-sm overflow-hidden pb-6 transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    <div class="p-6 border-b" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'">
                        <h3 class="text-base font-bold">Data File Aktif</h3>
                        <p class="text-xs mt-0.5 text-slate-400">5 baris sumber data kompensasi ditampilkan.</p>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr class="bg-[#162133] text-white text-xs uppercase tracking-wider">
                                    <th class="py-3 px-4 font-semibold">NO SURAT</th>
                                    <th class="py-3 px-4 font-semibold">TANGGAL SURAT</th>
                                    <th class="py-3 px-4 font-semibold">PERUSAHAAN</th>
                                    <th class="py-3 px-4 font-semibold">PROVINSI</th>
                                    <th class="py-3 px-4 font-semibold">NOMINAL PEMBAYARAN</th>
                                    <th class="py-3 px-4 font-semibold">STATUS</th>
                                    <th class="py-3 px-4 font-semibold">JUMLAH PEKERJA</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y text-sm" :class="initTheme() === 'dark' ? 'divide-slate-700 text-slate-200' : 'divide-slate-100 text-slate-700'">
                                <tr class="transition"><td class="py-3 px-4">KMP-001</td><td class="py-3 px-4">2026-01-10</td><td class="py-3 px-4 font-medium">PT Maju Bersama</td><td class="py-3 px-4">Jawa Barat</td><td class="py-3 px-4">25000000</td><td class="py-3 px-4"><span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-semibold">Sudah Dibayar</span></td><td class="py-3 px-4">10</td></tr>
                                <tr class="transition"><td class="py-3 px-4">KMP-002</td><td class="py-3 px-4">2026-01-18</td><td class="py-3 px-4 font-medium">PT Sinar Abadi</td><td class="py-3 px-4">Jawa Tengah</td><td class="py-3 px-4">18000000</td><td class="py-3 px-4"><span class="bg-teal-50 text-teal-700 px-2.5 py-1 rounded-md text-xs font-semibold">Dalam Proses</span></td><td class="py-3 px-4">8</td></tr>
                                <tr class="transition"><td class="py-3 px-4">KMP-003</td><td class="py-3 px-4">2026-02-05</td><td class="py-3 px-4 font-medium">CV Karya Utama</td><td class="py-3 px-4">DKI Jakarta</td><td class="py-3 px-4">12000000</td><td class="py-3 px-4"><span class="bg-yellow-50 text-yellow-700 px-2.5 py-1 rounded-md text-xs font-semibold">Belum Dibayar</span></td><td class="py-3 px-4">6</td></tr>
                                <tr class="transition"><td class="py-3 px-4">KMP-004</td><td class="py-3 px-4">2026-02-12</td><td class="py-3 px-4 font-medium">PT Nusantara Sejahtera</td><td class="py-3 px-4">Jawa Timur</td><td class="py-3 px-4">30000000</td><td class="py-3 px-4"><span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-semibold">Sudah Dibayar</span></td><td class="py-3 px-4">12</td></tr>
                                <tr class="transition"><td class="py-3 px-4">KMP-005</td><td class="py-3 px-4">2026-02-20</td><td class="py-3 px-4 font-medium">PT Harapan Jaya</td><td class="py-3 px-4">Banten</td><td class="py-3 px-4">15000000</td><td class="py-3 px-4"><span class="bg-teal-50 text-teal-700 px-2.5 py-1 rounded-md text-xs font-semibold">Dalam Proses</span></td><td class="py-3 px-4">7</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- MODAL / POPUP PROFIL PENGGUNA -->
    <div x-show="showProfileCard" x-transition.opacity class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4" style="display: none;">
        <div @click.away="showProfileCard = false" class="w-full max-w-xl bg-[#101927] text-slate-100 rounded-3xl p-8 shadow-2xl border border-slate-700 relative">
            <button @click="showProfileCard = false" class="absolute top-6 right-6 text-slate-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 text-center md:text-left">
                <div class="w-28 h-28 rounded-full p-1 border-2 border-teal-400 shrink-0 overflow-hidden shadow-inner">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80" alt="Profil" class="w-full h-full object-cover rounded-full">
                </div>
                <div class="flex-1 space-y-2">
                    <span class="text-xs font-semibold text-teal-400 tracking-wider uppercase">PROFIL PENGGUNA</span>
                    <h3 class="text-3xl font-serif font-bold tracking-tight">Profil</h3>
                    <p class="text-sm text-slate-300 leading-relaxed pt-1">Analis Capaian · Kementerian Ketenagakerjaan · pengguna@kemnaker.go.id</p>
                    <div class="pt-4">
                        <button @click="currentMenu = 'settings'; showProfileCard = false;" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-5 py-2.5 rounded-xl text-xs transition inline-flex items-center shadow-md">Kelola Pengaturan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL / POPUP KONFIRMASI LOGOUT -->
    <div x-show="showLogoutModal" x-transition.opacity class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4" style="display: none;">
        <div @click.away="showLogoutModal = false" class="w-full max-w-sm rounded-3xl p-6 shadow-xl border transition-colors duration-200" :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </div>
                <h3 class="text-lg font-bold">Konfirmasi Keluar</h3>
                <p class="text-xs mt-1" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Apakah Anda yakin ingin keluar?</p>
            </div>
            <div class="flex items-center space-x-3">
                <button @click="showLogoutModal = false" class="flex-1 py-2.5 px-4 rounded-xl text-xs font-semibold border transition">Batal</button>
                <a href="{{ route('landing') }}" class="flex-1 py-2.5 px-4 rounded-xl text-xs font-semibold bg-blue-600 hover:bg-blue-700 text-white text-center transition shadow-sm">Ya, Keluar</a>
            </div>
        </div>
    </div>

<!-- SCRIPT RENDER APEXCHARTS -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const isDarkMode = document.documentElement.classList.contains('dark') || localStorage.getItem('_x_theme') === '"dark"';
        const textColor = isDarkMode ? '#cbd5e1' : '#475569';
        const gridColor = isDarkMode ? '#334155' : '#e2e8f0';

        // 1. Chart Tren Nominal
        new ApexCharts(document.querySelector("#chart-tren"), {
            series: [{ name: 'Nominal', data: [43000000, 57000000] }],
            chart: { type: 'bar', height: 250, background: 'transparent', toolbar: { show: false } },
            colors: ['#3b82f6'],
            plotOptions: { bar: { columnWidth: '15%', borderRadius: 3 } },
            dataLabels: { enabled: false },
            xaxis: { categories: ['2026-01', '2026-02'], labels: { style: { colors: textColor, fontSize: '10px' } } },
            yaxis: { show: false },
            grid: { borderColor: gridColor, strokeDashArray: 0 }
        }).render();

        // 2. Chart Provinsi
        new ApexCharts(document.querySelector("#chart-provinsi"), {
            series: [{ name: 'Pengaduan', data: [1, 1, 1, 1, 1] }],
            chart: { type: 'bar', height: 250, background: 'transparent', toolbar: { show: false } },
            colors: ['#10b981'],
            plotOptions: { bar: { columnWidth: '35%', borderRadius: 2 } },
            dataLabels: { enabled: false },
            xaxis: { categories: ['Jawa Barat', 'Jawa Tengah', 'DKI Jakarta', 'Jawa Timur', 'Banten'], labels: { style: { colors: textColor, fontSize: '9px' } } },
            yaxis: { show: false },
            grid: { borderColor: gridColor, strokeDashArray: 0 }
        }).render();

        // 3. Chart Status Donut
        new ApexCharts(document.querySelector("#chart-status"), {
            series: [2, 2, 1],
            labels: ['Sudah Dibayar', 'Dalam Proses', 'Belum Dibayar'],
            chart: { type: 'donut', height: 210, background: 'transparent' },
            colors: ['#3b82f6', '#10b981', '#f59e0b'],
            stroke: { show: false },
            dataLabels: { enabled: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            name: { show: false },
                            value: { show: true, fontSize: '22px', fontWeight: 'bold', color: isDarkMode ? '#fff' : '#1e293b' },
                            total: { show: true, label: 'data', color: textColor, formatter: () => 5 }
                        }
                    }
                }
            },
            legend: { position: 'bottom', labels: { colors: textColor } }
        }).render();

        // 4. Chart Rentang Nominal Line
        new ApexCharts(document.querySelector("#chart-rentang"), {
            series: [{ name: 'Jumlah', data: [5, 5, 5, 5, 1, 4] }],
            chart: { type: 'line', height: 180, background: 'transparent', toolbar: { show: false } },
            colors: ['#3b82f6'],
            stroke: { curve: 'straight', width: 2 },
            markers: { size: 4 },
            dataLabels: { enabled: false },
            xaxis: { categories: ['Rp 10.8j–14.4j', 'Rp 14.4j–18j', 'Rp 18j–21.6j', 'Rp 21.6j–25.2j', 'Rp 25.2j–28.8j', 'Rp 28.8j–32.4j'], labels: { style: { colors: textColor, fontSize: '9px' } } },
            yaxis: { show: false },
            grid: { show: false }
        }).render();
    });
</script>

</body>
</html>