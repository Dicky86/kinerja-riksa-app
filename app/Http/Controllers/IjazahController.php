<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IjazahController extends Controller
{
    // Menampilkan Dashboard Kasus Ijazah dengan Data Riil dari Database
    public function index()
    {
        // 1. Ambil data aktif 
        $dataIjazah = DB::table('penanganan_ijazah')
                        ->where('perusahaan', '!=', '')
                        ->whereNotNull('perusahaan')
                        ->orderBy('id', 'asc')
                        ->get();

        // 2. Kalkulasi Ringkasan Data (Summary)
        $totalPengaduan = $dataIjazah->count();
        $totalDitahan = $dataIjazah->sum('jumlah_ijazah_ditahan');
        $totalDikembalikan = $dataIjazah->sum('jumlah_pengembalian_ijazah');
        $perProvinsi = $dataIjazah->groupBy('provinsi')->map->count();

        // 3. Kalkulasi 3 Diagram Grafik
        // Grafik A: Status Selesai vs Proses
        $statusSelesai = $dataIjazah->filter(fn($item) => stripos($item->status_tindak_lanjut, 'selesai') !== false)->count();
        $statusProses = $totalPengaduan - $statusSelesai;
        $persenSelesai = $totalPengaduan > 0 ? round(($statusSelesai / $totalPengaduan) * 100, 1) : 0;
        $persenProses = $totalPengaduan > 0 ? round(($statusProses / $totalPengaduan) * 100, 1) : 0;

        // Grafik B: Top 4 Perusahaan dengan Kasus Terbanyak
        $topPerusahaan = $dataIjazah->groupBy('perusahaan')->map->count()->sortByDesc(fn($c) => $c)->take(4);
        $maxPerusahaan = $topPerusahaan->max() ?: 1; // Mencegah error bagi nol

        // Grafik C: Top 5 Provinsi Terbanyak
        $topProvinsi = $perProvinsi->sortByDesc(fn($c) => $c)->take(5);
        $maxProvinsi = $topProvinsi->max() ?: 1;

        // 4. Kirim semua variabel ke Front-End
        return view('dashboard.capaian.kasus-ijazah', compact(
            'dataIjazah', 'totalPengaduan', 'totalDitahan', 'totalDikembalikan', 
            'perProvinsi', 'statusSelesai', 'statusProses', 'persenSelesai', 'persenProses',
            'topPerusahaan', 'maxPerusahaan', 'topProvinsi', 'maxProvinsi'
        ));
    }

    // Proses Simpan Data dari Impor Excel
    public function simpanData(Request $request)
    {
        $dataExcel = json_decode($request->input('data_excel'), true);

        if (!$dataExcel) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        foreach ($dataExcel as $index => $row) {
            // Lewati baris pertama (Header)
            if ($index == 0) continue; 
            
            // FILTER KETAT: Ambil nama perusahaan, bersihkan spasi kiri-kanan
            $perusahaan = isset($row[1]) ? trim($row[1]) : '';

            // JIKA NAMA PERUSAHAAN KOSONG ATAU CUMA STRIP (-), TOLAK DAN LEWATI!
            if ($perusahaan === '' || $perusahaan === '-') {
                continue; 
            }

            // Format Tanggal
            $tanggal = $row[4] ?? null;
            $tanggalMySQL = null; 
            if ($tanggal && str_contains($tanggal, '/')) {
                $parts = explode('/', $tanggal);
                if (count($parts) == 3 && strlen($parts[2]) == 4) {
                    $tanggalMySQL = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
                }
            }

            // Format Status Gabungan
            $status = $row[5] ?? '';
            $tindakLanjut = $row[6] ?? '';
            $statusGabungan = substr(trim($status . ' - ' . $tindakLanjut), 0, 250);

            // Jika statusnya cuma " - ", kosongkan saja
            if ($statusGabungan === '-') {
                $statusGabungan = '';
            }

            // Simpan ke Database (Hanya baris yang lolos filter)
            DB::table('penanganan_ijazah')->insert([
                'perusahaan'                 => $perusahaan,
                'tanggal'                    => $tanggalMySQL,
                'status_tindak_lanjut'       => $statusGabungan,
                'provinsi'                   => isset($row[7]) ? trim($row[7]) : '-',
                'jumlah_ijazah_ditahan'      => (int) ($row[8] ?? 0),
                'jumlah_pengembalian_ijazah' => (int) ($row[9] ?? 0), 
                'created_at'                 => Carbon::now(),
                'updated_at'                 => Carbon::now(),
            ]);
        }

        return redirect()->route('dashboard.kasus-ijazah')->with('success', 'Data Ijazah riil berhasil disimpan dan baris kosong diabaikan!');
    }
}