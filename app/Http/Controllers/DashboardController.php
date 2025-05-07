<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\ArsipObat;
use App\Models\JadwalPosyandu;
use App\Models\Obat;
use App\Models\OrangTua;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $orangTua = Auth::user()->orangTua;

        //total orang tua
        $totalOrangTua = OrangTua::count();

        //total orang tua aktif
        $totalOrangTuaAktif = OrangTua::whereHas('user', function ($query) {
            $query->where('is_active', 1);
        })->count();


        //total ibu hamil
        $totalIbuHamil = OrangTua::whereHas('kehamilans', function ($query) {
            $query->where('status_kehamilan', 'Hamil');
        })->count();

        //total anak
        $totalAnak = Anak::count();

        //total obat
        $totalObat = Obat::count();

        $today = Carbon::today();
        //total obat belum kadaluarsa
        // 1. Total obat belum kadaluarsa
        $totalBelumKadaluarsa = Obat::whereDate('tanggal_kadaluarsa', '>=', $today)->count();

        // 2. Obat kadaluarsa & belum diarsipkan (obat tidak punya relasi arsip)
        $totalKadaluarsaBelumArsip = Obat::whereDate('tanggal_kadaluarsa', '<', $today)
            ->whereDoesntHave('arsip')
            ->count();

        // 3. Obat yang sudah diarsipkan (hitung dari tabel arsip_obats)
        $totalSudahArsip = ArsipObat::count();

        // Cek jika orangTua ada dan ambil kehamilan dan anak
        $kehamilan = $orangTua ? $orangTua->kehamilans()->latest()->first() : null; // Ambil data kehamilan terbaru
        // Pastikan $anaks selalu koleksi kosong jika tidak ada data
        $anaks = $orangTua ? $orangTua->anak : collect(); // Ambil anak-anak atau koleksi kosong

        // Hitung usia tiap anak dan simpan dalam array
        $usiaAnaks = $anaks->map(function ($anak) {
            $tanggal_lahir = \Carbon\Carbon::parse($anak->tanggal_lahir_anak);
            $now = \Carbon\Carbon::now();

            // Hitung tahun
            $years = $tanggal_lahir->diffInYears($now);

            // Hitung sisa bulan setelah tahun
            $months = $tanggal_lahir->diffInMonths($now) % 12;

            // Tentukan format usia
            return $years > 0 ? "{$years} tahun {$months} bulan" : "{$months} bulan";
        });

        $jadwalTerdekat = JadwalPosyandu::whereDate('tanggal_kegiatan', '>=', $today)
            ->orderBy('tanggal_kegiatan')
            ->select('tanggal_kegiatan', 'nama_kegiatan', 'tempat_kegiatan', 'waktu_kegiatan')
            ->first();


        return view('home', compact('anaks', 'kehamilan', 'usiaAnaks', 'totalOrangTua', 'totalOrangTuaAktif', 'totalIbuHamil', 'totalAnak', 'totalObat', 'totalBelumKadaluarsa', 'totalKadaluarsaBelumArsip', 'totalSudahArsip', 'jadwalTerdekat'));
    }
}
