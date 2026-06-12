<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_kategori' => ['required', 'string', 'max:255'],
            'tipe_layanan' => ['required', 'string', 'in:Residential,Komersial,Kustom'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
            'tipe_layanan.required' => 'Tipe layanan wajib dipilih.',
            'tipe_layanan.in' => 'Tipe layanan harus berupa Residential, Komersial, atau Kustom.',
        ];
    }
}
