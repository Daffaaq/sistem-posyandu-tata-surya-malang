<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePemeriksaanOrangTuaRequest;
use App\Http\Requests\UpdatePemeriksaanAyahRequest;
use App\Http\Requests\UpdatePemeriksaanIbuRequest;
use App\Models\Kunjungan;
use App\Models\PemeriksaanOrangTua;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemeriksaanOrangTuaController extends Controller
{
    public function showAnaliticsParent($id)
    {
        $kunjungan = Kunjungan::with(['orang_tua'])->findOrFail($id);
        return view('kunjungan.analisis-pemeriksaan-orang-tua', compact('kunjungan'));
    }

    // public function listAnaliticsFather(Request $request, $id)
    // {
    //     if ($request->ajax()) {
    //         $user = Auth::user();

    //         $query = DB::table('pemeriksaan_orang_tuas')
    //             ->join('kunjungans', 'kunjungans.id', '=', 'pemeriksaan_orang_tuas.kunjungan_id')
    //             ->join('orang_tuas', 'orang_tuas.id', '=', 'kunjungans.orang_tua_id')
    //             ->select('pemeriksaan_orang_tuas.id as pemeriksaan_id', 'orang_tuas.nama_ayah', 'tanggal_pemeriksaan_ayah');

    //         // Batasi akses berdasarkan peran jika user adalah orang tua
    //         if ($user->hasRole('orang-tua')) {
    //             $query->where('kunjungans.orang_tua_id', $user->id);  // Filter berdasarkan orang tua
    //         }

    //         // Menambahkan filter berdasarkan kunjungan ID
    //         $pemeriksaanOrangTua = $query->where('pemeriksaan_orang_tuas.kunjungan_id', $id)->get();

    //         return DataTables::of($pemeriksaanOrangTua)
    //             ->addIndexColumn()
    //             ->make(true);
    //     }

    //     // jika bukan response ajax maka return 405
    //     return response()->json(['message' => 'Method not allowed'], 405);
    // }

    // public function listAnaliticsMother(Request $request, $id)
    // {
    //     if ($request->ajax()) {
    //         $user = Auth::user();

    //         $query = DB::table('pemeriksaan_orang_tuas')
    //             ->join('kunjungans', 'kunjungans.id', '=', 'pemeriksaan_orang_tuas.kunjungan_id')
    //             ->join('orang_tuas', 'orang_tuas.id', '=', 'kunjungans.orang_tua_id')
    //             ->select('pemeriksaan_orang_tuas.id as pemeriksaan_id', 'orang_tuas.nama_ibu', 'tanggal_pemeriksaan_ibu');

    //         // Batasi akses berdasarkan peran jika user adalah orang tua
    //         if ($user->hasRole('orang-tua')) {
    //             $query->where('kunjungans.orang_tua_id', $user->id);  // Filter berdasarkan orang tua
    //         }

    //         // Menambahkan filter berdasarkan kunjungan ID
    //         $pemeriksaanOrangTua = $query->where('pemeriksaan_orang_tuas.kunjungan_id', $id)->get();
    //         // dd($pemeriksaanOrangTua);

    //         return DataTables::of($pemeriksaanOrangTua)
    //             ->addIndexColumn()
    //             ->make(true);
    //     }

    //     // jika bukan response ajax maka return 405
    //     return response()->json(['message' => 'Method not allowed'], 405);
    // }

    public function listAnalyticsParent(Request $request, $id, $type)
    {
        if (!$request->ajax()) {
            return response()->json(['message' => 'Method not allowed'], 405);
        }

        $user = Auth::user();

        // Validasi $type agar hanya bisa 'ayah' atau 'ibu'
        if (!in_array($type, ['ayah', 'ibu'])) {
            return response()->json(['message' => 'Invalid type parameter'], 400);
        }

        // Siapkan nama kolom dinamis
        $namaKolom = $type === 'ayah' ? 'orang_tuas.nama_ayah' : 'orang_tuas.nama_ibu';
        $tanggalKolom = $type === 'ayah' ? 'tanggal_pemeriksaan_ayah' : 'tanggal_pemeriksaan_ibu';

        $query = DB::table('pemeriksaan_orang_tuas')
            ->join('kunjungans', 'kunjungans.id', '=', 'pemeriksaan_orang_tuas.kunjungan_id')
            ->join('orang_tuas', 'orang_tuas.id', '=', 'kunjungans.orang_tua_id')
            ->select(
                'pemeriksaan_orang_tuas.id as pemeriksaan_id',
                DB::raw("$namaKolom as nama"),
                DB::raw("$tanggalKolom as tanggal_pemeriksaan")
            );

        // Batasi akses untuk orang tua
        if ($user->hasRole('orang-tua')) {
            $query->where('kunjungans.orang_tua_id', $user->id);
        }

        $data = $query->where('pemeriksaan_orang_tuas.kunjungan_id', $id)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }


    public function storePemeriksaanOrangTua(StorePemeriksaanOrangTuaRequest $request, $id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $data = $request->validated();

        // Cek apakah ayah tidak diperiksa
        if (!$request->has('periksa_ayah')) {
            $data['tekanan_darah_ayah'] = 'Tidak Melakukan Pemeriksaan';
            $data['gula_darah_ayah'] = 'Tidak Melakukan Pemeriksaan';
            $data['kolesterol_ayah'] = 'Tidak Melakukan Pemeriksaan';
            $data['catatan_kesehatan_ayah'] = 'Tidak Melakukan Pemeriksaan';
            $data['tanggal_pemeriksaan_ayah'] = null;
            $data['tanggal_pemeriksaan_lanjutan_ayah'] = $data['tanggal_pemeriksaan_lanjutan_ibu'] ?? null;
        } else {
            // kalau diperiksa, ambil dari tanggal kunjungan
            $data['tanggal_pemeriksaan_ayah'] = $kunjungan->tanggal_kunjungan;
        }

        // Cek apakah ibu tidak diperiksa
        if (!$request->has('periksa_ibu')) {
            $data['tekanan_darah_ibu'] = 'Tidak Melakukan Pemeriksaan';
            $data['gula_darah_ibu'] = 'Tidak Melakukan Pemeriksaan';
            $data['kolesterol_ibu'] = 'Tidak Melakukan Pemeriksaan';
            $data['catatan_kesehatan_ibu'] = 'Tidak Melakukan Pemeriksaan';
            $data['tanggal_pemeriksaan_ibu'] = null;
            $data['tanggal_pemeriksaan_lanjutan_ibu'] = $data['tanggal_pemeriksaan_lanjutan_ayah'] ?? null;
        } else {
            $data['tanggal_pemeriksaan_ibu'] = $kunjungan->tanggal_kunjungan;
        }

        $data['kunjungan_id'] = $kunjungan->id;
        $data['orang_tua_id'] = $kunjungan->orang_tua_id;

        PemeriksaanOrangTua::create($data);

        return redirect()->route('kunjungan.pantauan-orang-tua', ['id' => $id])
            ->with('success', 'Pemeriksaan Orang Tua Berhasil Ditambahkan');
    }

    public function showDataPemantauanAyah($id)
    {
        $pemeriksaanOrangTua = PemeriksaanOrangTua::select('tekanan_darah_ayah', 'gula_darah_ayah', 'kolesterol_ayah', 'catatan_kesehatan_ayah', 'tanggal_pemeriksaan_ayah', 'tanggal_pemeriksaan_lanjutan_ayah')
            ->findOrFail($id);


        return view('kunjungan.data-pemantauan-ayah', compact('pemeriksaanOrangTua'));
    }

    public function showDataPemantauanIbu($id)
    {
        $pemeriksaanOrangTua = PemeriksaanOrangTua::select(
            'tekanan_darah_ibu',
            'gula_darah_ibu',
            'kolesterol_ibu',
            'catatan_kesehatan_ibu',
            'tanggal_pemeriksaan_ibu',
            'tanggal_pemeriksaan_lanjutan_ibu'
        )
            ->findOrFail($id); // findOrFail tetap dipakai untuk memastikan record ditemukan


        return view('kunjungan.data-pemantauan-ibu', compact('pemeriksaanOrangTua'));
    }

    public function editDataPemeriksaanAyah($id)
    {
        $pemeriksaanAyah = PemeriksaanOrangTua::select('id', 'tekanan_darah_ayah', 'gula_darah_ayah', 'kolesterol_ayah', 'catatan_kesehatan_ayah', 'tanggal_pemeriksaan_ayah', 'tanggal_pemeriksaan_lanjutan_ayah', 'kunjungan_id')->findOrFail($id);

        return view('kunjungan.edit-pemeriksaan-ayah', compact('pemeriksaanAyah'));
    }

    public function editDataPemeriksaanIbu($id)
    {
        $pemeriksaanIbu = PemeriksaanOrangTua::select('id', 'tekanan_darah_ibu', 'gula_darah_ibu', 'kolesterol_ibu', 'catatan_kesehatan_ibu', 'tanggal_pemeriksaan_ibu', 'tanggal_pemeriksaan_lanjutan_ibu', 'kunjungan_id')->findOrFail($id);

        return view('kunjungan.edit-pemeriksaan-ibu', compact('pemeriksaanIbu'));
    }

    public function updateDataPemeriksaanAyah(UpdatePemeriksaanAyahRequest $request, $id)
    {
        $pemeriksaanAyah = PemeriksaanOrangTua::findOrFail($id);

        $pemeriksaanAyah->update($request->all());

        return redirect()->route('kunjungan.pantauan-orang-tua', ['id' => $pemeriksaanAyah->kunjungan_id])
            ->with('success', 'Pemeriksaan Orang Tua Berhasil Diubah');
    }

    public function updateDataPemeriksaanIbu(UpdatePemeriksaanIbuRequest $request, $id)
    {
        $pemeriksaanIbu = PemeriksaanOrangTua::findOrFail($id);

        $pemeriksaanIbu->update($request->all());

        return redirect()->route('kunjungan.pantauan-orang-tua', ['id' => $pemeriksaanIbu->kunjungan_id])
            ->with('success', 'Pemeriksaan Orang Tua Berhasil Diubah');
    }
}
