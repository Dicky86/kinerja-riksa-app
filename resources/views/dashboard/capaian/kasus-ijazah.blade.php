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
</head>
<body class="bg-slate-50 flex flex-col h-screen overflow-hidden" 
      x-data="{ 
          currentMenu: 'dashboard', 
          theme: $persist('light'),
          showLogoutModal: false,
          showProfileCard: false,
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
                
                <!-- Menu Home (MENGARAH KEMBALI KE RINGKASAN KINERJA) -->
                <a href="{{ route('home') }}" class="flex items-center px-3 py-3 rounded-xl hover:bg-[#1e293b] hover:text-white text-slate-300 group font-medium text-sm transition mb-6">
                    <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Home
                </a>

                <div class="text-[10px] font-semibold text-slate-500 mb-3 px-2 tracking-wider uppercase">MENU UTAMA</div>
                <nav class="space-y-1">
                    <!-- Dashboard Capaian -->
                    <a href="#" @click.prevent="currentMenu = 'dashboard'" :class="currentMenu === 'dashboard' ? 'bg-[#1e293b] text-white' : 'hover:bg-[#1e293b] hover:text-white text-slate-300'" class="flex items-center px-3 py-3 rounded-xl group font-medium text-sm transition">
                        <!-- Icon diubah menjadi kotak seperti pada desain -->
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
            
            <!-- Area Bawah Sidebar: Tombol Logout & Keterangan -->
            <div class="absolute bottom-0 w-full bg-[#162133]">
                <!-- Tombol Logout (Memicu Modal Konfirmasi) -->
                <div class="px-4 py-2 border-t border-slate-700">
                    <button @click="showLogoutModal = true" class="w-full flex items-center px-3 py-2.5 hover:bg-[#1e293b] text-slate-400 hover:text-white rounded-xl transition text-sm text-left">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </div>
                <!-- Keterangan Sidebar (Sesuai Gambar Desain) -->
                <div class="px-6 pb-6 pt-2 text-[10px] text-slate-500 leading-relaxed">
                    Dashboard terintegrasi untuk pemantauan capaian berdasarkan data unggahan yang telah divalidasi.
                </div>
            </div>
        </aside>

        <!-- AREA KONTEN ISI UTAMA -->
        <main class="flex-1 overflow-y-auto p-8 bg-slate-50 space-y-8 relative">
            
            <!-- ======================================================= -->
            <!-- TAB: HALAMAN PENGATURAN -->
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
            <!-- TAB: HALAMAN IMPOR DATA -->
            <!-- ======================================================= -->
            <div x-show="currentMenu === 'import'" x-transition class="space-y-6" style="display: none;">
                <div class="p-8 rounded-3xl border shadow-sm transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    
                    <div class="flex justify-between items-start border-b pb-4 mb-6" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'">
                        <div>
                            <h3 class="text-lg font-bold">Unggah dan Periksa Data</h3>
                            <p class="text-xs mt-0.5" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Data aktual dari CSV ditampilkan sebelum disimpan ke dashboard aktif.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 border-2 border-dashed rounded-2xl p-8 flex flex-col items-center justify-center text-center"
                             :class="initTheme() === 'dark' ? 'border-slate-600 bg-slate-800/40' : 'border-blue-200 bg-blue-50/30'">
                            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <h4 class="text-sm font-bold mb-1">Unggah File CSV</h4>
                            <p class="text-xs max-w-md mb-6" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Pilih file dari perangkat Anda. Nama kolom, tipe data, isi baris, dan urutan kolom akan dibaca dari file.</p>
                            
                            <div class="flex flex-wrap items-center justify-center gap-3">
                                <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition shadow-sm">Pilih File</button>
                                <button type="button" class="border hover:bg-opacity-80 text-xs font-semibold px-4 py-2.5 rounded-xl transition" :class="initTheme() === 'dark' ? 'border-slate-600 text-slate-200 bg-slate-800' : 'border-slate-200 text-slate-700 bg-white'">Impor File Excel</button>
                                <button type="button" class="border hover:bg-opacity-80 text-xs font-semibold px-4 py-2.5 rounded-xl transition" :class="initTheme() === 'dark' ? 'border-slate-600 text-slate-200 bg-slate-800' : 'border-slate-200 text-slate-700 bg-white'">Unduh Template</button>
                            </div>
                        </div>

                        <div class="border rounded-2xl p-6 flex flex-col justify-between" :class="initTheme() === 'dark' ? 'bg-slate-800/50 border-slate-700' : 'bg-slate-50 border-slate-200'">
                            <div>
                                <h4 class="text-sm font-bold mb-4">Status Validasi</h4>
                                <div class="space-y-4 text-xs">
                                    <div class="flex justify-between items-center border-b pb-3" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-200'">
                                        <span :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Nama file</span>
                                        <span class="font-semibold">Belum ada file</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b pb-3" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-200'">
                                        <span :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Status</span>
                                        <span class="bg-slate-600 text-white px-2.5 py-1 rounded-md font-semibold">Menunggu file</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 mt-6">
                                <button type="button" class="flex-1 border text-xs font-semibold py-2.5 rounded-xl transition" :class="initTheme() === 'dark' ? 'border-slate-600 bg-slate-800 text-slate-200' : 'border-slate-200 bg-white text-slate-700'">Validasi Data</button>
                                <button type="button" class="flex-1 bg-blue-600 text-white text-xs font-semibold py-2.5 rounded-xl transition shadow-sm">Terapkan Data</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ======================================================= -->
            <!-- TAB: DASHBOARD UTAMA (DEFAULT) -->
            <!-- ======================================================= -->
            <div x-show="currentMenu === 'dashboard'" x-transition class="space-y-8">
                
                <!-- Judul Section -->
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

                <!-- RINGKASAN DATA (KPI CARDS) -->
                <div class="p-6 rounded-2xl border shadow-sm transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div>
                            <h3 class="text-base font-bold">Ringkasan Data</h3>
                            <p class="text-xs" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">KPI dihitung dari Data contoh, bukan data aktual.</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 text-xs">
                            <span class="px-3 py-1 rounded-full font-medium" :class="initTheme() === 'dark' ? 'bg-slate-800 text-slate-300' : 'bg-slate-100 text-slate-600'">Substansi: Hubungan Kerja</span>
                            <span class="px-3 py-1 rounded-full font-medium" :class="initTheme() === 'dark' ? 'bg-slate-800 text-slate-300' : 'bg-slate-100 text-slate-600'">Sumber: Data contoh</span>
                            <span class="px-3 py-1 rounded-full font-medium" :class="initTheme() === 'dark' ? 'bg-slate-800 text-slate-300' : 'bg-slate-100 text-slate-600'">6 baris</span>
                            <span class="px-3 py-1 rounded-full font-medium" :class="initTheme() === 'dark' ? 'bg-slate-800 text-slate-300' : 'bg-slate-100 text-slate-600'">11 kolom</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div class="p-4 rounded-xl border flex flex-col justify-between transition-colors" :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <span class="text-xs font-semibold" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Jumlah Pengaduan</span>
                            <div class="my-3"><span class="text-3xl font-extrabold">70</span></div>
                            <span class="text-[11px] text-slate-400">Dihitung dari jumlah baris. 1 baris = 1 pengaduan</span>
                        </div>
                        <div class="p-4 rounded-xl border flex flex-col justify-between transition-colors" :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <span class="text-xs font-semibold" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Ijazah yang Ditahan</span>
                            <div class="my-3"><span class="text-3xl font-extrabold">49</span></div>
                            <span class="text-[11px] text-slate-400">Jumlah Ijazah yang Ditahan</span>
                        </div>
                        <div class="p-4 rounded-xl border flex flex-col justify-between transition-colors" :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <span class="text-xs font-semibold" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Pengaduan yang Ditindaklanjuti</span>
                            <div class="my-3"><span class="text-3xl font-extrabold">59</span></div>
                            <span class="text-[11px] text-slate-400">Status Tindak Lanjut</span>
                        </div>
                        <div class="p-4 rounded-xl border flex flex-col justify-between transition-colors" :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <span class="text-xs font-semibold" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Ijazah yang Dikembalikan</span>
                            <div class="my-3"><span class="text-3xl font-extrabold">40</span></div>
                            <span class="text-[11px] text-slate-400">Jumlah Pengembalian Ijazah</span>
                        </div>
                        <div class="p-4 rounded-xl border flex flex-col justify-between transition-colors" :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <span class="text-xs font-semibold" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Jumlah Perusahaan yang Dilaporkan</span>
                            <div class="my-3"><span class="text-3xl font-extrabold">5</span></div>
                            <span class="text-[11px] text-slate-400">Total perusahaan unik. sumber : Nama Perusahaan</span>
                        </div>
                    </div>
                </div>

                <!-- TABEL PERUSAHAAN -->
                <div class="rounded-2xl border shadow-sm overflow-hidden transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    <div class="p-6 border-b" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'">
                        <h3 class="text-base font-bold">Perusahaan Paling Banyak Diadukan</h3>
                        <p class="text-xs mt-0.5" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">TOP 5 perusahaan terbanyak dilaporkan berdasarkan data dan filter aktif; nilai sama berbagi perangkat</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-[#162133] text-white text-xs uppercase tracking-wider">
                                    <th class="py-3.5 px-6 font-semibold w-28">Peringkat</th>
                                    <th class="py-3.5 px-6 font-semibold">Nama Perusahaan</th>
                                    <th class="py-3.5 px-6 font-semibold text-right">Jumlah Pengaduan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y text-sm" :class="initTheme() === 'dark' ? 'divide-slate-700 text-slate-200' : 'divide-slate-100 text-slate-700'">
                                <tr class="transition"><td class="py-3.5 px-6 font-medium">1</td><td class="py-3.5 px-6 font-medium">PT Bahari Sentosa</td><td class="py-3.5 px-6 text-right">1</td></tr>
                                <tr class="transition"><td class="py-3.5 px-6 font-medium">1</td><td class="py-3.5 px-6 font-medium">PT Bumi Kencana</td><td class="py-3.5 px-6 text-right">1</td></tr>
                                <tr class="transition"><td class="py-3.5 px-6 font-medium">1</td><td class="py-3.5 px-6 font-medium">PT Cipta Mandiri</td><td class="py-3.5 px-6 text-right">1</td></tr>
                                <tr class="transition"><td class="py-3.5 px-6 font-medium">1</td><td class="py-3.5 px-6 font-medium">PT Nusantara Karya</td><td class="py-3.5 px-6 text-right">1</td></tr>
                                <tr class="transition"><td class="py-3.5 px-6 font-medium">1</td><td class="py-3.5 px-6 font-medium">PT Sejahtera Abadi</td><td class="py-3.5 px-6 text-right">1</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

