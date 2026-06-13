<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PortofolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_proyek' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'exists:kategori_interior,id'],
            'produk_ids' => ['nullable', 'array'],
            'produk_ids.*' => ['exists:interior_produk,id'],
            'deskripsi' => ['nullable', 'string'],
            'lokasi' => ['required', 'string', 'max:255'],
            'lokasi_google_maps' => ['nullable', 'string', 'max:500'],
            'dokumentasi_proyek' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:10240'],
            'galeri' => ['nullable', 'array'],
            'galeri.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:10240'],
            'waktu_proyek' => ['nullable', 'string', 'max:100'],
            'durasi_pengerjaan' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_proyek.required' => 'Nama proyek wajib diisi.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'dokumentasi_proyek.image' => 'File dokumentasi harus berupa gambar.',
            'dokumentasi_proyek.max' => 'Ukuran gambar maksimal 10 MB.',
        ];
    }
}
