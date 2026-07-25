<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
                    'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($this->user_id),
        ],
            'password' => 'nullable|min:8',
            'role_id' => 'required',
            'is_active' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Wajib Diisi',
            'name.max' => 'Maksimal Panjang nama 100 karakter.',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Format Email tidak Valid.',
            'password.min' => 'Password minimal :min karakter',
            'role.required' => 'Role wajib diisi.'
        ];
    }
}
