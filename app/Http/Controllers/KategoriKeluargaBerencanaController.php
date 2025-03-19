<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriKBRequest;
use App\Http\Requests\UpdateKategoriKBRequest;
use App\Models\KategoriKeluargaBerencana;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KategoriKeluargaBerencanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kategori-kb.index')->only('index', 'list');
        $this->middleware('permission:kategori-kb.create')->only('create', 'store');
        $this->middleware('permission:kategori-kb.edit')->only('edit', 'update');
        $this->middleware('permission:kategori-kb.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            // Mulai query untuk mengambil data obat
            $query = DB::table('kategori_keluarga_berencanas')
                ->select('id', 'nama_kategori_keluarga_berencana', 'deskripsi');

            $kategori = $query->get();

            return DataTables::of($kategori)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategori-kb.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori-kb.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriKBRequest $request)
    {
        KategoriKeluargaBerencana::create($request->all());

        return redirect()->route('kategori-kb.index')->with('success', 'Kategori KB berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriKeluargaBerencana $kategoriKeluargaBerencana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $kategori = KategoriKeluargaBerencana::findOrFail($id);
        return view('kategori-kb.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriKBRequest $request, $id)
    {
        $kategori = KategoriKeluargaBerencana::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori-kb.index')->with('success', 'Kategori KB berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // mulai transaksi
        DB::beginTransaction();
        try {
            $kategori = KategoriKeluargaBerencana::findOrFail($id);
            $kategori->delete();
            DB::commit();
            // return json
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }
}
