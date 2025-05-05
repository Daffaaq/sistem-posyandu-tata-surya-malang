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
}
