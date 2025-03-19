<?php

namespace App\Actions\Fortify;

use App\Models\Anak;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        // Validasi input
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'nama_ayah' => ['required', 'string', 'max:255'],
            'nama_ibu' => ['required', 'string', 'max:255'],
            'tanggal_lahir_ayah' => ['required', 'date'],
            'tanggal_lahir_ibu' => ['required', 'date'],
            'no_telepon_ayah' => ['required', 'string', 'max:255'],
            'no_telepon_ibu' => ['required', 'string', 'max:255'],
            'email_ayah' => ['required', 'email'],
            'email_ibu' => ['required', 'email'],
            'pekerjaan_ayah' => ['required', 'string', 'max:255'],
            'pekerjaan_ibu' => ['required', 'string', 'max:255'],
            'agama_ayah' => ['required', 'string', 'max:255'],
            'agama_ibu' => ['required', 'string', 'max:255'],
            'alamat_ayah' => ['required', 'string', 'max:255'],
            'alamat_ibu' => ['required', 'string', 'max:255'],
        ])->validate();

        // Membuat user
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'is_active' => 'non-active', // User dibuat tidak aktif
        ]);

        // Membuat data orang tua
        $orangTua = OrangTua::create([
            'nama_ayah' => $input['nama_ayah'],
            'jenis_kelamin_ayah' => 'Laki-laki', // Laki-laki sudah tetap
            'tanggal_lahir_ayah' => $input['tanggal_lahir_ayah'],
            'no_telepon_ayah' => $input['no_telepon_ayah'],
            'email_ayah' => $input['email_ayah'],
            'pekerjaan_ayah' => $input['pekerjaan_ayah'],
            'agama_ayah' => $input['agama_ayah'],
            'alamat_ayah' => $input['alamat_ayah'],

            'nama_ibu' => $input['nama_ibu'],
            'jenis_kelamin_ibu' => 'Perempuan', // Perempuan sudah tetap
            'tanggal_lahir_ibu' => $input['tanggal_lahir_ibu'],
            'no_telepon_ibu' => $input['no_telepon_ibu'],
            'email_ibu' => $input['email_ibu'],
            'pekerjaan_ibu' => $input['pekerjaan_ibu'],
            'agama_ibu' => $input['agama_ibu'],
            'alamat_ibu' => $input['alamat_ibu'],

            'user_id' => $user->id
        ]);
        // Mengembalikan objek user yang baru dibuat
        return redirect()->route('register.success')->with('success', 'thank you for registering');
    }
}
