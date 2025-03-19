<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJadwalPosyanduRequest extends FormRequest
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
            'nama_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|date|date_format:Y-m-d', // Validate date in Y-m-d format
            'waktu_kegiatan' => 'required|date_format:H:i', // Validate time in H:i format (24-hour clock)
            'tempat_kegiatan' => 'required|string',
        ];
    }
}
