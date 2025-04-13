<?php

namespace App\Http\Controllers;

use App\Models\KeluargaBerencana;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JadwalKunjunganKBController extends Controller
{
    public function list(Request $request, $id)
    {
        if ($request->ajax()) {
            // Pastikan untuk menggunakan kolom yang benar
            $jadwalKunjunganKB = DB::table('jadwal_kunjungan_kbs')
                ->leftJoin('jenis_kunjungan_keluarga_berencanas', 'jadwal_kunjungan_kbs.jenis_kunjungan_kb_id', '=', 'jenis_kunjungan_keluarga_berencanas.id') // pastikan nama kolomnya benar
                ->where('jadwal_kunjungan_kbs.keluarga_berencana_id', $id)
                ->select(
                    'jadwal_kunjungan_kbs.id',
                    'jenis_kunjungan_keluarga_berencanas.nama_jenis_kunjungan_keluarga_berencana',
                    'jadwal_kunjungan_kbs.tanggal_kunjungan_kb'
                )
                ->get();

            return DataTables::of($jadwalKunjunganKB)
                ->addIndexColumn()
                ->make(true);
        }

        return response()->json(['message' => 'Method not allowed'], 405);
    }



    public function index($id)
    {
        $keluargaBerencana = KeluargaBerencana::findOrFail($id);
        if ($keluargaBerencana->is_permanent == 1) {
            return redirect()->route('keluarga-berencana.index')->with('status', 'Telah melakukan KB permanen.');
        }
        return view('keluarga-berencana.jadwal-kunjungan-kb.index', compact('keluargaBerencana'));
    }
}
