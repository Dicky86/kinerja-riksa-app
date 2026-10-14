<?php

namespace App\Http\Controllers;

use App\Models\PerempuanDanAnak;
use Illuminate\Http\Request;

class PerempuanDanAnakController extends Controller
{
    public function index(Request $request)
    {
        $query = PerempuanDanAnak::query();

        // 1. Hitung Data KPI (Hanya 4 Metrik Utama)
        $kpi = [
            'jumlah_kasus' => (clone $query)->sum('jumlah_kasus'),
            'target_penanganan' => (clone $query)->sum('target_penanganan'),
            'realisasi' => (clone $query)->sum('realisasi'),
        ];
        $kpi['sisa_tindak_lanjut'] = $kpi['target_penanganan'] - $kpi['realisasi'];

        // 2. Data Tabel
        $tableData = (clone $query)->orderBy('periode', 'asc')->paginate(10);

        // 3. Data untuk Grafik (Chart.js)
        $chartRaw = (clone $query)->orderBy('periode', 'asc')->get();
        
        $chartData = [
            'labels' => $chartRaw->map(fn($item) => \Carbon\Carbon::parse($item->periode)->translatedFormat('M')),
            'target' => $chartRaw->pluck('target_penanganan'),
            'realisasi' => $chartRaw->pluck('realisasi'),
            'kasus' => $chartRaw->pluck('jumlah_kasus'),
        ];

        return view('dashboard.perempuan-dan-anak', compact('kpi', 'tableData', 'chartData'));
    }
}