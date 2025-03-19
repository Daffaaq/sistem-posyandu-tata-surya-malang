<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriImunisasiRequest;
use App\Models\KategoriImunasasi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KategoriImunasasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kategori-imunisasi.index')->only('index', 'list');
        $this->middleware('permission:kategori-imunisasi.create')->only('create', 'store');
        $this->middleware('permission:kategori-imunisasi.edit')->only('edit', 'update');
        $this->middleware('permission:kategori-imunisasi.destroy')->only('destroy');
    }

    public function list(Request $request){
        if ($request->ajax()) {
            $kategoriImunasasi = DB::table('kategori_imunasasis')
                ->select('id', 'nama_kategori_imunisasi', 'is_active','slug');
            return DataTables::of($kategoriImunasasi)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategori-imunasasi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori-imunasasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriImunisasiRequest $request)
    {
        // Create a new KategoriImunasasi record using validated data
        $kategoriImunasasi = KategoriImunasasi::create([
            'nama_kategori_imunisasi' => $request->nama_kategori_imunisasi,
            'keterangan' => $request->keterangan,
            'is_active' => $request->is_active,
            'slug' => $request->slug, // Automatically set by boot method
        ]);

        // Redirect back with a success message
        return redirect()->route('kategori-imunisasi.index')->with('success', 'Kategori Imunisasi berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriImunasasi $kategoriImunasasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategoriImunasasi = KategoriImunasasi::findOrFail($id);
        return view('kategori-imunasasi.edit', compact('kategoriImunasasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategoriImunasasi = KategoriImunasasi::findOrFail($id);
        // Update the category with validated data
        $kategoriImunasasi->update([
            'nama_kategori_imunisasi' => $request->input('nama_kategori_imunisasi'),
            'keterangan' => $request->input('keterangan'),
            'is_active' => $request->input('is_active'),
            'slug' => $request->slug,
        ]);

        // Redirect back to index with success message
        return redirect()->route('kategori-imunisasi.index')
            ->with('success', 'Kategori Imunisasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // mulai transaksi
        DB::beginTransaction();
        try {
            $kategoriImunasasi = KategoriImunasasi::findOrFail($id);
            $kategoriImunasasi->delete();
            DB::commit();
            // return json
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }
}
