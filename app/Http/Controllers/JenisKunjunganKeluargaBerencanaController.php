<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJenisKunjunganKBRequest;
use App\Http\Requests\UpdateJenisKunjunganKBRequest;
use App\Models\JenisKunjunganKeluargaBerencana;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JenisKunjunganKeluargaBerencanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:jenis-kunjungan-kb.index')->only('index', 'list');
        $this->middleware('permission:jenis-kunjungan-kb.create')->only('create', 'store');
        $this->middleware('permission:jenis-kunjungan-kb.edit')->only('edit', 'update');
        $this->middleware('permission:jenis-kunjungan-kb.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $jenisKunjunganKeluargaBerencana = DB::table('jenis_kunjungan_keluarga_berencanas')->select('id', 'nama_jenis_kunjungan_keluarga_berencana', 'deskripsi');
            return DataTables::of($jenisKunjunganKeluargaBerencana)
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
        return view('jenis-kunjungan-kb.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis-kunjungan-kb.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJenisKunjunganKBRequest $request)
    {
        JenisKunjunganKeluargaBerencana::create($request->all());
        return redirect()->route('jenis-kunjungan-kb.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisKunjunganKeluargaBerencana $jenisKunjunganKeluargaBerencana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jenisKunjunganKeluargaBerencana = JenisKunjunganKeluargaBerencana::findOrFail($id);
        return view('jenis-kunjungan-kb.edit', compact('jenisKunjunganKeluargaBerencana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisKunjunganKBRequest $request, $id)
    {
        $jenisKunjunganKeluargaBerencana = JenisKunjunganKeluargaBerencana::findOrFail($id);
        $jenisKunjunganKeluargaBerencana->update($request->all());
        return redirect()->route('jenis-kunjungan-kb.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($jenisKunjunganKeluargaBerencana)
    {
        // mulai transaksi
        DB::beginTransaction();
        try {
            $jenisKunjunganKeluargaBerencana = JenisKunjunganKeluargaBerencana::findOrFail($jenisKunjunganKeluargaBerencana);
            $jenisKunjunganKeluargaBerencana->delete();
            DB::commit();
            // return json
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }
}
