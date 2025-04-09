<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJadwalPosyanduRequest;
use App\Http\Requests\UpdateJadwalPosyanduRequest;
use App\Models\JadwalPosyandu;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JadwalPosyanduController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:jadwal-posyandu.index')->only('index', 'list');
        $this->middleware('permission:jadwal-posyandu.create')->only('create', 'store');
        $this->middleware('permission:jadwal-posyandu.edit')->only('edit', 'update');
        $this->middleware('permission:jadwal-posyandu.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $jadwalPosyandu = DB::table('jadwal_posyandus')->select('id', 'nama_kegiatan', 'tanggal_kegiatan', 'waktu_kegiatan', 'tempat_kegiatan')
                ->orderBy('tanggal_kegiatan', 'asc') // Sort by date (earliest first)
                ->orderBy('waktu_kegiatan', 'asc')   // If dates are the same, sort by time
                ->get();
            return DataTables::of($jadwalPosyandu)
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
        return view('jadwal-posyandu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwal-posyandu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJadwalPosyanduRequest $request)
    {
        $jadwalPosyandu = JadwalPosyandu::where('tanggal_kegiatan', $request->tanggal_kegiatan)->where('waktu_kegiatan', $request->waktu_kegiatan)->first();
        if ($jadwalPosyandu) {
            return redirect()->route('jadwal-posyandu.create')->with('error', 'Jadwal posyandu untuk tanggal dan waktu tersebut sudah ada');
        }
        JadwalPosyandu::create($request->all());
        return redirect()->route('jadwal-posyandu.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalPosyandu $jadwalPosyandu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jadwalPosyandu = JadwalPosyandu::findOrFail($id);
        return view('jadwal-posyandu.edit', compact('jadwalPosyandu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJadwalPosyanduRequest $request, $id)
    {
        $jadwalPosyandu = JadwalPosyandu::findOrFail($id);

        // Check for duplicate jadwal (date and time)
        $jadwalPosyanduDuplicate = JadwalPosyandu::where('tanggal_kegiatan', $request->tanggal_kegiatan)
            ->where('waktu_kegiatan', $request->waktu_kegiatan)
            ->where('id', '!=', $id) // Exclude the current record from the check
            ->first();

        if ($jadwalPosyanduDuplicate) {
            return redirect()->route('jadwal-posyandu.edit', $id)
                ->with('error', 'Jadwal posyandu untuk tanggal dan waktu tersebut sudah ada');
        }
        $jadwalPosyandu->update($request->all());
        return redirect()->route('jadwal-posyandu.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // mulai transaksi
        DB::beginTransaction();
        try {
            $jadwalPosyandu = JadwalPosyandu::findOrFail($id);
            $jadwalPosyandu->delete();
            DB::commit();
            // return json
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }
}
