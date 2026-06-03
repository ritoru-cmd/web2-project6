<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'kategori_id' => 'required|exists:kategoris,id',
            'kode_barang' => 'required|max:30|unique:inventaris,kode_barang',
            'nama_barang' => 'required|min:3|max:150',
            'merek' => 'nullable|max:100',
            'lokasi' => 'required|max:100',
            'kondisi_id' => 'required|exists:kondisis,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengadaan' => 'nullable|date|before_or_equal:today',
            'keterangan' => 'nullable|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'kode_barang.unique' => 'Kode barang sudah digunakan.',
            'nama_barang.min' => 'Nama barang minimal 3 karakter.',
            'jumlah.min' => 'Jumlah minimal 1.',
            'tanggal_pengadaan.before_or_equal'
            => 'Tanggal tidak boleh melebihi hari ini.',
        ];
    }
}