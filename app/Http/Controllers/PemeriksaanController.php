<?php

namespace App\Http\Controllers;

use App\Models\Kehamilan;
use App\Models\PemeriksaanKehamilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PemeriksaanController extends Controller
{
    public function list1(Request $request, $kehamilan)
    {
        if ($request->ajax()) {
            $pemeriksaan = DB::table('pemeriksaan_kehamilans')
                ->join('kehamilans', 'pemeriksaan_kehamilans.kehamilan_id', '=', 'kehamilans.id')
                ->join('orang_tuas', 'kehamilans.orang_tua_id', '=', 'orang_tuas.id')
                ->where('kehamilans.id', $kehamilan)
                ->select([
                    'pemeriksaan_kehamilans.id',
                    'pemeriksaan_kehamilans.tanggal_pemeriksaan_kehamilan',
                    'pemeriksaan_kehamilans.usia_kandungan',
                    DB::raw("CONCAT(orang_tuas.nama_ayah, ' & ', orang_tuas.nama_ibu) as orang_tua")
                ])
                ->get();

            return DataTables::of($pemeriksaan)
                ->addIndexColumn()
                ->make(true);
        }

        // jika bukan response ajax maka return 405
        return response()->json(['message' => 'Method not allowed'], 405);
    }
    public function list(Request $request, $kehamilan)
    {
        if ($request->ajax()) {
            $pemeriksaan = DB::table('pemeriksaan_kehamilans')
                ->join('kehamilans', 'pemeriksaan_kehamilans.kehamilan_id', '=', 'kehamilans.id')
                ->join('orang_tuas', 'kehamilans.orang_tua_id', '=', 'orang_tuas.id')
                ->where('kehamilans.id', $kehamilan)
                ->select([
                    'pemeriksaan_kehamilans.id',
                    'pemeriksaan_kehamilans.tanggal_pemeriksaan_kehamilan',
                    'pemeriksaan_kehamilans.usia_kandungan',
                    'pemeriksaan_kehamilans.deskripsi_pemeriksaan_kehamilan',
                    'pemeriksaan_kehamilans.keluhan_kehamilan',
                    'pemeriksaan_kehamilans.tekanan_darah_ibu_hamil',
                    'pemeriksaan_kehamilans.berat_badan_ibu_hamil',
                    'pemeriksaan_kehamilans.posisi_janin',
                    'pemeriksaan_kehamilans.usia_kandungan',
                    DB::raw("CONCAT(orang_tuas.nama_ayah, ' & ', orang_tuas.nama_ibu) as orang_tua")
                ])
                ->get();

            return DataTables::of($pemeriksaan)
                ->addIndexColumn()
                ->make(true);
        }

        // jika bukan response ajax maka return 405
        return response()->json(['message' => 'Method not allowed'], 405);
    }

    public function showModal(Request $request)
    {
        $id = $request->input('id');
        $pemeriksaan = PemeriksaanKehamilan::find($id);

        if ($pemeriksaan) {
            return response()->json([
                'success' => true,
                'data' => $pemeriksaan
            ]);
        }

        return response()->json(['success' => false]);
    }


    public function index($id)
    {
        $kehamilan = Kehamilan::with('orangTua', 'pemeriksaanKehamilans')->findOrFail($id);
        return view('kehamilan.pemeriksaan.index', compact('kehamilan'));
    }

    public function storePemeriksaanKehamilan(Request $request, $id)
    {
        // dd($request->all());
        $kehamilan = Kehamilan::findOrFail($id);

        $validatedData = $request->validate([
            'pemeriksaans' => 'required|array',
            'pemeriksaans.*.tanggal_pemeriksaan_kehamilan' => 'required|date',
            'pemeriksaans.*.deskripsi_pemeriksaan_kehamilan' => 'required|string',
            'pemeriksaans.*.keluhan_kehamilan' => 'nullable|string',
            'pemeriksaans.*.tekanan_darah_ibu_hamil' => 'required|string',
            'pemeriksaans.*.berat_badan_ibu_hamil' => 'required|numeric|min:30|max:10000',
            'pemeriksaans.*.posisi_janin' => 'required|string',
            'pemeriksaans.*.usia_kandungan' => 'required|numeric|min:1|max:42',
        ]);

        foreach ($validatedData['pemeriksaans'] as $pemeriksaan) {
            $sudahAda = PemeriksaanKehamilan::where('kehamilan_id', $kehamilan->id)
                ->where('tanggal_pemeriksaan_kehamilan', $pemeriksaan['tanggal_pemeriksaan_kehamilan'])
                ->exists();

            if ($sudahAda) {
                continue; // skip duplikat
            }

            PemeriksaanKehamilan::create([
                'kehamilan_id' => $kehamilan->id,
                'tanggal_pemeriksaan_kehamilan' => $pemeriksaan['tanggal_pemeriksaan_kehamilan'],
                'deskripsi_pemeriksaan_kehamilan' => $pemeriksaan['deskripsi_pemeriksaan_kehamilan'],
                'keluhan_kehamilan' => $pemeriksaan['keluhan_kehamilan'] ?? null,
                'tekanan_darah_ibu_hamil' => $pemeriksaan['tekanan_darah_ibu_hamil'],
                'berat_badan_ibu_hamil' => $pemeriksaan['berat_badan_ibu_hamil'],
                'posisi_janin' => $pemeriksaan['posisi_janin'],
                'usia_kandungan' => $pemeriksaan['usia_kandungan'],
            ]);
        }

        return redirect()->route('pemeriksaan.kehamilan.index', ['id' => $kehamilan->id])
            ->with('success', 'Data pemeriksaan kehamilan berhasil ditambahkan!');
    }

    public function editPemeriksaanKehamilan($id)
    {
        $pemeriksaan = PemeriksaanKehamilan::findOrFail($id);
        return view('kehamilan.pemeriksaan.edit', compact('pemeriksaan'));
    }

    public function updatePemeriksaanKehamilan(Request $request, $id)
    {
        try {
            $pemeriksaan = PemeriksaanKehamilan::findOrFail($id);

            $validatedData = $request->validate([
                'tanggal_pemeriksaan_kehamilan' => 'required|date',
                'deskripsi_pemeriksaan_kehamilan' => 'required|string',
                'keluhan_kehamilan' => 'nullable|string',
                'tekanan_darah_ibu_hamil' => 'required|string',
                'berat_badan_ibu_hamil' => 'required|numeric|min:30|max:300',
                'posisi_janin' => 'required|string',
                'usia_kandungan' => 'required|numeric|min:1|max:42',
            ]);

            $pemeriksaan->update($validatedData);

            return redirect()
                ->route('pemeriksaan.kehamilan.index', ['id' => $pemeriksaan->kehamilan_id])
                ->with('success', 'Data pemeriksaan kehamilan berhasil diupdate!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data pemeriksaan tidak ditemukan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Laravel otomatis redirect ke back dengan error validation, jadi bisa dibiarkan atau log
            throw $e;
        } catch (\Exception $e) {
            // Untuk error umum lainnya
            Log::error('Gagal update pemeriksaan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function destroyPemeriksaanKehamilan($id)
    {
        try {
            $pemeriksaan = PemeriksaanKehamilan::findOrFail($id);
            $pemeriksaan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data pemeriksaan kehamilan berhasil dihapus!'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data pemeriksaan tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus pemeriksaan kehamilan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data.'
            ], 500);
        }
    }
}
