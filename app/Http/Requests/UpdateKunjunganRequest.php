<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKunjunganRequest extends FormRequest
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
            'tanggal_kunjungan' => 'required|date',
            'deskripsi_kunjungan' => 'required',
            'tipe_kunjungan_id' => 'required|exists:type_kunjungans,id',
            'orang_tua_id' => 'required|exists:orang_tuas,id',
        ];
    }
}
