<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use App\Models\ImunisasiObat;
use App\Models\KategoriImunasasi;
use App\Models\Kunjungan;
use App\Models\KunjunganAnak;
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


    public function storeImunisasi(Request $request, $kunjunganId)
    {
        // Validasi request
        $validated = $request->validate([
            'anak_id' => 'required|array',
            'anak_id.*' => 'exists:anaks,id',

            'kategori_imunisasi_id' => 'required|array',
            'kategori_imunisasi_id.*' => 'array',

            'tanggal_imunisasi_lanjutan' => 'nullable|array',
            'tanggal_imunisasi_lanjutan.*' => 'nullable|date_format:Y-m-d',

            'obat_id' => 'sometimes|array',
            'obat_id.*' => 'array',

            'jumlah_obat' => 'sometimes|array',
            'jumlah_obat.*' => 'array',
        ]);

        try {
            DB::beginTransaction();

            // Ambil data kunjungan berdasarkan ID
            $kunjungan = Kunjungan::findOrFail($kunjunganId);

            // Loop untuk setiap anak ID
            foreach ($request->anak_id as $anakId) {
                // Ambil kategori imunisasi yang dipilih oleh anak tersebut
                $kategoriList = $request->kategori_imunisasi_id[$anakId] ?? [];

                // Loop untuk setiap kategori imunisasi yang dipilih
                foreach ($kategoriList as $index => $kategoriId) {

                    // Ambil tanggal imunisasi lanjutan untuk kategori ini berdasarkan index
                    $tanggalLanjutan = isset($tanggalList[$index]) ? $tanggalList[$index] : null;

                    // Periksa apakah tanggal lanjutan valid, jika tidak maka kosongkan
                    if ($tanggalLanjutan && strtotime($tanggalLanjutan) === false) {
                        $tanggalLanjutan = null;
                    }


                    // Cari data kunjungan anak
                    $kunjunganAnak = KunjunganAnak::where('kunjungan_id', $kunjunganId)
                        ->where('anak_id', $anakId)
                        ->first();

                    if (!$kunjunganAnak) {
                        throw new \Exception("Data kunjungan anak tidak ditemukan untuk anak ID {$anakId}.");
                    }

                    // Proses untuk menyimpan data imunisasi
                    $imunisasi = Imunisasi::create([
                        'kunjungan_anak_id' => $kunjunganAnak->id,
                        'kategori_imunisasi_id' => $kategoriId,
                        'tanggal_imunisasi' => now(),  // Gunakan waktu saat ini untuk tanggal imunisasi
                        'tanggal_imunisasi_lanjutan' => $tanggalLanjutan,  // Gunakan tanggal lanjutan yang sesuai
                    ]);

                    // Ambil daftar obat untuk kategori imunisasi ini
                    $obatList = $request->obat_id[$anakId][$index] ?? [];

                    // Loop untuk setiap obat yang dipilih
                    foreach ($obatList as $obatId) {
                        // Ambil jumlah obat yang dibutuhkan
                        $jumlah = $request->jumlah_obat[$anakId][$index][$obatId] ?? 0;

                        // Skip jika jumlah obat <= 0
                        if ($jumlah <= 0) {
                            continue;
                        }

                        // Ambil data obat berdasarkan ID dan lock untuk update
                        $obat = DB::table('obats')->where('id', $obatId)->lockForUpdate()->first();

                        if (!$obat) {
                            throw new \Exception("Obat dengan ID {$obatId} tidak ditemukan.");
                        }

                        // Periksa apakah stok cukup
                        if ($obat->stok < $jumlah) {
                            throw new \Exception("Stok obat untuk ID {$obatId} tidak mencukupi.");
                        }

                        // Kurangi stok obat sesuai jumlah yang digunakan
                        DB::table('obats')->where('id', $obatId)->decrement('stok', $jumlah);

                        // Simpan data obat yang digunakan dalam imunisasi
                        ImunisasiObat::create([
                            'imunisasi_id' => $imunisasi->id,
                            'obat_id' => $obatId,
                            'jumlah_obat' => $jumlah,
                        ]);
                    }
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect dengan pesan sukses
            return redirect()->route('kunjungan.index')->with('success', 'Data imunisasi berhasil disimpan.');
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
