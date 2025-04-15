<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class ImunisasiController extends Controller
{
    public function indexImunisasi($id)
    {
        $kunjungan = Kunjungan::with(['orang_tua', 'orang_tua.anak', 'kunjungan_anaks'])->findOrFail($id);
        if ($kunjungan->kunjungan_anaks->isEmpty()) {
            return redirect()->route('kunjungan.index')->with('status', 'Belum ada data Kunjungan anak.');
        }

        return view('imunisasi.index', compact('kunjungan'));
    }
}
