<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKehamilanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // kehamilan
            'orang_tua_id' => 'required|exists:orang_tuas,id',
            'tanggal_mulai_kehamilan' => 'required|date',
            'prediksi_tanggal_lahir' => 'required|date',
            'status_kehamilan' => 'required',

            // PemeriksaanKehamilan
            'tanggal_pemeriksaan_kehamilan' => 'nullable|date',
            'deskripsi_pemeriksaan_kehamilan' => 'nullable|required_with:tanggal_pemeriksaan_kehamilan|string',
            'keluhan_kehamilan' => 'nullable|string',
            'tekanan_darah_ibu_hamil' => 'nullable|required_with:tanggal_pemeriksaan_kehamilan|string',
            'berat_badan_ibu_hamil' => 'nullable|required_with:tanggal_pemeriksaan_kehamilan|numeric|min:30|max:10000',
            'posisi_janin' => 'nullable|required_with:tanggal_pemeriksaan_kehamilan|string',
            'usia_kandungan' => 'nullable|required_with:tanggal_pemeriksaan_kehamilan|numeric|min:1|max:42',
        ];
    }
}
