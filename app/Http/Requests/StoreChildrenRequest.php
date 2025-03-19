<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChildrenRequest extends FormRequest
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
            'children' => 'required|array', // 'children' must be an array
            'children.*.nama_anak' => 'required|string|max:255', // Validates the 'nama_anak' for each child
            'children.*.jenis_kelamin_anak' => 'required|in:Laki-laki,Perempuan', // Validates gender
            'children.*.tanggal_lahir_anak' => 'required|date', // Validates the date of birth
        ];
    }
}
