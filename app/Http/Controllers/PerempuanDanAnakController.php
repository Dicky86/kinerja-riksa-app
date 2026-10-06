<?php

namespace App\Http\Controllers;

use App\Models\PerempuanDanAnak;
use Illuminate\Http\Request;

class PerempuanDanAnakController extends Controller
{
    public function index(Request $request)
    {
        $query = PerempuanDanAnak::query();

        // 1. Hitung Data KPI
        $kpi = [
            'jumlah_kasus' => (clone $query)->sum('jumlah_kasus'),
            'target_penanganan' => (clone $query)->sum('target_penanganan'),
            'realisasi' => (clone $query)->sum('realisasi'),
            'kewajiban' => (clone $query)->sum('kewajiban_rp'),
            'sudah_dipenuhi' => (clone $query)->sum('sudah_dipenuhi_rp'),
        ];
        $kpi['sisa_tindak_lanjut'] = $kpi['target_penanganan'] - $kpi['realisasi'];
        $kpi['sisa_kewajiban'] = $kpi['kewajiban'] - $kpi['sudah_dipenuhi'];

        // 2. Data Tabel
        $tableData = (clone $query)->orderBy('periode', 'asc')->paginate(10);

        // 3. Data untuk 3 Grafik (Chart.js)
        $chartRaw = (clone $query)->orderBy('periode', 'asc')->get();
        
        $chartData = [
            'labels' => $chartRaw->map(fn($item) => \Carbon\Carbon::parse($item->periode)->translatedFormat('M')),
            'target' => $chartRaw->pluck('target_penanganan'),
            'realisasi' => $chartRaw->pluck('realisasi'),
            'kasus' => $chartRaw->pluck('jumlah_kasus'),
            'kewajiban' => $chartRaw->map(fn($item) => $item->kewajiban_rp / 1000000),
            'terpenuhi' => $chartRaw->map(fn($item) => $item->sudah_dipenuhi_rp / 1000000),
        ];

        return view('dashboard.perempuan-dan-anak', compact('kpi', 'tableData', 'chartData'));
    }
}