<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Capaian - Kinerja Riksa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Plugin Alpine.js Persist (Wajib di atas script utama alpine agar tema tersimpan) -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine.js untuk kontrol state (Dashboard, Impor, Pengaturan, Tema, Modal Logout, dan Modal Profil) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
</head>
<body class="bg-slate-50 flex flex-col h-screen overflow-hidden" 
      x-data="{ 
          currentMenu: 'dashboard', 
          theme: $persist('light'),
          showLogoutModal: false,
          showProfileCard: false,
          fileName: 'Belum ada file',      
          fileStatus: 'Menunggu file',     
          showPreview: false,
          previewRows: [],
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
            <h1 class="text-xs md:text-sm font-bold tracking-tight">Hubungan Kerja - Kasus Penanganan Ijazah</h1>
            <span class="text-[11px] mt-0.5 text-slate-400">Data: 6 baris sumber</span>
        </div>
        
        <div class="flex items-center justify-end space-x-6">
            <button class="relative transition" :class="initTheme() === 'dark' ? 'text-slate-300 hover:text-white' : 'text-slate-400 hover:text-slate-600'">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            
            <!-- Tombol Profil Pengguna di Kanan Atas -->
            <div class="flex items-center space-x-3 border-l pl-6" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-200'">
                <button x-on:click="showProfileCard = true" class="flex items-center space-x-3 focus:outline-none group">
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
                    <a href="#" x-on:click.prevent="currentMenu = 'dashboard'" :class="currentMenu === 'dashboard' ? 'bg-[#1e293b] text-white' : 'hover:bg-[#1e293b] hover:text-white text-slate-300'" class="flex items-center px-3 py-3 rounded-xl group font-medium text-sm transition">
                        <svg class="w-5 h-5 mr-3 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard Capaian
                    </a>
                    <a href="#" x-on:click.prevent="currentMenu = 'import'" :class="currentMenu === 'import' ? 'bg-[#1e293b] text-white' : 'hover:bg-[#1e293b] hover:text-white text-slate-300'" class="flex items-center px-3 py-3 rounded-xl transition text-sm">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Impor Data
                    </a>
                    <a href="#" x-on:click.prevent="currentMenu = 'settings'" :class="currentMenu === 'settings' ? 'bg-[#1e293b] text-white' : 'hover:bg-[#1e293b] hover:text-white text-slate-300'" class="flex items-center px-3 py-3 rounded-xl transition text-sm">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pengaturan
                    </a>
                </nav>
            </div>
            
            <div class="absolute bottom-0 w-full bg-[#162133]">
                <div class="px-4 py-2 border-t border-slate-700">
                    <button x-on:click="showLogoutModal = true" class="w-full flex items-center px-3 py-2.5 hover:bg-[#1e293b] text-slate-400 hover:text-white rounded-xl transition text-sm text-left">
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
        <main class="flex-1 overflow-y-auto px-8 pt-4 pb-8 bg-slate-50 space-y-5 relative">
            
            <!-- TAB PENGATURAN -->
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
                            <label class="block text-xs font-semibold mb-2.5" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-700'">Tampilan Website</label>
                            <div class="flex items-center space-x-3">
                                <button type="button" x-on:click="theme = 'light'" 
                                        :class="theme === 'light' ? 'border-blue-600 text-blue-600 font-bold bg-blue-50/50' : (initTheme() === 'dark' ? 'border-slate-600 text-slate-300 hover:bg-slate-800' : 'border-slate-200 text-slate-600 hover:bg-slate-50')"
                                        class="px-5 py-2.5 border rounded-xl text-xs transition">
                                    Terang
                                </button>
                                <button type="button" x-on:click="theme = 'dark'" 
                                        :class="theme === 'dark' ? 'border-blue-500 text-white font-bold bg-slate-800' : (initTheme() === 'dark' ? 'border-slate-600 text-slate-300 hover:bg-slate-800' : 'border-slate-200 text-slate-600 hover:bg-slate-50')"
                                        class="px-5 py-2.5 border rounded-xl text-xs transition">
                                    Gelap
                                </button>
                                <button type="button" x-on:click="theme = 'system'" 
                                        :class="theme === 'system' ? 'border-blue-600 text-blue-600 font-bold bg-blue-50/50' : (initTheme() === 'dark' ? 'border-slate-600 text-slate-300 hover:bg-slate-800' : 'border-slate-200 text-slate-600 hover:bg-slate-50')"
                                        class="px-5 py-2.5 border rounded-xl text-xs transition">
                                    Mengikuti Sistem
                                </button>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="button" x-on:click="alert('Pengaturan berhasil disimpan!')" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-xl text-sm transition shadow-sm inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB IMPOR DATA -->
            <div x-show="currentMenu === 'import'" x-transition class="space-y-6" style="display: none;">
                <div class="p-8 rounded-3xl border shadow-sm transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    
                    <div class="flex justify-between items-start border-b pb-4 mb-6" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'">
                        <div>
                            <h3 class="text-lg font-bold">Unggah dan Periksa Data (Kasus Ijazah)</h3>
                            <p class="text-xs mt-0.5" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Data dari Excel akan ditampilkan sebagai pratinjau sebelum disimpan ke database.</p>
                        </div>
                    </div>

                    <form action="{{ url('/import-ijazah') }}" method="POST" id="formImportIjazah">
                        @csrf
                        <input type="hidden" name="data_excel" :value="JSON.stringify(previewRows)">

                        <div class="max-w-3xl mx-auto">
                            <div x-data="{ isDragging: false }"
                                 x-on:dragover.prevent="isDragging = true"
                                 x-on:dragleave.prevent="isDragging = false"
                                 x-on:drop.prevent="isDragging = false; 
                                                const dt = $event.dataTransfer;
                                                if (dt.files.length) {
                                                    document.getElementById('excelFileInput').files = dt.files;
                                                    fileName = dt.files[0].name;
                                                }"
                                 x-on:click="document.getElementById('excelFileInput').click()"
                                 :class="isDragging ? (initTheme() === 'dark' ? 'bg-slate-700 border-blue-400' : 'bg-blue-100 border-blue-400') : (initTheme() === 'dark' ? 'border-slate-600 bg-slate-800/40 hover:bg-slate-700/50' : 'border-blue-200 bg-blue-50/30 hover:bg-blue-50/60')"
                                 class="border-2 border-dashed rounded-2xl p-10 flex flex-col items-center justify-center text-center relative cursor-pointer transition-all duration-200">
                                
                                <input type="file" id="csvFileInput" class="hidden" accept=".csv" x-on:change="fileName = $event.target.files[0] ? $event.target.files[0].name : 'Belum ada file'; showPreview = false;">
                                <input type="file" id="excelFileInput" class="hidden" accept=".xls,.xlsx,.csv" x-on:change="fileName = $event.target.files[0] ? $event.target.files[0].name : 'Belum ada file'; showPreview = false;">

                                <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                </div>
                                <h4 class="text-base font-bold mb-1">Unggah File Data</h4>
                                <p class="text-xs max-w-md mb-2" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Klik area ini atau tarik dan lepas file Excel/CSV ke sini.</p>
                                
                                <p class="text-sm font-bold text-teal-600 dark:text-teal-400 mb-6 bg-teal-50 dark:bg-teal-900/30 px-3 py-1 rounded-full" 
                                   x-show="fileName !== 'Belum ada file'" x-text="'📁 ' + fileName" style="display: none;"></p>
                                
                                <div class="flex flex-wrap items-center justify-center gap-3 mt-2">
                                    <button type="button" x-on:click.stop="document.getElementById('csvFileInput').click()" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-5 py-2.5 rounded-xl transition shadow-sm cursor-pointer z-10 relative">Pilih File CSV</button>
                                    <button type="button" x-on:click.stop="document.getElementById('excelFileInput').click()" class="border hover:bg-opacity-80 text-xs font-semibold px-5 py-2.5 rounded-xl transition cursor-pointer z-10 relative" :class="initTheme() === 'dark' ? 'border-slate-600 text-slate-200 bg-slate-800' : 'border-slate-200 text-slate-700 bg-white'">Impor File Excel</button>
                                    
                                    <button type="button" x-on:click.stop="
                                        if(fileName !== 'Belum ada file') { 
                                            let fileInput = document.getElementById('excelFileInput').files.length > 0 ? document.getElementById('excelFileInput') : document.getElementById('csvFileInput');
                                            let file = fileInput.files[0];
                                            if(file) {
                                                let reader = new FileReader();
                                                reader.onload = function(e) {
                                                    let data = new Uint8Array(e.target.result);
                                                    let workbook = XLSX.read(data, {type: 'array'});
                                                    let firstSheet = workbook.Sheets[workbook.SheetNames[0]];
                                                    previewRows = XLSX.utils.sheet_to_json(firstSheet, {header: 1, defval: '-', raw: false}); 
                                                    showPreview = true;
                                                };
                                                reader.readAsArrayBuffer(file);
                                            }
                                        } else { 
                                            alert('Silakan pilih atau unggah file terlebih dahulu!'); 
                                        }" 
                                        class="bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold px-8 py-2.5 rounded-xl transition shadow-sm cursor-pointer z-10 relative">
                                        Oke
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- TABEL PRATINJAU -->
                        <div x-show="showPreview" x-transition class="mt-10 pt-8 border-t" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'" style="display: none;">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-4 gap-4">
                                <div>
                                    <h3 class="text-base font-bold">Pratinjau Data Unggahan</h3>
                                </div>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-5 py-2.5 rounded-xl transition shadow-sm cursor-pointer flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                    Simpan ke Dashboard
                                </button>
                            </div>
                            
                            <div class="overflow-x-auto rounded-lg border max-h-[400px] overflow-y-auto" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-200'">
                                <table class="w-full text-left border-collapse whitespace-nowrap">
                                    <thead>
                                        <tr class="bg-[#162133] text-white text-[10px] font-bold uppercase tracking-wider sticky top-0 z-10">
                                            <th class="py-3 px-4">NO</th>
                                            <th class="py-3 px-4">NAMA PERUSAHAAN</th>
                                            <th class="py-3 px-4">NAMA PENGADU</th>
                                            <th class="py-3 px-4">SUMBER</th>
                                            <th class="py-3 px-4">TANGGAL</th>
                                            <th class="py-3 px-4">STATUS</th>
                                            <th class="py-3 px-4">TINDAK LANJUT</th>
                                            <th class="py-3 px-4">PROVINSI</th>
                                            <th class="py-3 px-4">JUMLAH</th>
                                            <th class="py-3 px-4">LAMPIRAN 1</th>
                                            <th class="py-3 px-4">LAMPIRAN 2</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y text-sm" :class="initTheme() === 'dark' ? 'divide-slate-700 text-slate-300' : 'divide-slate-200 text-slate-700'">
                                        <template x-for="(row, index) in previewRows" :key="index">
                                            <tr x-show="index > 0" class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                                                <td class="py-3 px-4" x-text="row[0]"></td>
                                                <td class="py-3 px-4 font-semibold" x-text="row[1]"></td>
                                                <td class="py-3 px-4" x-text="row[2]"></td>
                                                <td class="py-3 px-4" x-text="row[3]"></td>
                                                <td class="py-3 px-4" x-text="row[4]"></td>
                                                <td class="py-3 px-4">
                                                    <span class="px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider" 
                                                          :class="String(row[5]).toLowerCase().includes('selesai') ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'"
                                                          x-text="row[5]"></span>
                                                </td>
                                                <td class="py-3 px-4 max-w-xs truncate" :title="row[6]" x-text="row[6]"></td>
                                                <td class="py-3 px-4" x-text="row[7]"></td>
                                                <td class="py-3 px-4 text-center font-bold" x-text="row[8]"></td>
                                                <td class="py-3 px-4 text-xs" x-text="row[9]"></td>
                                                <td class="py-3 px-4 text-xs" x-text="row[10]"></td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <!-- TAB DASHBOARD -->
            <div x-show="currentMenu === 'dashboard'" x-transition class="space-y-8">
                
                <div>
                    <span class="text-xs font-bold text-emerald-600 tracking-wider uppercase">BINA PEMERIKSAAN NORMA KETENAGAKERJAAN</span>
                    <h2 class="text-2xl font-bold mt-1 tracking-tight" :class="initTheme() === 'dark' ? 'text-slate-100' : 'text-slate-900'">Dashboard Capaian Kinerja</h2>
                    <p class="text-xs md:text-sm mt-1" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Pantau KPI, grafik, peta provinsi, tabel, dan notifikasi berdasarkan substansi, periode, serta data unggahan yang dipilih.</p>
                </div>

                <div class="p-6 rounded-2xl border shadow-sm transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-5">
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-500'">Substansi</label>
                            <select class="w-full border rounded-xl px-3 py-2.5 text-sm outline-none transition"
                                    :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100' : 'bg-slate-50 border-slate-200 text-slate-700'">
                                <option>Hubungan Kerja</option>
                                <option>Perempuan dan Anak</option>
                                <option>K3</option>
                                <option>Waktu Kerja Waktu Istirahat (WKWI)</option>
                                <option>Penyidikan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-500'">Jenis Capaian</label>
                            <select class="w-full border rounded-xl px-3 py-2.5 text-sm outline-none transition"
                                    :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100' : 'bg-slate-50 border-slate-200 text-slate-700'">
                                <option>Kasus Penanganan Ijazah</option>
                                <option>Kompensasi</option>
                                <option>Waspadu</option>
                                <option>Penetapan Ulang</option>
                                <option>Data Putusan Sidik</option>
                                <option>Pengawasan TKA</option>
                                <option>Norma K3</option>
                                <option>Pemeriksaan Norma Kerja & Perempuan</option>
                                <option>Posko THR</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-500'">Tahun</label>
                            <select class="w-full border rounded-xl px-3 py-2.5 text-sm outline-none transition"
                                    :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100' : 'bg-slate-50 border-slate-200 text-slate-700'">
                                <option>Semua Tahun</option>
                                <option>2025</option>
                                <option>2026</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" :class="initTheme() === 'dark' ? 'text-slate-300' : 'text-slate-500'">Bulan</label>
                            <select class="w-full border rounded-xl px-3 py-2.5 text-sm outline-none transition"
                                    :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-600 text-slate-100' : 'bg-slate-50 border-slate-200 text-slate-700'">
                                <option>Semua Bulan</option>
                                <option>Januari</option><option>Februari</option><option>Maret</option><option>April</option><option>Mei</option><option>Juni</option><option>Juli</option><option>Agustus</option><option>September</option><option>Oktober</option><option>November</option><option>Desember</option>
                            </select>
                        </div>
                    </div>
                </div>

