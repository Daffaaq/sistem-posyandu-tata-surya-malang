<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrangTuaRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'tanggal_lahir_ayah' => 'required|date',
            'tanggal_lahir_ibu' => 'required|date',
            'no_telepon_ayah' => 'required|string|max:255',
            'no_telepon_ibu' => 'required|string|max:255',
            'email_ayah' => 'required|email',
            'email_ibu' => 'required|email',
            'pekerjaan_ayah' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'agama_ayah' => 'required|string|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'agama_ibu' => 'required|string|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'alamat_ayah' => 'required|string|max:255',
            'alamat_ibu' => 'required|string|max:255',
        ];
    }
}
