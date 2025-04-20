<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use App\Models\Kunjungan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ImunisasiController extends Controller
{
    public function indexImunisasi($id)
    {
        $kunjungan = Kunjungan::with(['orang_tua', 'orang_tua.anak', 'kunjungan_anaks'])->findOrFail($id);
        if ($kunjungan->kunjungan_anaks->isEmpty()) {
            return redirect()->route('kunjungan.index')->with('status', 'Belum ada data Kunjungan anak.');
        }

        return view('imunisasi.index', compact('kunjungan'));
    }

    public function list(Request $request, $id)
    {
        if (!$request->ajax()) {
            return response()->json(['message' => 'Method not allowed'], 405);
        }
        $imunisasi = DB::table('imunisasis')
            ->join('kunjungan_anaks', 'kunjungan_anaks.id', '=', 'imunisasis.kunjungan_anak_id')
            ->join('kategori_imunisasis', 'kategori_imunisasis.id', '=', 'imunisasis.kategori_imunisasi_id')
            ->join('anaks', 'anaks.id', '=', 'kunjungan_anaks.anak_id')
            ->select(
                'imunisasis.tanggal_imunisasi',
                'imunisasis.tanggal_imunisasi_lanjutan',
                'anaks.nama_anak',
                'kategori_imunisasis.nama_kategori_imunisasi'
            )
            ->where('kunjungan_anaks.kunjungan_id', $id)
            ->get();
        if ($imunisasi->isEmpty()) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'data' => [],
            ], 200);
        }
        return DataTables::of($imunisasi)
            ->addIndexColumn()
            ->make(true);
    }
}
