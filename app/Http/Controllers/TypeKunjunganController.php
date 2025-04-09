<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeKunjunganRequest;
use App\Http\Requests\UpdateTypeKunjunganRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\TypeKunjungan;
use Illuminate\Http\Request;

class TypeKunjunganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:tipe-kunjungan.index')->only('index', 'list');
        $this->middleware('permission:tipe-kunjungan.create')->only('create', 'store');
        $this->middleware('permission:tipe-kunjungan.edit')->only('edit', 'update');
        $this->middleware('permission:tipe-kunjungan.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $tipeKunjungan = DB::table('type_kunjungans')->select('nama_tipe_kunjungan', 'id', 'deskripsi')->get();
            return DataTables::of($tipeKunjungan)
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
        return view('tipe-kunjungan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipe-kunjungan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeKunjunganRequest $request)
    {
        // dd($request->all());
        TypeKunjungan::create($request->all());
        return redirect()->route('tipe-kunjungan.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeKunjungan $typeKunjungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipekunjungan = TypeKunjungan::findOrFail($id);
        return view('tipe-kunjungan.edit', compact('tipekunjungan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeKunjunganRequest $request, $id)
    {
        $tipekunjungan = TypeKunjungan::findOrFail($id);
        $tipekunjungan->update($request->all());
        return redirect()->route('tipe-kunjungan.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //mulai transaksi
        DB::beginTransaction();
        try {
            $tipekunjungan = TypeKunjungan::findOrFail($id);
            $tipekunjungan->delete();
            DB::commit();
            //return json
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }
}
