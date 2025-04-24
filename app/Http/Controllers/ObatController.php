<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObatRequest;
use App\Http\Requests\UpdateObatRequest;
use App\Models\ArsipObat;
use App\Models\Obat;
use Carbon\Carbon;
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
                ->where('tanggal_kadaluarsa', '>', Carbon::now()->format('Y-m-d'))
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

    public function list2(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('obats')
                ->select('id', 'nama_obat_vitamin', 'tipe', 'stok', 'tanggal_kadaluarsa')
                ->orderBy('tanggal_kadaluarsa', 'asc')
                ->where('tanggal_kadaluarsa', '<=', now()); // 👈 HANYA YANG SUDAH KADALUARSA

            // Filter berdasarkan tipe kalau diisi
            $query->when($request->filled('tipe_filter'), function ($query) use ($request) {
                return $query->where('tipe', $request->tipe_filter);
            });

            // Jika tipe kosong, ambil yang `tipe`-nya NULL
            $query->when($request->tipe_filter === '', function ($query) {
                return $query->whereNull('tipe');
            });

            $obat = $query->get();

            return DataTables::of($obat)
                ->addIndexColumn()
                ->make(true);
        }

        return response()->json(['message' => 'Method not allowed'], 405);
    }

    public function listArsipObat(Request $request)
    {
        // Ambil data arsip obat
        $arsipObats = ArsipObat::with('obat')->get();

        // Jika request menggunakan ajax (misalnya DataTables)
        if ($request->ajax()) {
            return DataTables::of($arsipObats)
                ->addIndexColumn()
                ->addColumn('nama_obat', function ($row) {
                    return $row->obat->nama_obat_vitamin;
                })
                ->addColumn('tipe', function ($row) {
                    return $row->obat->tipe;
                })
                ->addColumn('stok', function ($row) {
                    return $row->obat->stok;
                })
                ->addColumn('tanggal_kadaluarsa', function ($row) {
                    return $row->obat->tanggal_kadaluarsa;
                })
                ->addColumn('tanggal_arsip_obat', function ($row) {
                    return $row->tanggal_arsip_obat;
                })
                ->make(true);
        }
        return response()->json(['message' => 'Method not allowed'], 405);
    }

    private function checkAccess($roles)
    {
        // Cek apakah user sudah login dan memiliki salah satu role yang sesuai
        if (!auth()->check() || !auth()->user()->hasAnyRole($roles)) {
            return response()->json(['success' => false, 'message' => 'Anda tidak memiliki izin untuk mengakses fitur ini.'], 403);
        }

        return true; // Jika role sesuai, lanjutkan eksekusi
    }


    public function arsipkanSemuaObatKadaluarsa()
    {
        // Panggil fungsi checkAccess untuk memeriksa role
        $accessCheck = $this->checkAccess(['super-admin', 'admin', 'petugas']);

        // Jika checkAccess mengembalikan response error, kembalikan langsung
        if ($accessCheck !== true) {
            return $accessCheck;
        }

        DB::beginTransaction(); // Mulai transaksi

        try {
            // Ambil semua obat yang kadaluarsa dan belum diarsipkan
            $obats = DB::table('obats')
                ->where('tanggal_kadaluarsa', '<=', now())
                ->whereNotIn('id', ArsipObat::pluck('obat_id'))
                ->get();

            if ($obats->isEmpty()) {
                return response()->json([
                    'status' => 'info',
                    'code' => 'already_archived',
                    'message' => 'Semua obat kadaluarsa sudah diarsipkan.'
                ], 400); // Bisa pakai 200 kalau bukan error logic
            }


            foreach ($obats as $obat) {
                // Simpan ke arsip
                ArsipObat::create([
                    'obat_id' => $obat->id,
                    'tanggal_arsip_obat' => now(),
                    'user_id' => auth()->user()->id
                ]);
            }

            DB::commit(); // Commit transaksi jika berhasil
            return response()->json(['success' => true, 'message' => 'Semua Obat Kadaluarsa berhasil diarsipkan'], 200);
        } catch (\Exception $e) {
            DB::rollback(); // Rollback jika ada error
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function arsipkanSatuObat(Request $request, $id)
    {
        // Panggil fungsi checkAccess untuk memeriksa role
        $accessCheck = $this->checkAccess(['super-admin', 'admin', 'petugas']);

        // Jika checkAccess mengembalikan response error, kembalikan langsung
        if ($accessCheck !== true) {
            return $accessCheck;
        }

        DB::beginTransaction(); // Mulai transaksi

        try {
            // Cek apakah obat ada
            $obat = Obat::findOrFail($id);

            // Cek kadaluarsa
            if ($obat->tanggal_kadaluarsa > now()) {
                return response()->json([
                    'status' => 'warning',
                    'code' => 'not_expired',
                    'message' => 'Obat belum kadaluarsa.'
                ], 400);
            }


            if (ArsipObat::where('obat_id', $id)->exists()) {
                return response()->json([
                    'status' => 'info',
                    'code' => 'already_archived',
                    'message' => 'Obat sudah diarsipkan.'
                ], 400);
            }


            // Simpan obat ke arsip
            ArsipObat::create([
                'obat_id' => $obat->id,
                'tanggal_arsip_obat' => now(),
                'user_id' => auth()->user()->id
            ]);

            DB::commit(); // Commit transaksi jika berhasil
            return response()->json(['success' => true, 'message' => 'Obat Kadaluarsa berhasil diarsipkan'], 200);
        } catch (\Exception $e) {
            DB::rollback(); // Rollback jika ada error
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function unarchiveObat($id)
    {
        // Cek akses role
        $accessCheck = $this->checkAccess(['super-admin', 'admin', 'petugas']);
        if ($accessCheck !== true) return $accessCheck;

        try {
            // Ambil arsip
            $arsip = ArsipObat::findOrFail($id);

            // Hitung jumlah arsip tersisa
            $totalArsip = ArsipObat::count();

            if ($totalArsip <= 1) {
                // Kalau sisa 1, truncate sekalian
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::table('arsip_obats')->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                return response()->json([
                    'success' => true,
                    'message' => 'Obat berhasil dipulihkan dan tabel arsip dikosongkan (truncate).'
                ]);
            } else {
                // Kalau lebih dari 1, hapus biasa
                $arsip->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Obat berhasil dipulihkan dari arsip.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
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
