<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        $jadwals = DB::table('jadwal_posyandus')
            ->whereDate('tanggal_kegiatan', '>=', now())
            ->orderBy('tanggal_kegiatan', 'asc')
            ->get();
        return view('landingPage', compact('jadwals'));
    }

    public function dataObat(Request $request)
    {
        if ($request->ajax()) {
            // Mulai query untuk mengambil data obat
            $query = DB::table('obats')
                ->select('id', 'nama_obat_vitamin', 'tipe', 'stok', 'tanggal_kadaluarsa')
                ->orderBy('tanggal_kadaluarsa', 'asc');

            // Filter berdasarkan tipe jika ada
            $query->when($request->filled('tipe_filter'), function ($query) use ($request) {
                return $query->where('tipe', $request->tipe_filter);
            });

            $obat = $query->get();

            // Debugging - Cek hasil query
            // dd($obat);

            return DataTables::of($obat)
                ->addIndexColumn()
                ->editColumn('stok', function ($row) {
                    $stokBulatan = '';
                    if ($row->stok <= 10) {
                        $stokBulatan = '<span class="inline-block w-3 h-3 bg-red-500 rounded-full ml-2" title="Stok Hampir Habis"></span>';
                    }
                    return $row->stok . $stokBulatan;
                })
                ->editColumn('tanggal_kadaluarsa', function ($row) {
                    $today = \Carbon\Carbon::now();
                    $kadaluarsa = \Carbon\Carbon::parse($row->tanggal_kadaluarsa);
                    $diff = $today->diffInDays($kadaluarsa, false);
                    $formattedDate = $kadaluarsa->format('d-m-Y');
                    $dot = '';

                    if ($diff <= 7) {
                        $dot = '<span class="inline-block w-3 h-3 bg-red-500 rounded-full ml-2" title="Segera Kadaluarsa"></span>';
                    } elseif ($diff <= 14) {
                        $dot = '<span class="inline-block w-3 h-3 bg-yellow-400 rounded-full ml-2" title="Mendekati Kadaluarsa"></span>';
                    } elseif ($diff > 14) {
                        $dot = '<span class="inline-block w-3 h-3 bg-green-500 rounded-full ml-2" title="Kadaluarsa Masih Lama"></span>';
                    }

                    return $formattedDate . $dot;
                })
                ->rawColumns(['stok', 'tanggal_kadaluarsa'])
                ->make(true);
        }

        return response()->json(['message' => 'Method not allowed'], 405);
    }
}
