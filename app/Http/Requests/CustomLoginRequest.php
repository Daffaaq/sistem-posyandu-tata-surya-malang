<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomLoginRequest extends FormRequest
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
            'email' => ['required', 'email', 'exists:users,email'], // Custom email validation
            'password' => ['required', 'string', 'min:8'], // Custom password validation
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email address is required.',
            'email.exists' => 'This email is not registered.',
            'password.required' => 'The password field is required.',
            'password.min' => 'Password should be at least 8 characters long.',
        ];
    }
}