<!-- GRAFIK CAPAIAN -->
                <div class="space-y-4">
                    <div>
                        <h3 class="text-base font-bold" :class="initTheme() === 'dark' ? 'text-slate-100' : 'text-slate-800'">Grafik Capaian</h3>
                        <p class="text-xs" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Grafik dihitung dari Data contoh sesuai filter aktif.</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <!-- Grafik 1: Donut (Kiri Atas) -->
                        <div class="p-6 rounded-2xl border shadow-sm flex flex-col transition-colors duration-200" 
                             :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <div class="mb-2">
                                <h3 class="text-sm font-bold">Ijazah Ditahan vs Ijazah Dikembalikan</h3>
                                <p class="text-[11px]" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Jumlah dan persentase dari baris yang lolos filter aktif.</p>
                            </div>
                            <div id="chart-donut" class="flex-1 w-full flex justify-center items-center min-h-[250px]"></div>
                        </div>

                        <!-- Grafik 2: Tren Status (Kanan Atas) -->
                        <div class="p-6 rounded-2xl border shadow-sm flex flex-col transition-colors duration-200" 
                             :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <div class="mb-2">
                                <h3 class="text-sm font-bold">Tren Status Tindak Lanjut berdasarkan Tahun/Bulan</h3>
                                <p class="text-[11px]" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Periode yang tersedia pada data aktif.</p>
                            </div>
                            <div id="chart-area" class="flex-1 w-full min-h-[250px]"></div>
                        </div>

                        <!-- Grafik 3: Ringkasan per Provinsi (Kiri Bawah) -->
                        <div class="p-6 rounded-2xl border shadow-sm flex flex-col transition-colors duration-200" 
                             :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                            <div class="mb-2">
                                <h3 class="text-sm font-bold">Ringkasan per Provinsi</h3>
                                <p class="text-[11px]" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Agregasi mengikuti Jumlah Ijazah yang Ditahan.</p>
                            </div>
                            <div id="chart-bar" class="flex-1 w-full min-h-[250px]"></div>
                        </div>

                    </div>
                </div>

                <!-- PETA PROVINSI & RINGKASAN WILAYAH -->
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-base font-bold" :class="initTheme() === 'dark' ? 'text-slate-100' : 'text-slate-800'">Peta Provinsi</h3>
                            <p class="text-xs" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Ringkasan mengikuti kolom Provinsi dan filter aktif.</p>
                        </div>
                        <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs px-3 py-1 rounded-full font-semibold">Kolom wilayah tersedia</span>
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
                                <p class="text-[11px] mb-4 text-slate-400">Legenda mengikuti kolom Provinsi atau Wilayah pada data aktif.</p>
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between items-center border-b border-dashed pb-2" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'"><span class="text-slate-400 font-medium">Kalimantan Timur</span><span class="font-bold">16</span></div>
                                    <div class="flex justify-between items-center border-b border-dashed pb-2" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'"><span class="text-slate-400 font-medium">Jawa Tengah</span><span class="font-bold">14</span></div>
                                    <div class="flex justify-between items-center border-b border-dashed pb-2" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'"><span class="text-slate-400 font-medium">DKI Jakarta</span><span class="font-bold">12</span></div>
                                    <div class="flex justify-between items-center border-b border-dashed pb-2" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'"><span class="text-slate-400 font-medium">Sulawesi Selatan</span><span class="font-bold">11</span></div>
                                    <div class="flex justify-between items-center pb-1"><span class="text-slate-400 font-medium">Jawa Barat</span><span class="font-bold">9</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DATA FILE AKTIF (TABEL UTAMA) -->
                <div class="rounded-2xl border shadow-sm overflow-hidden pb-6 transition-colors duration-200"
                     :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
                    <div class="p-6 border-b" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'">
                        <h3 class="text-base font-bold">Data File Aktif</h3>
                        <p class="text-xs mt-0.5 text-slate-400">Tabel berikut diberi penanda Data contoh dan dapat digantikan oleh unggahan aktual.</p>
                    </div>
                    
                    <div class="p-6 pb-2 text-xs text-slate-400 flex justify-between items-center">
                        <span>6 dari 6 baris ditampilkan</span>
                        <span class="italic">Klik judul kolom untuk mengurutkan.</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr class="bg-[#162133] text-white text-xs uppercase tracking-wider">
                                    <th class="py-3 px-4 font-semibold">No</th>
                                    <th class="py-3 px-4 font-semibold">Tahun</th>
                                    <th class="py-3 px-4 font-semibold">Bulan</th>
                                    <th class="py-3 px-4 font-semibold">Jumlah Pengaduan</th>
                                    <th class="py-3 px-4 font-semibold">Pengaduan Ditindaklanjuti</th>
                                    <th class="py-3 px-4 font-semibold">Nama Perusahaan</th>
                                    <th class="py-3 px-4 font-semibold">Provinsi</th>
                                    <th class="py-3 px-4 font-semibold">Ijazah Ditahan</th>
                                    <th class="py-3 px-4 font-semibold">Ijazah Dikembalikan</th>
                                    <th class="py-3 px-4 font-semibold">Status</th>
                                    <th class="py-3 px-4 font-semibold">Catatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y text-sm" :class="initTheme() === 'dark' ? 'divide-slate-700 text-slate-200' : 'divide-slate-100 text-slate-700'">
                                <tr class="transition"><td class="py-3 px-4">1</td><td class="py-3 px-4">2025</td><td class="py-3 px-4">Januari</td><td class="py-3 px-4">12</td><td class="py-3 px-4">10</td><td class="py-3 px-4 font-medium">PT Nusantara Karya</td><td class="py-3 px-4">DKI Jakarta</td><td class="py-3 px-4">8</td><td class="py-3 px-4">7</td><td class="py-3 px-4"><span class="bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-md text-xs font-semibold">Selesai</span></td><td class="py-3 px-4 text-slate-400 text-xs">Pengaduan ditindaklanjuti dan ijazah telah dikembalikan.</td></tr>
                                <tr class="transition"><td class="py-3 px-4">2</td><td class="py-3 px-4">2025</td><td class="py-3 px-4">Februari</td><td class="py-3 px-4">9</td><td class="py-3 px-4">7</td><td class="py-3 px-4 font-medium">PT Cipta Mandiri</td><td class="py-3 px-4">Jawa Barat</td><td class="py-3 px-4">6</td><td class="py-3 px-4">4</td><td class="py-3 px-4"><span class="bg-amber-50 text-amber-700 px-2.5 py-1 rounded-md text-xs font-semibold">Proses</span></td><td class="py-3 px-4 text-slate-400 text-xs">Menunggu verifikasi perusahaan.</td></tr>
                                <tr class="transition"><td class="py-3 px-4">3</td><td class="py-3 px-4">2025</td><td class="py-3 px-4">Maret</td><td class="py-3 px-4">14</td><td class="py-3 px-4">13</td><td class="py-3 px-4 font-medium">PT Sejahtera Abadi</td><td class="py-3 px-4">Jawa Tengah</td><td class="py-3 px-4">11</td><td class="py-3 px-4">10</td><td class="py-3 px-4"><span class="bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-md text-xs font-semibold">Selesai</span></td><td class="py-3 px-4 text-slate-400 text-xs">Pengembalian dilakukan secara bertahap.</td></tr>
                                <tr class="transition"><td class="py-3 px-4">4</td><td class="py-3 px-4">2025</td><td class="py-3 px-4">April</td><td class="py-3 px-4">8</td><td class="py-3 px-4">6</td><td class="py-3 px-4 font-medium">PT Surya Logistik</td><td class="py-3 px-4">Jawa Timur</td><td class="py-3 px-4">5</td><td class="py-3 px-4">3</td><td class="py-3 px-4"><span class="bg-amber-50 text-amber-700 px-2.5 py-1 rounded-md text-xs font-semibold">Proses</span></td><td class="py-3 px-4 text-slate-400 text-xs">Mediasi masih berjalan.</td></tr>
                                <tr class="transition"><td class="py-3 px-4">5</td><td class="py-3 px-4">2026</td><td class="py-3 px-4">Januari</td><td class="py-3 px-4">16</td><td class="py-3 px-4">14</td><td class="py-3 px-4 font-medium">PT Bumi Kencana</td><td class="py-3 px-4">Kalimantan Timur</td><td class="py-3 px-4">12</td><td class="py-3 px-4">11</td><td class="py-3 px-4"><span class="bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-md text-xs font-semibold">Selesai</span></td><td class="py-3 px-4 text-slate-400 text-xs">Sebagian besar ijazah telah dikembalikan.</td></tr>
                                <tr class="transition"><td class="py-3 px-4">6</td><td class="py-3 px-4">2026</td><td class="py-3 px-4">Februari</td><td class="py-3 px-4">11</td><td class="py-3 px-4">9</td><td class="py-3 px-4 font-medium">PT Bahari Sentosa</td><td class="py-3 px-4">Sulawesi Selatan</td><td class="py-3 px-4">7</td><td class="py-3 px-4">5</td><td class="py-3 px-4"><span class="bg-amber-50 text-amber-700 px-2.5 py-1 rounded-md text-xs font-semibold">Proses</span></td><td class="py-3 px-4 text-slate-400 text-xs">Penjadwalan klarifikasi lanjutan.</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-6 border-t flex justify-end items-center space-x-2" :class="initTheme() === 'dark' ? 'border-slate-700' : 'border-slate-100'">
                        <button class="px-4 py-2 border rounded-xl text-xs font-medium transition" :class="initTheme() === 'dark' ? 'border-slate-600 text-slate-300 hover:bg-slate-800' : 'border-slate-200 text-slate-600 hover:bg-slate-50'">Sebelumnya</button>
                        <span class="px-3 py-2 text-xs text-slate-400">Halaman 1 dari 1</span>
                        <button class="px-4 py-2 border rounded-xl text-xs font-medium transition" :class="initTheme() === 'dark' ? 'border-slate-600 text-slate-300 hover:bg-slate-800' : 'border-slate-200 text-slate-600 hover:bg-slate-50'">Berikutnya</button>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- ======================================================= -->
    <!-- MODAL / POPUP PROFIL PENGGUNA (DI TENGAH LAYAR & PRESISI) -->
    <!-- ======================================================= -->
    <div x-show="showProfileCard" x-transition.opacity class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4" style="display: none;">
        <div @click.away="showProfileCard = false" class="w-full max-w-xl bg-[#101927] text-slate-100 rounded-3xl p-8 shadow-2xl border border-slate-700 relative">
            
            <!-- Tombol Silang (Close) -->
            <button @click="showProfileCard = false" class="absolute top-6 right-6 text-slate-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 text-center md:text-left">
                <!-- Foto Avatar Melingkar dengan border teal -->
                <div class="w-28 h-28 rounded-full p-1 border-2 border-teal-400 shrink-0 overflow-hidden shadow-inner">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80" alt="Profil" class="w-full h-full object-cover rounded-full">
                </div>
                <!-- Informasi Detail Profil -->
                <div class="flex-1 space-y-2">
                    <span class="text-xs font-semibold text-teal-400 tracking-wider uppercase">PROFIL PENGGUNA</span>
                    <h3 class="text-3xl font-serif font-bold tracking-tight">Profil</h3>
                    <p class="text-sm text-slate-300 leading-relaxed pt-1">
                        Analis Capaian · Kementerian Ketenagakerjaan · pengguna@kemnaker.go.id
                    </p>
                    <!-- Tombol Kelola Pengaturan -->
                    <div class="pt-4">
                        <button @click="currentMenu = 'settings'; showProfileCard = false;" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-5 py-2.5 rounded-xl text-xs transition inline-flex items-center shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Kelola Pengaturan
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ======================================================= -->
    <!-- MODAL / POPUP KONFIRMASI LOGOUT -->
    <!-- ======================================================= -->
    <div x-show="showLogoutModal" x-transition.opacity class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4" style="display: none;">
        <div @click.away="showLogoutModal = false" class="w-full max-w-sm rounded-3xl p-6 shadow-xl border transition-colors duration-200"
             :class="initTheme() === 'dark' ? 'bg-[#1e293b] border-slate-700 text-slate-100' : 'bg-white border-slate-200 text-slate-800'">
            
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </div>
                <h3 class="text-lg font-bold">Konfirmasi Keluar</h3>
                <p class="text-xs mt-1" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Apakah Anda yakin ingin keluar?</p>
            </div>

            <div class="flex items-center space-x-3">
                <!-- Tombol Batal -->
                <button @click="showLogoutModal = false" class="flex-1 py-2.5 px-4 rounded-xl text-xs font-semibold border transition"
                        :class="initTheme() === 'dark' ? 'border-slate-600 bg-[#162133] text-slate-300 hover:bg-slate-800' : 'border-slate-200 bg-slate-50 text-slate-700 hover:bg-slate-100'">
                    Batal
                </button>
                <!-- Tombol Ya, Keluar (Mengarah ke Landing Page) -->
                <a href="{{ route('landing') }}" class="flex-1 py-2.5 px-4 rounded-xl text-xs font-semibold bg-blue-600 hover:bg-blue-700 text-white text-center transition shadow-sm">
                    Ya, Keluar
                </a>
            </div>

        </div>
    </div>
