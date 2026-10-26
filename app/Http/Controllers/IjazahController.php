<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IjazahController extends Controller
{
    public function simpanData(Request $request)
    {
        // 1. Tangkap data Excel rahasia yang dikirim dari Frontend
        $dataExcel = json_decode($request->input('data_excel'), true);

        // Jika kosong, kembalikan ke halaman sebelumnya
        if (!$dataExcel) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        // 2. Lakukan looping (baca baris per baris)
        foreach ($dataExcel as $index => $row) {
            // Lewati baris pertama (index 0) karena itu adalah header/judul kolom
            if ($index == 0) continue; 
            
            // Lewati jika kolom Nama Perusahaan kosong (mencegah error baris kosong di excel)
            if (empty($row[1])) continue; 

            // Format tanggal: Jika dari excel bentuknya "26/11/2025", ubah ke format MySQL "2025-11-26"
            $tanggal = $row[4] ?? null;
            $tanggalMySQL = null; // Kita siapkan variabel khusus yang defaultnya 'kosong' (null)

            if ($tanggal && str_contains($tanggal, '/')) {
                $parts = explode('/', $tanggal);
                if (count($parts) == 3 && strlen($parts[2]) == 4) {
                    $tanggalMySQL = $parts[2] . '-' . $parts[1] . '-' . $parts[0]; // YYYY-MM-DD
                }
            }

            // Gabungkan status dan tindak lanjut karena di DB hanya ada 1 kolom
            $status = $row[5] ?? '';
            $tindakLanjut = $row[6] ?? '';
            $statusGabungan = $status . ' - ' . $tindakLanjut;

            // POTONG TEKS agar tidak error "Data too long" (Maksimal 250 karakter)
            $statusGabunganLimit = substr($statusGabungan, 0, 250);

            // 3. Masukkan ke dalam tabel MySQL SESUAI NAMA KOLOM ASLI
            DB::table('penanganan_ijazah')->insert([
                'perusahaan'                 => $row[1] ?? '-',
                'tanggal'                    => $tanggalMySQL, // Aman untuk tanggal kosong
                'status_tindak_lanjut'       => $statusGabunganLimit,
                'provinsi'                   => $row[7] ?? '-',
                'jumlah_ijazah_ditahan'      => (int) ($row[8] ?? 0),
                'jumlah_pengembalian_ijazah' => 0, 
                'created_at'                 => Carbon::now(),
                'updated_at'                 => Carbon::now(),
            ]);
        }

        // 4. Sukses! Kembalikan ke halaman dashboard
        return back()->with('success', 'Data Ijazah berhasil disimpan ke Database!');
    }
}