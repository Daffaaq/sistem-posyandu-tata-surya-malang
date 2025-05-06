<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use App\Models\ImunisasiObat;
use App\Models\KategoriImunasasi;
use App\Models\Kunjungan;
use App\Models\KunjunganAnak;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImunisasiController extends Controller
{
    public function indexImunisasi($id)
    {
        $kunjungan = Kunjungan::with(['orang_tua', 'orang_tua.anak', 'kunjungan_anaks'])->findOrFail($id);
        if ($kunjungan->kunjungan_anaks->isEmpty()) {
            return redirect()->route('kunjungan.index')->with('status', 'Belum ada data Kunjungan anak.');
        }


        $anaks = DB::table('anaks')
            ->join('kunjungan_anaks', 'kunjungan_anaks.anak_id', '=', 'anaks.id')
            ->where('kunjungan_anaks.kunjungan_id', $kunjungan->id)
            ->select('anaks.id', 'anaks.nama_anak')
            ->distinct()
            ->get();
        $obats = DB::table('obats')
            ->select('id', 'nama_obat_vitamin', 'stok')
            ->where('tanggal_kadaluarsa', '>=', now()) // Memastikan tanggal kadaluarsa belum lewat
            ->get();


        $kategoriImunisasi = KategoriImunasasi::select('id', 'nama_kategori_imunisasi')->get();
        // dd($kategoriImunisasi);

        return view('imunisasi.index', compact('kunjungan', 'anaks', 'obats', 'kategoriImunisasi'));
    }

    public function listImunisasi(Request $request, $id)
    {
        if (!$request->ajax()) {
            return response()->json(['message' => 'Method not allowed'], 405);
        }

        $imunisasi = DB::table('imunisasis')
            ->join('kunjungan_anaks', 'kunjungan_anaks.id', '=', 'imunisasis.kunjungan_anak_id')
            ->join('kategori_imunasasis', 'kategori_imunasasis.id', '=', 'imunisasis.kategori_imunisasi_id')
            ->join('anaks', 'anaks.id', '=', 'kunjungan_anaks.anak_id')
            ->select(
                'imunisasis.id',
                'imunisasis.tanggal_imunisasi',
                'imunisasis.tanggal_imunisasi_lanjutan',
                'anaks.nama_anak',
                'kategori_imunasasis.nama_kategori_imunisasi'
            )
            ->where('kunjungan_anaks.kunjungan_id', $id);

        // Filter berdasarkan nama anak (jika dikirim dari frontend)
        if ($request->has('nama_anak')) {
            $imunisasi->where('anaks.nama_anak', $request->get('nama_anak'));
        }

        return DataTables::of($imunisasi)
            ->addIndexColumn()
            ->make(true);
    }

    public function listObatImunisasi(Request $request, $kunjungan_id)
    {
        if (!$request->ajax()) {
            return response()->json(['message' => 'Method not allowed'], 405);
        }

        $query = DB::table('imunisasi_obats')
            ->join('imunisasis', 'imunisasis.id', '=', 'imunisasi_obats.imunisasi_id')
            ->join('kunjungan_anaks', 'kunjungan_anaks.id', '=', 'imunisasis.kunjungan_anak_id')
            ->join('anaks', 'anaks.id', '=', 'kunjungan_anaks.anak_id')
            ->join('obats', 'obats.id', '=', 'imunisasi_obats.obat_id')
            ->select(
                'anaks.nama_anak',
                'obats.nama_obat_vitamin',
                'imunisasi_obats.jumlah_obat'
            )
            ->where('kunjungan_anaks.kunjungan_id', $kunjungan_id);

        if ($request->has('nama_anak')) {
            $query->where('anaks.nama_anak', $request->get('nama_anak'));
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    public function showObatModal(Request $request)
    {
        $id = $request->input('id');

        // Pastikan $id berupa array
        if (!is_array($id)) {
            $id = [$id]; // Ubah jadi array jika bukan
        }

        $obat = ImunisasiObat::with('obat', 'imunisasi')->whereIn('imunisasi_id', $id)->get();
        // dd($obat);

        if ($obat->count()) {
            return response()->json([
                'success' => true,
                'data' => $obat
            ]);
        }

        return response()->json(['success' => false]);
    }



    public function storeImunisasi(Request $request, $kunjunganId)
    {
        $validated = $request->validate([
            'anak_id' => 'required|array',
            'anak_id.*' => 'exists:anaks,id',

            'kategori_imunisasi_id' => 'required|array',
            'kategori_imunisasi_id.*' => 'exists:kategori_imunasasis,id', // tambahkan ini untuk validasi isi
            'obat_id' => 'nullable|array',
            'jumlah_obat' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            $kunjungan = Kunjungan::findOrFail($kunjunganId);

            foreach ($request->anak_id as $anakId) {
                $kunjunganAnak = $kunjungan->kunjungan_anaks()->where('anak_id', $anakId)->first();

                if (!$kunjunganAnak) {
                    return redirect()->route('kunjungan.index')->with('error', 'Kunjungan anak tidak ditemukan.');
                }

                $kategoriId = $request->kategori_imunisasi_id[$anakId] ?? null;
                if ($kategoriId) {
                    $tanggalLanjutan = $request->tanggal_imunisasi_lanjutan[$anakId][$kategoriId] ?? null;

                    $imunisasi = new Imunisasi();
                    $imunisasi->kunjungan_anak_id = $kunjunganAnak->id;
                    $imunisasi->kategori_imunisasi_id = $kategoriId;
                    $imunisasi->tanggal_imunisasi = now();
                    $imunisasi->tanggal_imunisasi_lanjutan = $tanggalLanjutan;
                    $imunisasi->save();

                    $obatIds = $request->obat_id[$anakId][$kategoriId] ?? null;
                    $jumlahObats = $request->jumlah_obat[$anakId][$kategoriId] ?? [];

                    if ($obatIds && is_array($obatIds)) {
                        foreach ($obatIds as $obatId) {
                            $jumlah = $jumlahObats[$obatId] ?? 1;

                            $obat = \App\Models\Obat::where('id', $obatId)->lockForUpdate()->first();

                            if (!$obat) {
                                throw new \Exception("Obat dengan ID $obatId tidak ditemukan.");
                            }

                            if ($obat->stok < $jumlah) {
                                throw new \Exception("Stok obat '{$obat->nama_obat_vitamin}' tidak mencukupi.");
                            }

                            $obat->stok -= $jumlah;
                            $obat->save();

                            $imunisasiObat = new \App\Models\ImunisasiObat();
                            $imunisasiObat->imunisasi_id = $imunisasi->id;
                            $imunisasiObat->obat_id = $obatId;
                            $imunisasiObat->jumlah_obat = $jumlah;
                            $imunisasiObat->save();
                        }
                    }
                }
            }
            // dd($request->all());
            DB::commit();
            return redirect()->route('kunjungan.imunisasi-anak', ['id' => $kunjungan->id])->with('success', 'Data imunisasi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error during imunisasi process:', [
                'exception' => $e,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('kunjungan.index')->with('error', 'Gagal menyimpan imunisasi: ' . $e->getMessage());
        }
    }
}