<!-- Script Render ApexCharts -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // Agar teks grafik otomatis menyesuaikan jika background terang/gelap
        const isDarkMode = document.documentElement.classList.contains('dark') || localStorage.getItem('_x_theme') === '"dark"';
        const textColor = isDarkMode ? '#cbd5e1' : '#475569';

        // 1. CHART DONUT: Ijazah Ditahan vs Dikembalikan
        const donutOptions = {
            series: [43, 30],
            labels: ['Jumlah Ijazah yang Ditahan', 'Jumlah Pengembalian Ijazah'],
            chart: { type: 'donut', height: 280, background: 'transparent' },
            colors: ['#4fd1c5', '#60a5fa'], // Warna Tosca & Biru
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

        // 2. CHART AREA/LINE: Tren Status Tindak Lanjut
        const areaOptions = {
            series: [{ name: 'Data', data: [0, 0] }], // Dummy data sesuai gambar yang terlihat datar/kosong
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

        // 3. CHART BAR: Ringkasan per Provinsi
        const barOptions = {
            series: [{ name: 'Jumlah', data: [65, 55, 35, 28, 20] }], // Dummy data menyerupai proporsi tinggi bar
            chart: { type: 'bar', height: 250, background: 'transparent', toolbar: { show: false } },
            colors: ['#4fd1c5'],
            plotOptions: {
                bar: { columnWidth: '30%', borderRadius: 4, dataLabels: { position: 'top' } }
            },
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