<?php

namespace App\Http\Controllers;

use App\Models\Kehamilan;
use App\Models\PemeriksaanKehamilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
