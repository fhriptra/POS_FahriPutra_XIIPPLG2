<?php

namespace App\Http\Requests\JenisProduk;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => [
                'required',
                'string',
                'max:255',
                // abaikan nama milik record yg sedang diedit sendiri
                Rule::unique('jenis_produk', 'nama')->ignore($this->route('jeni')?->id),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama jenis wajib diisi.',
            'nama.unique'   => 'Jenis produk dengan nama ini sudah ada.',
        ];
    }
}
