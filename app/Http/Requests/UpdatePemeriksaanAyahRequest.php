<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePemeriksaanAyahRequest extends FormRequest
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
            'tekanan_darah_ayah' => 'required|string',
            'gula_darah_ayah' => 'required|numeric',
            'kolesterol_ayah' => 'required|numeric',
            'catatan_kesehatan_ayah' => 'required|string',
            'tanggal_pemeriksaan_lanjutan_ayah' => 'required|date',
        ];
    }
}
