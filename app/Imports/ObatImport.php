<?php

namespace App\Imports;

use App\Models\Obat;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ObatImport implements ToModel, WithHeadingRow
{
    // Tentukan format tanggal yang digunakan dalam file Excel
    public function dateFormat(): string
    {
        return 'Y-m-d'; // Atur format tanggal sesuai yang diinginkan
    }

    public function model(array $row)
    {
        // Menggunakan \Carbon\Carbon::instance untuk mengonversi tanggal dari Excel
        if (is_numeric($row['tanggal_kadaluarsa'])) {
            $row['tanggal_kadaluarsa'] = Carbon::instance(Date::excelToDateTimeObject($row['tanggal_kadaluarsa']))->format('Y-m-d');
        }

        // Mengambil semua nama obat yang sudah ada di database dan mengonversinya ke lowercase
        $existingObatNames = Obat::all()->pluck('nama_obat_vitamin')->map(function ($item) {
            return strtolower(trim($item)); // Mengonversi setiap nama obat ke lowercase
        });

        // Normalisasi nama obat dari excel (konversi ke lowercase dan trim spasi)
        $normalizedNamaObat = strtolower(trim($row['nama_obat_vitamin']));

        // Mengecek apakah nama obat yang akan diimpor sudah ada dalam database (dalam format lowercase)
        if ($existingObatNames->contains($normalizedNamaObat)) {
            return null; // Jika sudah ada, skip data ini
        }

        // Jika belum ada, simpan data baru ke dalam database dengan nama obat tetap menggunakan format asli
        return new Obat([
            'nama_obat_vitamin'   => $row['nama_obat_vitamin'], // Nama obat tetap disimpan dengan format aslinya
            'tipe'                => $row['tipe'], // harus 'obat' atau 'vitamin'
            'deskripsi'           => $row['deskripsi'],
            'stok'                => $row['stok'],
            'tanggal_kadaluarsa'  => $row['tanggal_kadaluarsa'],
        ]);
    }
}