<!-- RINGKASAN DATA (4 KOTAK) - LIVE DATABASE -->
                    <div class="mb-2">
                        <p class="text-xs" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">KPI dihitung dari Data contoh, bukan data aktual.</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-5">
                        <div class="bg-[#162133] p-5 rounded-2xl border border-slate-700/80 shadow-md">
                            <p class="text-xs font-medium text-slate-400 mb-2">Total Kasus Masuk</p>
                            <h3 class="text-3xl font-extrabold text-white mb-1">{{ $totalPengaduan }}</h3>
                            <p class="text-[10px] text-slate-400">Seluruh aduan terdaftar</p>
                        </div>
                        <div class="bg-[#162133] p-5 rounded-2xl border border-slate-700/80 shadow-md">
                            <p class="text-xs font-medium text-slate-400 mb-2">Total Ijazah Ditahan</p>
                            <h3 class="text-3xl font-extrabold text-amber-500 mb-1">{{ $totalDitahan }}</h3>
                            <p class="text-[10px] text-slate-400">Akumulasi ijazah tertahan</p>
                        </div>
                        <div class="bg-[#162133] p-5 rounded-2xl border border-slate-700/80 shadow-md">
                            <p class="text-xs font-medium text-slate-400 mb-2">Total Pengembalian</p>
                            <h3 class="text-3xl font-extrabold text-emerald-500 mb-1">{{ $totalDikembalikan }}</h3>
                            <p class="text-[10px] text-slate-400">Ijazah yang dikembalikan</p>
                        </div>
                        <div class="bg-[#162133] p-5 rounded-2xl border border-slate-700/80 shadow-md">
                            <p class="text-xs font-medium text-slate-400 mb-2">Tingkat Keberhasilan</p>
                            <h3 class="text-3xl font-extrabold text-blue-400 mb-1">
                                {{ $totalDitahan + $totalDikembalikan > 0 ? round(($totalDikembalikan / ($totalDitahan + $totalDikembalikan)) * 100, 1) : 0 }}%
                            </h3>
                            <p class="text-[10px] text-slate-400">Rasio pengembalian sukses</p>
                        </div>
                    </div>

                    <!-- 3 DIAGRAM GRAFIK CAPAIAN - LIVE DATABASE -->
                    <div class="mb-8">
                        <h2 class="text-base font-bold text-white mb-1">Statistik Capaian (Real-time)</h2>
                        <p class="text-[11px] text-slate-400 mb-4">Grafik otomatis menyesuaikan dengan isi database.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <!-- Grafik 1: Status Penanganan -->
                            <div class="bg-[#162133] p-6 rounded-2xl border border-slate-700/80 h-64 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xs font-bold text-white">Status Penanganan</h3>
                                    <p class="text-[10px] text-slate-400">Rasio Selesai vs Proses</p>
                                </div>
                                <div class="flex items-center gap-4 mt-2">
                                    <div class="w-16 h-16 rounded-full border-[6px] border-slate-700 flex items-center justify-center flex-col shrink-0 relative overflow-hidden">
                                        <!-- Simulasi Donut Chart CSS Sederhana -->
                                        <div class="absolute inset-0 bg-blue-500" style="clip-path: polygon(0 0, 100% 0, 100% {{ $persenSelesai }}%, 0 {{ $persenSelesai }}%);"></div>
                                        <div class="absolute inset-1 bg-[#162133] rounded-full flex items-center justify-center">
                                            <span class="text-white font-bold text-xs relative z-10">{{ $totalPengaduan }}</span>
                                        </div>
                                    </div>
                                    <div class="w-full text-xs text-slate-300 space-y-2">
                                        <div class="flex justify-between border-b border-slate-700 pb-1">
                                            <span class="flex items-center gap-1.5"><div class="w-2 h-2 bg-blue-500 rounded-full"></div> Selesai</span>
                                            <span class="font-bold text-[11px]">{{ $statusSelesai }} ({{ $persenSelesai }}%)</span>
                                        </div>
                                        <div class="flex justify-between border-b border-slate-700 pb-1">
                                            <span class="flex items-center gap-1.5"><div class="w-2 h-2 bg-slate-700 rounded-full"></div> Proses</span>
                                            <span class="font-bold text-[11px]">{{ $statusProses }} ({{ $persenProses }}%)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Grafik 2: Top Perusahaan -->
                            <div class="bg-[#162133] p-6 rounded-2xl border border-slate-700/80 h-64 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xs font-bold text-white">Top 4 Perusahaan</h3>
                                    <p class="text-[10px] text-slate-400">Paling banyak dilaporkan</p>
                                </div>
                                <div class="w-full h-32 flex items-end justify-around border-b border-slate-700 pb-2">
                                    @foreach($topPerusahaan as $nama => $jumlah)
                                        <div class="w-10 bg-amber-500 rounded-t relative group transition-all" style="height: {{ ($jumlah / $maxPerusahaan) * 100 }}%;">
                                            <span class="absolute -top-5 left-1/2 -translate-x-1/2 text-[9px] text-white opacity-0 group-hover:opacity-100 transition-opacity">{{ $jumlah }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex justify-around text-[9px] text-slate-400 mt-2">
                                    @foreach($topPerusahaan as $nama => $jumlah)
                                        <span class="truncate w-10 text-center cursor-help" title="{{ $nama }}">{{ substr($nama, 0, 5) }}..</span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Grafik 3: Top Provinsi -->
                            <div class="bg-[#162133] p-6 rounded-2xl border border-slate-700/80 h-64 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xs font-bold text-white">Top 5 Provinsi</h3>
                                    <p class="text-[10px] text-slate-400">Sebaran wilayah terbanyak</p>
                                </div>
                                <div class="w-full h-32 flex items-end justify-around border-b border-slate-700 pb-2">
                                    @foreach($topProvinsi as $prov => $jumlah)
                                        <div class="w-8 bg-emerald-500 rounded-t relative group transition-all" style="height: {{ ($jumlah / $maxProvinsi) * 100 }}%;">
                                            <span class="absolute -top-5 left-1/2 -translate-x-1/2 text-[9px] text-white opacity-0 group-hover:opacity-100 transition-opacity">{{ $jumlah }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex justify-around text-[9px] text-slate-400 mt-2">
                                    @foreach($topProvinsi as $prov => $jumlah)
                                        <span class="truncate w-8 text-center cursor-help" title="{{ $prov }}">{{ substr($prov, 0, 4) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PETA PROVINSI & RINGKASAN WILAYAH -->
<!-- Area Peta Provinsi (Google GeoChart Real-time) -->
                        <div class="bg-[#162133] rounded-2xl border border-slate-700 h-72 md:col-span-2 flex items-center justify-center shadow-md relative overflow-hidden p-2">
                            <!-- Container untuk Peta -->
                            <div id="map_indonesia" class="w-full h-full"></div>
                        </div>

                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load('current', {
                                'packages':['geochart']
                            });
                            google.charts.setOnLoadCallback(drawRegionsMap);
                            function drawRegionsMap() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Provinsi', 'Jumlah Kasus'],
                                    @foreach($perProvinsi as $prov => $jumlah)
                                        @php
                                            $namaProv = trim($prov);
                                            
                                            if (stripos($namaProv, 'Jakarta') !== false) {
                                                $namaProv = 'Jakarta Raya';
                                            } elseif (stripos($namaProv, 'Yogyakarta') !== false || stripos($namaProv, 'DIY') !== false) {
                                                $namaProv = 'Yogyakarta';
                                            } elseif (stripos($namaProv, 'Bangka Belitung') !== false) {
                                                $namaProv = 'Bangka-Belitung'; 
                                            }
                                        @endphp
                                        ['{{ $namaProv }}', {{ $jumlah }}],
                                    @endforeach
                                ]);

                                var options = {
                                    region: 'ID', // Kode Negara Indonesia
                                    resolution: 'provinces', // Memotong peta berdasarkan batas provinsi
                                    backgroundColor: 'transparent',
                                    datalessRegionColor: '#1e293b', // Warna gelap (slate-800) untuk provinsi yang datanya 0
                                    colorAxis: {
                                        // Gradasi warna kasus: Biru (sedikit) -> Hijau -> Kuning/Oranye (banyak)
                                        colors: ['#3b82f6', '#10b981', '#f59e0b'] 
                                    },
                                    tooltip: { textStyle: { color: '#0f172a' }, showColorCode: true },
                                    keepAspectRatio: true
                                };

                                var chart = new google.visualization.GeoChart(document.getElementById('map_indonesia'));
                                chart.draw(data, options);
                            }
                        </script>
                        
                        <!-- Ringkasan Wilayah (Terhubung ke Data Provinsi dari Controller) -->
                        <div class="bg-[#162133] rounded-2xl border border-slate-700 p-6 h-72 overflow-y-auto shadow-md">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-white font-bold text-sm">Ringkasan Wilayah</h3>
                                <span class="bg-teal-900/50 text-teal-400 text-[9px] font-bold px-2 py-1 rounded border border-teal-800">Aktif</span>
                            </div>
                            <p class="text-[11px] text-slate-400 mb-4 border-b border-slate-700 pb-2">Distribusi data berdasarkan wilayah provinsi.</p>
                            <ul class="text-xs font-medium text-slate-300 space-y-2">
                                @foreach($perProvinsi as $prov => $jumlah)
                                <li class="flex justify-between items-center border-b border-slate-800 pb-1.5">
                                    <span>{{ $prov }}</span>
                                    <span class="font-bold text-white bg-slate-800 px-2 py-0.5 rounded">{{ $jumlah }} kasus</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                <!-- TABEL DATA FILE AKTIF (DASHBOARD) -->
                <div class="rounded-2xl border shadow-sm overflow-hidden pb-6 transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    <div class="p-6 border-b" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-base font-bold">Data File Aktif</h3>
                                <p class="text-xs mt-0.5" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Data riwayat penanganan kasus penahanan ijazah.</p>
                            </div>
                            <span class="bg-blue-50 text-blue-700 border border-blue-200 text-xs px-3 py-1 rounded-full font-semibold">
                                Total: {{ count($dataIjazah) }} Data
                            </span>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr class="bg-[#162133] text-white text-xs uppercase tracking-wider sticky top-0 z-10">
                                    <th class="py-3 px-4 font-semibold">NO</th>
                                    <th class="py-3 px-4 font-semibold">PERUSAHAAN</th>
                                    <th class="py-3 px-4 font-semibold">TANGGAL</th>
                                    <th class="py-3 px-4 font-semibold">PROVINSI</th>
                                    <th class="py-3 px-4 font-semibold text-center">DITAHAN</th>
                                    <th class="py-3 px-4 font-semibold text-center">DIKEMBALIKAN</th>
                                    <th class="py-3 px-4 font-semibold">STATUS & TINDAK LANJUT</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y text-sm" :class="initTheme() === 'dark' ? 'divide-slate-700 text-slate-300' : 'divide-slate-100 text-slate-700'">
                                
                                <!-- LOOPING DATA DARI DATABASE -->
                                @forelse($dataIjazah as $index => $data)
                                <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                    <td class="py-3 px-4">{{ $index + 1 }}</td>
                                    <td class="py-3 px-4 font-semibold">{{ $data->perusahaan }}</td>
                                    <td class="py-3 px-4">{{ $data->tanggal ? date('d-m-Y', strtotime($data->tanggal)) : '-' }}</td>
                                    <td class="py-3 px-4">{{ $data->provinsi }}</td>
                                    <td class="py-3 px-4 text-center font-bold text-amber-600">{{ $data->jumlah_ijazah_ditahan }}</td>
                                    <td class="py-3 px-4 text-center font-bold text-emerald-600">{{ $data->jumlah_pengembalian_ijazah }}</td>
                                    <td class="py-3 px-4 max-w-xs truncate" title="{{ $data->status_tindak_lanjut }}">
                                        {{ $data->status_tindak_lanjut }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="py-8 px-4 text-center italic text-slate-400">
                                        Belum ada data di database. Silakan lakukan Impor Data.
                                    </td>
                                </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- MODAL PROFIL -->
    <div x-show="showProfileCard" x-transition.opacity class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4" style="display: none;">
        <div x-on:click.away="showProfileCard = false" class="w-full max-w-xl bg-[#101927] text-slate-100 rounded-3xl p-8 shadow-2xl border border-slate-700 relative">
            <button x-on:click="showProfileCard = false" class="absolute top-6 right-6 text-slate-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 text-center md:text-left">
                <div class="w-28 h-28 rounded-full p-1 border-2 border-teal-400 shrink-0 overflow-hidden shadow-inner">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80" alt="Profil" class="w-full h-full object-cover rounded-full">
                </div>
                <div class="flex-1 space-y-2">
                    <span class="text-xs font-semibold text-teal-400 tracking-wider uppercase">PROFIL PENGGUNA</span>
                    <h3 class="text-3xl font-serif font-bold tracking-tight">Profil</h3>
                    <p class="text-sm text-slate-300 leading-relaxed pt-1">
                        Analis Capaian · Kementerian Ketenagakerjaan · pengguna@kemnaker.go.id
                    </p>
                    <div class="pt-4">
                        <button x-on:click="currentMenu = 'settings'; showProfileCard = false;" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-5 py-2.5 rounded-xl text-xs transition inline-flex items-center shadow-md">
                            Kelola Pengaturan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL LOGOUT -->
    <div x-show="showLogoutModal" x-transition.opacity class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4" style="display: none;">
        <div x-on:click.away="showLogoutModal = false" class="w-full max-w-sm rounded-3xl p-6 shadow-xl border transition-colors duration-200"
             :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
            
            <div class="text-center mb-6">
                <h3 class="text-lg font-bold">Konfirmasi Keluar</h3>
                <p class="text-xs mt-1" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Apakah Anda yakin ingin keluar?</p>
            </div>

            <div class="flex items-center space-x-3">
                <button x-on:click="showLogoutModal = false" class="flex-1 py-2.5 px-4 rounded-xl text-xs font-semibold border transition"
                        :class="initTheme() === 'dark' ? 'border-slate-600 bg-[#162133] text-slate-300 hover:bg-slate-800' : 'border-slate-200 bg-slate-50 text-slate-700 hover:bg-slate-100'">
                    Batal
                </button>
                <a href="{{ route('landing') }}" class="flex-1 py-2.5 px-4 rounded-xl text-xs font-semibold bg-blue-600 hover:bg-blue-700 text-white text-center transition shadow-sm">
                    Ya, Keluar
                </a>
            </div>
        </div>
    </div>

<!-- Script Render ApexCharts -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const isDarkMode = document.documentElement.classList.contains('dark') || localStorage.getItem('_x_theme') === '"dark"';
        const textColor = isDarkMode ? '#cbd5e1' : '#475569';

        const donutOptions = {
            series: [43, 30],
            labels: ['Jumlah Ijazah yang Ditahan', 'Jumlah Pengembalian Ijazah'],
            chart: { type: 'donut', height: 280, background: 'transparent' },
            colors: ['#4fd1c5', '#60a5fa'],
            stroke: { show: false },
            dataLabels: { enabled: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            name: { show: false },
                            value: { show: true, fontSize: '24px', fontWeight: 'bold', color: isDarkMode ? '#fff' : '#1e293b' },
                            total: { show: true, showAlways: true, label: 'total', color: textColor, formatter: function (w) { return 73 } }
                        }
                    }
                }
            },
            legend: { position: 'right', offsetY: 40, labels: { colors: textColor } }
        };
        new ApexCharts(document.querySelector("#chart-donut"), donutOptions).render();

        const areaOptions = {
            series: [{ name: 'Data', data: [0, 0] }], 
            chart: { type: 'area', height: 250, background: 'transparent', toolbar: { show: false } },
            colors: ['#4fd1c5'],
            fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05, stops: [0, 100] } },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            xaxis: {
                categories: ['2026 - Jan', '2026 - Feb'],
                labels: { style: { colors: textColor } },
                axisBorder: { show: false }, axisTicks: { show: false }
            },
            yaxis: { show: false },
            grid: { borderColor: isDarkMode ? '#334155' : '#e2e8f0', strokeDashArray: 4 }
        };
        new ApexCharts(document.querySelector("#chart-area"), areaOptions).render();

        const barOptions = {
            series: [{ name: 'Jumlah', data: [65, 55, 35, 28, 20] }],
            chart: { type: 'bar', height: 250, background: 'transparent', toolbar: { show: false } },
            colors: ['#4fd1c5'],
            plotOptions: { bar: { columnWidth: '30%', borderRadius: 4, dataLabels: { position: 'top' } } },
            dataLabels: { enabled: false },
            xaxis: {
                categories: ['Jawa Timur', 'Jawa Barat', 'Jawa Tengah', 'Banten', 'DKI Jakarta'],
                labels: { style: { colors: textColor, fontSize: '11px' } },
                axisBorder: { show: false }, axisTicks: { show: false }
            },
            yaxis: { show: false },
            grid: { borderColor: isDarkMode ? '#334155' : '#e2e8f0', position: 'back', strokeDashArray: 0 }
        };
        new ApexCharts(document.querySelector("#chart-bar"), barOptions).render();
    });
</script>
</body>
</html>