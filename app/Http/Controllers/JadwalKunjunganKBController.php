<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJadwalKunjunganKBRequest;
use App\Models\JadwalKunjunganKb;
use App\Models\JenisKunjunganKeluargaBerencana;
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
        $keluargaBerencana = KeluargaBerencana::with('orangTua', 'kategoriKeluargaBerencana')->findOrFail($id);
        if ($keluargaBerencana->is_permanent == 1) {
            return redirect()->route('keluarga-berencana.index')->with('status', 'Telah melakukan KB permanen.');
        }
        $jenisKunjunganKeluargaBerencana = DB::table('jenis_kunjungan_keluarga_berencanas')->select('id', 'nama_jenis_kunjungan_keluarga_berencana', 'deskripsi')->get();
        return view('keluarga-berencana.jadwal-kunjungan-kb.index', compact('keluargaBerencana', 'jenisKunjunganKeluargaBerencana'));
    }

    public function store(StoreJadwalKunjunganKBRequest $request, $id)
    {
        // mulai transaksi
        try {
            $keluargaBerencana = KeluargaBerencana::findOrFail($id);

            $keluargaBerencana->jadwalKunjunganKbs()->create([
                'jenis_kunjungan_kb_id' => $request->jenis_kunjungan_kb_id,
                'tanggal_kunjungan_kb' => $request->tanggal_kunjungan_kb,
            ]);
            // return json
            return response()->json(['success' => true, 'message' => 'Jadwal kunjungan KB berhasil ditambahkan.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Jadwal kunjungan KB gagal ditambahkan.'], 500);
        }
    }

    public function edit($id)
    {
        $jadwalKunjunganKB = JadwalKunjunganKb::findOrFail($id);
        $jenisKunjunganKeluargaBerencana = JenisKunjunganKeluargaBerencana::all();

        return view('keluarga-berencana.jadwal-kunjungan-kb.edit', compact('jadwalKunjunganKB', 'jenisKunjunganKeluargaBerencana'));
    }

    public function update(StoreJadwalKunjunganKBRequest $request, $id)
    {
            $jadwalKunjunganKB = JadwalKunjunganKb::findOrFail($id);
            $jadwalKunjunganKB->update([
                'jenis_kunjungan_kb_id' => $request->jenis_kunjungan_kb_id,
                'tanggal_kunjungan_kb' => $request->tanggal_kunjungan_kb,
            ]);
        // return view
        return redirect()->route('keluarga-berencana.jadwal-kunjungan-kb.index', $jadwalKunjunganKB->keluarga_berencana_id)->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        // mulai transaksi
        DB::beginTransaction();
        try {
            $jadwalKunjunganKB = JadwalKunjunganKb::findOrFail($id);
            $jadwalKunjunganKB->delete();
            DB::commit();
            // return json
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }
}
