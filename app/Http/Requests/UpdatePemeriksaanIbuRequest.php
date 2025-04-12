<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePemeriksaanIbuRequest extends FormRequest
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
            'tekanan_darah_ibu' => 'required|string',
            'gula_darah_ibu' => 'required|numeric',
            'kolesterol_ibu' => 'required|numeric',
            'catatan_kesehatan_ibu' => 'required|string',
            'tanggal_pemeriksaan_lanjutan_ibu' => 'required|date',
        ];
    }
}
