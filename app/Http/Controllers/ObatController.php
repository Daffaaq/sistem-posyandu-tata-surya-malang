<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObatRequest;
use App\Http\Requests\UpdateObatRequest;
use App\Models\Obat;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:obat.index')->only('index', 'list');
        $this->middleware('permission:obat.create')->only('create', 'store');
        $this->middleware('permission:obat.edit')->only('edit', 'update');
        $this->middleware('permission:obat.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            // Mulai query untuk mengambil data obat
            $query = DB::table('obats')
                ->select('id', 'nama_obat_vitamin', 'tipe', 'stok', 'tanggal_kadaluarsa')
                ->orderBy('tanggal_kadaluarsa', 'asc');

            // Periksa apakah filter tipe diberikan dan tidak kosong
            $query->when($request->filled('tipe_filter'), function ($query) use ($request) {
                return $query->where('tipe', $request->tipe_filter);
            });

            // Jika tipe filter kosong, tambahkan whereNull untuk tipe
            $query->when($request->tipe_filter === '', function ($query) {
                return $query->whereNull('tipe');
            });

            $obat = $query->get();

            return DataTables::of($obat)
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
        return view('obat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreObatRequest $request)
    {
        Obat::create($request->all());
        return redirect()->route('obat.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Obat $obat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateObatRequest $request, $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->update($request->all());
        return redirect()->route('obat.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $obat = Obat::findOrFail($id);
            $obat->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }
}
