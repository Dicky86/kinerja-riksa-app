<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Capaian - Kinerja Riksa</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-[#1a2c42] text-slate-200 font-sans antialiased flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#132235] flex flex-col justify-between border-r border-slate-700">
        <div>
            <div class="p-6 flex items-center space-x-3">
                <div class="w-8 h-8 bg-emerald-500 rounded flex items-center justify-center text-white font-bold">~</div>
                <span class="text-xl font-bold tracking-wider text-white">KINERJA RIKSA</span>
            </div>
            <div class="px-6 py-2 text-xs text-slate-500 font-semibold">MENU UTAMA</div>
            <nav class="mt-2 space-y-1 px-4">
                <a href="#" class="flex items-center px-4 py-3 bg-[#1a2c42] text-white rounded-lg border-l-4 border-emerald-500">
                    <span class="mr-3">📊</span> Dashboard Capaian
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-slate-400 hover:text-white hover:bg-[#1a2c42] rounded-lg">
                    <span class="mr-3">📄</span> Impor Data
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-slate-400 hover:text-white hover:bg-[#1a2c42] rounded-lg">
                    <span class="mr-3">⚙️</span> Pengaturan
                </a>
            </nav>
        </div>
        
        <!-- User Info Sidebar -->
        <div class="p-6 flex items-center space-x-3 border-t border-slate-700">
            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">AD</div>
            <div>
                <div class="text-sm font-semibold text-white">Admin Dashboard</div>
                <div class="text-xs text-slate-400">Dit. Bina Riksa</div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        
        <!-- HEADER -->
        <header class="flex justify-between items-center p-6 border-b border-slate-700 bg-[#132235]">
            <div>
                <h1 class="text-xl font-bold text-white">Dashboard Capaian</h1>
                <p class="text-sm text-slate-400">Tahun Anggaran 2026</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <div class="text-sm font-semibold text-white">Admin Dashboard</div>
                    <div class="text-xs text-slate-400">Analis Data - Dit. Bina Riksa</div>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold cursor-pointer">AD</div>
            </div>
        </header>

        <div class="p-8 space-y-6">
            <!-- TITLE & BUTTON -->
            <div class="flex justify-between items-end">
                <div>
                    <h2 class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Kementerian Ketenagakerjaan</h2>
                    <h3 class="text-2xl font-bold text-white tracking-wide">DIREKTORAT BINA RIKSA</h3>
                    <p class="text-sm text-slate-400">Ringkasan capaian substansi dan realisasi data ketenagakerjaan.</p>
                </div>
                <button class="bg-blue-500 hover:bg-blue-600 text-white p-3 rounded-lg flex items-center justify-center">
                    ⬇️
                </button>
            </div>

            <!-- FILTER CARD -->
            <div class="bg-white rounded-xl p-4 flex items-end space-x-4 text-slate-800">
                <div class="flex-1">
                    <label class="block text-xs font-semibold text-slate-500 mb-1">Substansi aktif</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 text-sm focus:outline-none focus:border-blue-500">
                        <option>Perempuan dan Anak</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-xs font-semibold text-slate-500 mb-1">Periode</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 text-sm focus:outline-none focus:border-blue-500">
                        <option>Semua periode</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-xs font-semibold text-slate-500 mb-1">Unit kerja</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 text-sm focus:outline-none focus:border-blue-500">
                        <option>Semua unit kerja</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-xs font-semibold text-slate-500 mb-1">Status</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 text-sm focus:outline-none focus:border-blue-500">
                        <option>Semua status</option>
                    </select>
                </div>
                <div>
                    <span class="inline-block bg-orange-100 text-orange-600 text-xs font-bold px-3 py-2 rounded-full border border-orange-200">Data contoh</span>
                </div>
            </div>

            <!-- INFO ALERT -->
            <div class="bg-white rounded-lg p-3 text-sm text-slate-600 border border-slate-200">
                Setiap substansi memiliki kriteria data berbeda. KPI dan grafik mengikuti substansi aktif serta data contoh atau data hasil impor yang tersedia.
            </div>

            <!-- 4 KPI CARDS (Rata Tengah & Simetris) -->
            <div class="grid grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-5 text-slate-800 shadow-sm border border-slate-100">
                    <div class="text-xs text-slate-500 mb-1 font-semibold">Jumlah kasus</div>
                    <div class="text-2xl font-bold mb-2">{{ $kpi['jumlah_kasus'] ?? 0 }}</div>
                    <div class="text-xs text-slate-400">Kasus pada data aktif</div>
                </div>
                <div class="bg-white rounded-xl p-5 text-slate-800 shadow-sm border border-slate-100">
                    <div class="text-xs text-slate-500 mb-1 font-semibold">Target penanganan</div>
                    <div class="text-2xl font-bold mb-2">{{ $kpi['target_penanganan'] ?? 0 }}</div>
                    <div class="text-xs text-slate-400">Target yang tercatat</div>
                </div>
                <div class="bg-white rounded-xl p-5 text-slate-800 shadow-sm border border-slate-100">
                    <div class="text-xs text-slate-500 mb-1 font-semibold">Realisasi</div>
                    <div class="text-2xl font-bold mb-2">{{ $kpi['realisasi'] ?? 0 }}</div>
                    <div class="text-xs text-slate-400">Capaian</div>
                </div>
                <div class="bg-white rounded-xl p-5 text-slate-800 shadow-sm border border-slate-100">
                    <div class="text-xs text-slate-500 mb-1 font-semibold">Sisa tindak lanjut</div>
                    <div class="text-2xl font-bold mb-2">{{ $kpi['sisa_tindak_lanjut'] ?? 0 }}</div>
                    <div class="text-xs text-slate-400">Target belum selesai</div>
                </div>
            </div>

            <!-- CHARTS SECTION -->
            <p class="text-xs text-slate-400 mt-6 mb-2">Perempuan dan Anak: grafik dan KPI mengikuti kriteria data substansi aktif.</p>
            <div class="grid grid-cols-3 gap-6">
                <!-- Chart 1: Target vs Realisasi -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Target penanganan vs realisasi</h4>
                        <p class="text-xs text-slate-500 mb-4">Perbandingan per periode</p>
                    </div>
                    <div class="h-44">
                        <canvas id="chartTargetVsRealisasi"></canvas>
                    </div>
                </div>

                <!-- Chart 2: Tren Pengaduan -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Tren pengaduan per periode</h4>
                        <p class="text-xs text-slate-500 mb-4">Jumlah kasus per periode</p>
                    </div>
                    <div class="h-44">
                        <canvas id="chartTrenPengaduan"></canvas>
                    </div>
                </div>

                <!-- Chart 3: Pemenuhan Perlindungan -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Pemenuhan perlindungan: kewajiban vs pemenuhan</h4>
                        <p class="text-xs text-slate-500 mb-4">Perbandingan per periode (Juta Rp)</p>
                    </div>
                    <div class="h-44">
                        <canvas id="chartPemenuhan"></canvas>
                    </div>
                </div>
            </div>

            <!-- SARAN TINDAK LANJUT -->
            <div class="bg-white rounded-xl p-6 flex justify-between items-center shadow-sm border border-slate-100 mt-6 text-slate-800">
                <div>
                    <h4 class="text-lg font-bold">Saran tindak lanjut</h4>
                    <p class="text-sm text-slate-500">Prioritaskan penyelesaian target serta sisa kewajiban yang masih terbuka.</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold">Rp {{ number_format(($kpi['sisa_kewajiban'] ?? 0) / 1000000, 0, ',', '.') }} jt</div>
                    <p class="text-xs text-slate-500">Sisa kewajiban</p>
                </div>
            </div>

            <!-- TABLE SECTION -->
            <p class="text-xs text-slate-400 mt-6 mb-2">Menampilkan data sesuai substansi dan filter yang dipilih.</p>
            <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-slate-100 mb-8">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4">Periode</th>
                            <th class="px-6 py-4">Unit Kerja</th>
                            <th class="px-6 py-4">Jenis Data</th>
                            <th class="px-6 py-4 text-center">Kasus</th>
                            <th class="px-6 py-4 text-center">Target</th>
                            <th class="px-6 py-4 text-center">Realisasi</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($tableData ?? [] as $row)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($row->periode)->translatedFormat('M Y') }}</td>
                            <td class="px-6 py-4">{{ $row->unit_kerja }}</td>
                            <td class="px-6 py-4">{{ $row->jenis_data }}</td>
                            <td class="px-6 py-4 text-center">{{ $row->jumlah_kasus }}</td>
                            <td class="px-6 py-4 text-center">{{ $row->target_penanganan }}</td>
                            <td class="px-6 py-4 text-center">{{ $row->realisasi }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($row->status == 'Valid')
                                    <span class="bg-emerald-100 text-emerald-600 px-2 py-1 rounded text-xs font-bold">Valid</span>
                                @else
                                    <span class="bg-amber-100 text-amber-600 px-2 py-1 rounded text-xs font-bold">{{ $row->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="#" class="text-blue-500 hover:underline font-semibold">Lihat detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-slate-400">Belum ada data. Silakan tambah atau impor data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Pagination Links -->
                @if(isset($tableData) && $tableData->hasPages())
                <div class="p-4 border-t border-slate-100 bg-white">
                    {{ $tableData->links() }}
                </div>
                @endif
            </div>

        </div>
    </main>

    <!-- SCRIPT CHART.JS INTI -->
    <script>
        const labels = {!! json_encode($chartData['labels'] ?? []) !!};

        // Chart 1: Target vs Realisasi (Bar Chart)
        new Chart(document.getElementById('chartTargetVsRealisasi'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    { label: 'Target', data: {!! json_encode($chartData['target'] ?? []) !!}, backgroundColor: '#3b82f6' },
                    { label: 'Realisasi', data: {!! json_encode($chartData['realisasi'] ?? []) !!}, backgroundColor: '#10b981' }
                ]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // Chart 2: Tren Pengaduan (Line Chart)
        new Chart(document.getElementById('chartTrenPengaduan'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Kasus',
                    data: {!! json_encode($chartData['kasus'] ?? []) !!},
                    borderColor: '#10b981',
                    backgroundColor: '#10b981',
                    tension: 0.3
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // Chart 3: Kewajiban vs Pemenuhan (Bar Chart)
        new Chart(document.getElementById('chartPemenuhan'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    { label: 'Kewajiban', data: {!! json_encode($chartData['kewajiban'] ?? []) !!}, backgroundColor: '#3b82f6' },
                    { label: 'Terpenuhi', data: {!! json_encode($chartData['terpenuhi'] ?? []) !!}, backgroundColor: '#10b981' }
                ]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    </script>
</body>
</html>