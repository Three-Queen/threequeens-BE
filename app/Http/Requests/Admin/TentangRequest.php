<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TentangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'     => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'visi'      => ['nullable', 'string'],
            'misi'      => ['nullable', 'string'],
            'gambar1'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'gambar2'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'gambar1.image'  => 'Gambar 1 harus berupa gambar.',
            'gambar1.max'    => 'Ukuran Gambar 1 maksimal 5 MB.',
            'gambar2.image'  => 'Gambar 2 harus berupa gambar.',
            'gambar2.max'    => 'Ukuran Gambar 2 maksimal 5 MB.',
        ];
    }
}
