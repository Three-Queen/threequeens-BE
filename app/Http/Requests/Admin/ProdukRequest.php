<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_produk'      => ['required', 'string', 'max:255'],
            'deskripsi_produk' => ['nullable', 'string'],
            'harga_produk'     => ['nullable', 'numeric', 'min:0'],
            'gambar_produk'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'desain_produk_3d' => ['nullable', 'file', 'mimes:pdf,dwg,skp,3ds,obj,fbx,zip,glb,gltf', 'max:51200'],
            'desain_produk_2d' => ['nullable', 'file', 'extensions:pdf,dwg,jpg,jpeg,png,zip', 'max:51200'],
            'pengerjaan_produk'=> ['nullable', 'string'],
            'kategori_id'      => ['required', 'exists:kategori_interior,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_produk.required'   => 'Nama produk wajib diisi.',
            'gambar_produk.image'    => 'File gambar harus berupa gambar.',
            'gambar_produk.max'      => 'Ukuran gambar maksimal 5 MB.',
            'desain_produk_3d.max'   => 'Ukuran file 3D maksimal 50 MB.',
            'desain_produk_2d.max'   => 'Ukuran file 2D maksimal 50 MB.',
            'harga_produk.numeric'   => 'Harga harus berupa angka.',
            'kategori_id.required'   => 'Kategori wajib dipilih.',
            'kategori_id.exists'     => 'Kategori tidak valid.',
        ];
    }
}
