<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKunjunganRequest;
use App\Http\Requests\UpdateObatKunjunganRequest;
use App\Http\Requests\UpdatePemantauanTumbuhKembangRequest;
use App\Models\Anak;
use App\Models\Kunjungan;
use App\Models\KunjunganAnak;
use App\Models\KunjunganObat;
use App\Models\OrangTua;
use App\Models\PemantauanTumbuhKembangAnak;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $user = Auth::user();
            $query = DB::table('kunjungans')
                ->leftJoin('type_kunjungans', 'type_kunjungans.id', '=', 'kunjungans.tipe_kunjungan_id')
                ->leftJoin('orang_tuas', 'orang_tuas.id', '=', 'kunjungans.orang_tua_id')
                ->select('kunjungans.id', 'type_kunjungans.nama_tipe_kunjungan', 'kunjungans.tanggal_kunjungan', 'orang_tuas.nama_ayah', 'orang_tuas.nama_ibu');

            if ($user->hasRole('orang-tua')) {
                // Hanya ambil kunjungan untuk orang tua yang sesuai
                $query->leftJoin('users', 'users.id', '=', 'orang_tuas.user_id')
                    ->where('orang_tuas.user_id', $user->id);
            }

            // Menjalankan query dan mengembalikan data dengan DataTables
            $kunjungan = $query;

            return DataTables::of($kunjungan)
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

    public function showAnaliticsGrowthChildren($id)
    {
        // Mengambil kunjungan berdasarkan id
        $kunjungan = Kunjungan::with(['orang_tua', 'orang_tua.anak'])->findOrFail($id);

        // Mengambil data orang tua dan anak yang terkait dengan kunjungan, termasuk anak-anak yang terkait
        $orangTua = $kunjungan->orang_tua;

        // Mengambil data anak yang terkait dengan orang tua tersebut
        $anak = $orangTua->anak;

        // mengambil data obat
        $obat = DB::table('obats')->select('id', 'nama_obat_vitamin')->get();

        return view('kunjungan.analisis-tumbuh-kembang-anak', compact('kunjungan', 'anak', 'obat', 'orangTua'));
    }

    public function listPemantauanTumbuhKembangAnak(Request $request, $id)
    {
        if ($request->ajax()) {

            // Menemukan kunjungan berdasarkan ID
            $kunjungan = Kunjungan::findOrFail($id);

            // Memastikan bahwa ada data KunjunganAnak yang terkait
            $kunjunganAnaks = $kunjungan->kunjungan_anaks;

            // Jika tidak ada KunjunganAnak terkait, kembalikan response kosong
            if ($kunjunganAnaks->isEmpty()) {
                // Jika tidak ada KunjunganAnak terkait, kembalikan response kosong tanpa status 404
                return response()->json([
                    'message' => 'Tidak ada data KunjunganAnak untuk Kunjungan ini.',
                    'data' => [], // Mengirimkan data kosong
                ], 200); // Gunakan status 200 (OK)
            }

            // Mengambil data PemantauanTumbuhKembangAnak berdasarkan KunjunganAnak yang terkait
            // Gunakan eager loading untuk memuat anak
            $pemantauanTumbuhKembangAnak = PemantauanTumbuhKembangAnak::with('kunjunganAnak.anak')
                ->whereIn('kunjungan_anak_id', $kunjunganAnaks->pluck('id'))
                ->get();
            // dd($pemantauanTumbuhKembangAnak->toArray());


            // Jika data PemantauanTumbuhKembangAnak kosong, kembalikan data kosong
            if ($pemantauanTumbuhKembangAnak->isEmpty()) {
                return response()->json([
                    'message' => 'Tidak ada data Pemantauan Tumbuh Kembang Anak untuk Kunjungan ini.',
                    'data' => [], // Mengirimkan data kosong
                ], 200); // Gunakan status 200 (OK)
            }
            // dd($pemantauanTumbuhKembangAnak);

            // Mengembalikan data menggunakan DataTables
            return DataTables::of($pemantauanTumbuhKembangAnak)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function ListDataObatKunjungan(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $query = KunjunganObat::join('kunjungans', 'kunjungans.id', '=', 'kunjungan_obats.kunjungan_id')
                ->join('obats', 'obats.id', '=', 'kunjungan_obats.obat_id')
                ->join('kunjungan_anaks', 'kunjungan_anaks.id', '=', 'kunjungan_obats.kunjungan_anak_id') // Join ke kunjungan_anaks
                ->join('anaks', 'anaks.id', '=', 'kunjungan_anaks.anak_id') // Join ke anaks untuk nama anak
                ->select(
                    'kunjungan_obats.id',
                    'obats.nama_obat_vitamin',  // Ambil nama obat
                    'kunjungan_obats.jumlah_obat',  // Ambil jumlah obat
                    'anaks.nama_anak'  // Ambil nama anak
                );

            // Batasi akses berdasarkan peran jika user adalah orang tua
            if ($user->hasRole('orang-tua')) {
                $query->where('kunjungans.orang_tua_id', $user->id);  // Filter berdasarkan orang tua
            }

            // Menambahkan filter berdasarkan kunjungan ID
            $obatKunjungan = $query->where('kunjungan_obats.kunjungan_id', $id)->get();

            // Debugging data yang dikembalikan
            // dd($obatKunjungan);

            // Mengembalikan data menggunakan DataTables
            return DataTables::of($obatKunjungan)
                ->addIndexColumn()
                ->make(true);
        }
    }



    public function addGrowthChildren(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'anak_id' => 'required|array',
            'anak_id.*' => 'exists:anaks,id',
            'tinggi_badan' => 'required|array',
            'tinggi_badan.*' => 'numeric',
            'berat_badan' => 'required|array',
            'berat_badan.*' => 'numeric',
            'perkembangan_motorik' => 'required|array',
            'perkembangan_motorik.*' => 'string',
            'perkembangan_psikis' => 'required|array',
            'perkembangan_psikis.*' => 'string',
            'obat_id' => 'required|array',
            'obat_id.*' => 'array',
            'obat_id.*.*' => 'exists:obats,id',
            'jumlah_obat' => 'required|array',
            'jumlah_obat.*' => 'array',
            'jumlah_obat.*.*' => 'numeric',
        ]);

        // Mengkonversi tinggi_badan dan berat_badan jadi angka jika perlu
        $request->merge([
            'tinggi_badan' => array_map('intval', $request->tinggi_badan),
            'berat_badan' => array_map('intval', $request->berat_badan),
            'jumlah_obat' => array_map(function ($obat) {
                return array_map('intval', $obat);
            }, $request->jumlah_obat)
        ]);

        // Find the kunjungan record
        $kunjungan = Kunjungan::findOrFail($id);

        // Loop through each selected child
        foreach ($request->anak_id as $index => $anak_id) {
            // Create a KunjunganAnak entry
            $kunjunganAnak = KunjunganAnak::create([
                'kunjungan_id' => $id,
                'anak_id' => $anak_id
            ]);

            // Create the PemantauanTumbuhKembangAnak entry for this child
            $pemantauanTumbuhKembangAnak = PemantauanTumbuhKembangAnak::create([
                'kunjungan_anak_id' => $kunjunganAnak->id,
                'tinggi_badan' => $request->tinggi_badan[$index],
                'berat_badan' => $request->berat_badan[$index],
                'tanggal_pemantauan' => $kunjungan->tanggal_kunjungan,
                'perkembangan_motorik' => $request->perkembangan_motorik[$index],
                'perkembangan_psikis' => $request->perkembangan_psikis[$index]
            ]);

            // Proses obat untuk setiap anak
            $obatIds = $request->obat_id[$anak_id] ?? []; // Dapatkan daftar obat untuk anak
            foreach ($obatIds as $obatIndex => $obatId) {
                // Lock baris obat yang relevan untuk mencegah race condition
                $obat = DB::table('obats')
                    ->where('id', $obatId)
                    ->lockForUpdate() // Menggunakan locking untuk memastikan tidak ada perubahan pada stok
                    ->first();

                if (!$obat) {
                    // Jika obat tidak ditemukan
                    throw new \Exception("Obat tidak ditemukan.");
                }

                // Jika stok cukup, lanjutkan dengan pengurangan stok
                if ($obat->stok >= $request->jumlah_obat[$anak_id][$obatId]) {
                    // Kurangi stok jika cukup
                    DB::table('obats')->where('id', $obatId)
                        ->decrement('stok', $request->jumlah_obat[$anak_id][$obatId]);

                    // Create the KunjunganObat entry
                    KunjunganObat::create([
                        'kunjungan_id' => $kunjungan->id,
                        'kunjungan_anak_id' => $kunjunganAnak->id,
                        'obat_id' => $obatId,
                        'jumlah_obat' => $request->jumlah_obat[$anak_id][$obatId] // Ambil jumlah obat berdasarkan anak dan obat
                    ]);
                } else {
                    // Jika stok tidak cukup, rollback transaksi
                    DB::rollBack();
                    return redirect()->route('kunjungan.index')->with('error', 'Stok obat tidak mencukupi.');
                }
            }
        }

        // Redirect with success message
        return redirect()->route('kunjungan.index')->with('success', 'Data anak berhasil disimpan');
    }

    public function showFormEditPemantauanTumbuhKembang($id)
    {
        $pemantauanTumbuhKembangAnak = PemantauanTumbuhKembangAnak::findOrFail($id);
        return view('kunjungan.edit-pemantauan-tumbuh-kembang', compact('pemantauanTumbuhKembangAnak'));
    }

    public function updatePemantauanTumbuhKembang(UpdatePemantauanTumbuhKembangRequest $request, $id)
    {
        $pemantauanTumbuhKembangAnak = PemantauanTumbuhKembangAnak::findOrFail($id);

        // Update data langsung pakai validated data
        $pemantauanTumbuhKembangAnak->update($request->validated());

        return redirect()->route('kunjungan.index')->with('success', 'Data anak berhasil diupdate');
    }

    public function destroyPemantauanTumbuhKembang($id)
    {
        //mulai transaksi
        DB::beginTransaction();
        try {
            $pemantauanTumbuhKembangAnak = PemantauanTumbuhKembangAnak::findOrFail($id);
            $pemantauanTumbuhKembangAnak->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }

    public function showFormEditObatKunjungan($id)
    {
        $kunjunganObat = KunjunganObat::findOrFail($id);
        $obat = DB::table('obats')->select('id', 'nama_obat_vitamin')->get();
        return view('kunjungan.edit-obat-kunjungan', compact('kunjunganObat', 'obat'));
    }

    public function updateObatKunjungan(UpdateObatKunjunganRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            // dd($request->all());
            // Ambil data kunjungan_obat
            $kunjunganObat = KunjunganObat::findOrFail($id);
            // dd($kunjunganObat);

            // Ambil data dari request yang sudah tervalidasi
            $obatLamaId = $kunjunganObat->obat_id;
            $obatBaruId = $request->input('obat_id');
            $jumlahLama = $kunjunganObat->jumlah_obat;
            $jumlahBaru = $request->input('jumlah_obat');

            // dd($obatLamaId, $obatBaruId, $jumlahLama, $jumlahBaru);

            // Jika ganti obat, kembalikan stok obat lama dulu
            if ($obatLamaId != $obatBaruId) {
                // Lock kedua obat, baik obat lama maupun obat baru
                $obatLama = DB::table('obats')->where('id', $obatLamaId)->lockForUpdate()->first();
                $obatBaru = DB::table('obats')->where('id', $obatBaruId)->lockForUpdate()->first();

                if (!$obatBaru) {
                    throw new \Exception("Obat baru tidak ditemukan.");
                }

                // Kembalikan stok obat lama
                DB::table('obats')->where('id', $obatLamaId)
                    ->increment('stok', $jumlahLama);

                // Cek stok cukup di obat baru
                if ($obatBaru->stok < $jumlahBaru) {
                    throw new \Exception("Stok obat baru tidak mencukupi.");
                }

                // Kurangi stok obat baru
                DB::table('obats')->where('id', $obatBaruId)
                    ->decrement('stok', $jumlahBaru);
            } else {
                // Jika obat sama, tinggal hitung selisih
                $obat = DB::table('obats')->where('id', $obatLamaId)->lockForUpdate()->first();
                $selisih = $jumlahBaru - $jumlahLama;
                // dd($obat, $selisih);
                if ($selisih > 0) {
                    if ($obat->stok < $selisih) {
                        throw new \Exception("Stok obat tidak mencukupi.");
                    }

                    DB::table('obats')->where('id', $obatLamaId)
                        ->decrement('stok', $selisih);
                } elseif ($selisih < 0) {
                    DB::table('obats')->where('id', $obatLamaId)
                        ->increment('stok', abs($selisih));
                }
            }

            // Update data kunjungan_obat
            $kunjunganObat->update([
                'obat_id' => $obatBaruId,
                'jumlah_obat' => $jumlahBaru
            ]);
            // dd($kunjunganObat);

            DB::commit();
            return redirect()->route('kunjungan.pantauan-tumbuh-kembang-anak', ['id' => $kunjunganObat->kunjungan_id])
                ->with('success', 'Data obat berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Update gagal: ' . $e->getMessage());
        }
    }

    public function destroyObatKunjungan($id)
    {
        DB::beginTransaction();

        try {
            $kunjunganObat = KunjunganObat::findOrFail($id);

            // Lock baris obat untuk mencegah race condition
            $obat = DB::table('obats')
                ->where('id', $kunjunganObat->obat_id)
                ->lockForUpdate()
                ->first();

            if (!$obat) {
                throw new \Exception('Obat tidak ditemukan');
            }

            // Tambahkan kembali stok
            DB::table('obats')->where('id', $kunjunganObat->obat_id)
                ->increment('stok', $kunjunganObat->jumlah_obat);

            // Hapus kunjungan_obat
            $kunjunganObat->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
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
