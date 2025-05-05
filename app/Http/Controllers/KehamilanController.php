<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKehamilanRequest;
use App\Http\Requests\UpdateKehamilanRequest;
use App\Models\Kehamilan;
use App\Models\PemeriksaanKehamilan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KehamilanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kehamilan.index')->only('index', 'list');
        $this->middleware('permission:kehamilan.create')->only('create', 'store');
        $this->middleware('permission:kehamilan.edit')->only('edit', 'update');
        $this->middleware('permission:kehamilan.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('kehamilans')
                ->leftJoin('orang_tuas', 'kehamilans.orang_tua_id', '=', 'orang_tuas.id')
                ->select('kehamilans.id', 'kehamilans.status_kehamilan', 'kehamilans.tanggal_mulai_kehamilan', 'kehamilans.prediksi_tanggal_lahir', DB::raw("CONCAT(orang_tuas.nama_ayah, ' & ', orang_tuas.nama_ibu) as orang_tua"));

            $kehamilan = $query->get();

            return DataTables::of($kehamilan)
                ->addIndexColumn()
                ->make(true);
        }
        // jika bukan response ajax maka return 405
        return response()->json(['message' => 'Method not allowed'], 405);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kehamilan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orangTuaList = DB::table('orang_tuas')->select('id', 'nama_ayah', 'nama_ibu')->get();

        return view('kehamilan.create', compact('orangTuaList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKehamilanRequest $request)
    {
        try {
            $kehamilan = Kehamilan::create([
                'orang_tua_id' => $request->orang_tua_id,
                'status_kehamilan' => $request->status_kehamilan,
                'tanggal_mulai_kehamilan' => $request->tanggal_mulai_kehamilan,
                'prediksi_tanggal_lahir' => $request->prediksi_tanggal_lahir,
            ]);

            // 2. Cek jika input pemeriksaan kehamilan disertakan
            if ($request->filled('tanggal_pemeriksaan_kehamilan')) {
                PemeriksaanKehamilan::create([
                    'kehamilan_id' => $kehamilan->id,
                    'tanggal_pemeriksaan_kehamilan' => $request->tanggal_pemeriksaan_kehamilan,
                    'deskripsi_pemeriksaan_kehamilan' => $request->deskripsi_pemeriksaan_kehamilan,
                    'keluhan_kehamilan' => $request->keluhan_kehamilan,
                    'tekanan_darah_ibu_hamil' => $request->tekanan_darah_ibu_hamil,
                    'berat_badan_ibu_hamil' => $request->berat_badan_ibu_hamil,
                    'posisi_janin' => $request->posisi_janin,
                    'usia_kandungan' => $request->usia_kandungan,
                ]);
            }
            return redirect()->route('kehamilan.index')->with('success', 'Data kehamilan berhasil ditambahkan!');
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan kehamilan: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data kehamilan beserta relasi orang tua dan pemeriksaan kehamilan
        $kehamilan = Kehamilan::with(['orangTua', 'pemeriksaanKehamilans'])->findOrFail($id);

        return view('kehamilan.show', compact('kehamilan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kehamilan = Kehamilan::with('orangTua', 'pemeriksaanKehamilans')->findOrFail($id);

        $orangTuaList = DB::table('orang_tuas')->select('id', 'nama_ayah', 'nama_ibu')->get();

        return view('kehamilan.edit', compact('kehamilan', 'orangTuaList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKehamilanRequest $request, string $id)
    {
        // dd($request->all());
        try {

            $kehamilan = Kehamilan::findOrFail($id);

            $kehamilan->update([
                'orang_tua_id' => $request->orang_tua_id,
                'status_kehamilan' => $request->status_kehamilan,
                'tanggal_mulai_kehamilan' => $request->tanggal_mulai_kehamilan,
                'prediksi_tanggal_lahir' => $request->prediksi_tanggal_lahir,
            ]);

            // Update atau delete pemeriksaan yang ada
            if ($request->has('tanggal_pemeriksaan_kehamilan')) {
                foreach ($request->tanggal_pemeriksaan_kehamilan as $index => $tanggal_pemeriksaan) {
                    $pemeriksaan = $kehamilan->pemeriksaanKehamilans()->find($request->pemeriksaan_id[$index]);

                    if ($pemeriksaan) {
                        // Update pemeriksaan yang sudah ada
                        $pemeriksaan->update([
                            'tanggal_pemeriksaan_kehamilan' => $tanggal_pemeriksaan,
                            'deskripsi_pemeriksaan_kehamilan' => $request->deskripsi_pemeriksaan_kehamilan[$index],
                            'keluhan_kehamilan' => $request->keluhan_kehamilan[$index],
                            'tekanan_darah_ibu_hamil' => $request->tekanan_darah_ibu_hamil[$index],
                            'berat_badan_ibu_hamil' => $request->berat_badan_ibu_hamil[$index],
                            'posisi_janin' => $request->posisi_janin[$index],
                            'usia_kandungan' => $request->usia_kandungan[$index],
                        ]);
                    }
                }
            }

            return redirect()->route('kehamilan.index')->with('success', 'Data kehamilan berhasil diperbarui!');
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui kehamilan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // mulai transaksi
        DB::beginTransaction();
        try {
            $kehamilan = Kehamilan::findOrFail($id);
            $kehamilan->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Gagal menghapus kehamilan: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }
}
