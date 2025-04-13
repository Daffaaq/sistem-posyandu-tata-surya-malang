<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKeluargaBerencanaRequest;
use App\Http\Requests\UpdateKeluargaBerencanaRequest;
use App\Models\JadwalKunjunganKb;
use App\Models\KeluargaBerencana;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KeluargaBerencanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:keluarga-berencana.index')->only('index', 'list');
        $this->middleware('permission:keluarga-berencana.create')->only('create', 'store');
        $this->middleware('permission:keluarga-berencana.edit')->only('edit', 'update');
        $this->middleware('permission:keluarga-berencana.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $keluargaBerencana = DB::table('keluarga_berencanas')
                ->leftJoin('orang_tuas', 'keluarga_berencanas.orang_tua_id', '=', 'orang_tuas.id')
                ->leftJoin('kategori_keluarga_berencanas', 'keluarga_berencanas.kategori_keluarga_berencana_id', '=', 'kategori_keluarga_berencanas.id')
                ->select('keluarga_berencanas.id',  'keluarga_berencanas.is_permanent', DB::raw("CONCAT(orang_tuas.nama_ayah, ' & ', orang_tuas.nama_ibu) as orang_tua"), 'kategori_keluarga_berencanas.nama_kategori_keluarga_berencana')
                ->get();

            return DataTables::of($keluargaBerencana)
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
        return view('keluarga-berencana.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orangTua = DB::table('orang_tuas')->select('id', 'nama_ayah', 'nama_ibu')->get();
        $kategoriKeluargaBerencana = DB::table('kategori_keluarga_berencanas')->select('id', 'nama_kategori_keluarga_berencana')->get();
        $kategoriKunjunganKeluargaBerencana = DB::table('jenis_kunjungan_keluarga_berencanas')->select('id', 'nama_jenis_kunjungan_keluarga_berencana', 'deskripsi')->get();
        return view('keluarga-berencana.create', compact('orangTua', 'kategoriKeluargaBerencana', 'kategoriKunjunganKeluargaBerencana'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKeluargaBerencanaRequest $request)
    {
        // Ambil data yang sudah tervalidasi
        $data = $request->validated();

        // Jika is_permanent == '1', set tanggal_selesai_keluarga_berencana ke null
        if ($data['is_permanent'] == '1') {
            $data['tanggal_selesai_keluarga_berencana'] = null;
        }

        // Menambahkan pemeriksaan custom untuk memastikan tanggal selesai hanya diisi jika is_permanent == 0
        if ($data['is_permanent'] == '0' && empty($data['tanggal_selesai_keluarga_berencana'])) {
            return redirect()->back()->withErrors(['tanggal_selesai_keluarga_berencana' => 'Tanggal selesai harus diisi jika metode tidak permanen.']);
        }

        // Simpan data keluarga berencana
        $keluargaBerencana = KeluargaBerencana::create($data);

        // Redirect to the index page with a success message
        return redirect()->route('keluarga-berencana.index')
            ->with('success', 'Data keluarga berencana berhasil disimpan.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $keluargaBerencana = KeluargaBerencana::with('orangTua', 'kategoriKeluargaBerencana')->findOrFail($id);
        return view('keluarga-berencana.show', compact('keluargaBerencana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $orangTua = DB::table('orang_tuas')->select('id', 'nama_ayah', 'nama_ibu')->get();
        $kategoriKeluargaBerencana = DB::table('kategori_keluarga_berencanas')->select('id', 'nama_kategori_keluarga_berencana')->get();
        $keluargaBerencana = KeluargaBerencana::findOrFail($id);
        return view('keluarga-berencana.edit', compact('keluargaBerencana', 'orangTua', 'kategoriKeluargaBerencana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeluargaBerencanaRequest $request, $id)
    {
        // Validasi data
        $data = $request->validated();

        // Cari data berdasarkan ID
        $keluargaBerencana = KeluargaBerencana::findOrFail($id);

        // Kalau is_permanent = 1, maka tanggal selesai di-set null
        if ($data['is_permanent'] == '1') {
            $data['tanggal_selesai_keluarga_berencana'] = null;
        }

        // Update data
        $keluargaBerencana->update($data);

        return redirect()->route('keluarga-berencana.index')
            ->with('success', 'Data keluarga berencana berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KeluargaBerencana $keluargaBerencana)
    {
        // mulai transaksi
        DB::beginTransaction();
        try {
            $keluargaBerencana->delete();
            DB::commit();
            // return json
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }
}
