<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeluargaBerencanaRequest extends FormRequest
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
            'orang_tua_id' => 'required|exists:orang_tuas,id',
            'kategori_keluarga_berencana_id' => 'required|exists:kategori_keluarga_berencanas,id',
            'tanggal_mulai_keluarga_berencana' => 'required|date',
            'catatan_keluarga_berencana' => 'required|string',
            'is_active' => 'required|in:Active,Non-Active',
            'is_permanent' => 'required|in:0,1',
            'tanggal_selesai_keluarga_berencana' => 'nullable|date',
        ];
    }
}
