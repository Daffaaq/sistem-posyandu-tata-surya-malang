<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKunjunganRequest;
use App\Models\Kunjungan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kunjungan.index')->only('index', 'list');
        $this->middleware('permission:kunjungan.create')->only('create', 'store');
        $this->middleware('permission:kunjungan.edit')->only('edit', 'update');
        $this->middleware('permission:kunjungan.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $kunjungan = DB::table('kunjungans')
                ->leftJoin('type_kunjungans', 'type_kunjungans.id', '=', 'kunjungans.tipe_kunjungan_id')
                ->leftJoin('orang_tuas', 'orang_tuas.id', '=', 'kunjungans.orang_tua_id')
                ->select('kunjungans.id', 'type_kunjungans.nama_tipe_kunjungan', 'kunjungans.tanggal_kunjungan', 'orang_tuas.nama_ayah', 'orang_tuas.nama_ibu');
            return DataTables::of($kunjungan)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kunjungan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataOrangTua = DB::table('orang_tuas')->select('id', 'nama_ayah', 'nama_ibu')->get();
        $dataTipeKunjungan = DB::table('type_kunjungans')->select('id', 'nama_tipe_kunjungan')->get();
        return view('kunjungan.create', compact('dataOrangTua', 'dataTipeKunjungan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKunjunganRequest $request)
    {
        Kunjungan::create($request->all());
        return redirect()->route('kunjungan.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kunjungan $kunjungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kunjungan $kunjungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kunjungan $kunjungan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kunjungan $kunjungan)
    {
        //
    }
}
