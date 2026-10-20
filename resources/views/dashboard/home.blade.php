<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Kinerja - Kinerja Riksa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js beserta plugin Persist untuk menyimpan Tema -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="flex flex-col h-screen overflow-hidden transition-colors duration-200" 
      x-data="{ 
          theme: $persist('light'), 
          initTheme() {
              if (this.theme === 'system') {
                  return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
              }
              return this.theme;
          }
      }"
      :class="initTheme() === 'dark' ? 'bg-[#101927]' : 'bg-[#f8f9fa]'">

<!-- AREA KONTEN: RINGKASAN KINERJA (Tengah Layar & Tanpa Header) -->
    <main class="flex-1 overflow-y-auto py-10 px-6 md:py-16 md:px-10 w-full relative block">
        
        <div class="w-full max-w-7xl mx-auto rounded-3xl p-8 md:p-12 shadow-sm relative transition-colors duration-200 mb-10"
             :class="initTheme() === 'dark' ? 'bg-[#1e293b] border border-slate-700' : 'bg-white'">

            <div class="mb-10 mt-2">
                <span class="text-xs font-bold text-blue-500 tracking-widest uppercase">KINERJA RIKSA</span>
                <h2 class="text-4xl font-normal mt-3 transition-colors" :class="initTheme() === 'dark' ? 'text-slate-100' : 'text-slate-800'">Ringkasan Kinerja</h2>
                <p class="text-sm mt-3 transition-colors" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Periode pelaporan: pilih periode yang tersedia di sistem</p>
            </div>

            <!-- Judul Pilihan -->
            <div class="mb-5 mt-10">
                <h3 class="text-lg font-medium transition-colors" :class="initTheme() === 'dark' ? 'text-slate-200' : 'text-slate-800'">Pilih Jenis Capaian</h3>
                <p class="text-xs mt-1 transition-colors" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">Klik kartu untuk melihat contoh ringkasan halaman detail.</p>
            </div>

            <!-- Grid 8 Jenis Capaian (Sudah Dirapikan & Disatukan) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                
                @php
                    $capaian = [
                        ['icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'title' => 'Kasus Penanganan Ijazah', 'route' => 'dashboard.kasus-ijazah'],
                        ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Kompensasi', 'route' => 'dashboard.kompensasi'],
                        ['icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9', 'title' => 'Waspadu', 'route' => '#'],
                        ['icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15', 'title' => 'Penetapan Ulang', 'route' => '#'],
                        ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Data Putusan Sidik', 'route' => '#'],
                        ['icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title' => 'Pengawasan TKA', 'route' => '#'],
                        ['icon' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3', 'title' => 'Norma K3', 'route' => '#'],
                        ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Pemeriksaan Norma Kerja dan Perempuan', 'route' => '#']
                    ];
                @endphp

                @foreach ($capaian as $item)
                <a href="{{ $item['route'] !== '#' ? route($item['route']) : '#' }}" 
                   class="block border rounded-xl p-5 transition duration-200 group"
                   :class="initTheme() === 'dark' ? 'bg-[#162133] border-slate-700 hover:bg-slate-700' : 'bg-[#eef5fc] border-[#d6e6f5] hover:bg-[#e0effa]'">
                    <svg class="w-5 h-5 text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path></svg>
                    <h4 class="text-sm font-semibold mb-3 transition-colors" :class="initTheme() === 'dark' ? 'text-slate-200' : 'text-slate-800'">{{ $item['title'] }}</h4>
                    <span class="text-xs group-hover:text-blue-500 flex items-center transition-colors" :class="initTheme() === 'dark' ? 'text-slate-400' : 'text-slate-500'">
                        Lihat detail 
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                </a>
                @endforeach

            </div>
        </div>
    </main>
</body>
</html>