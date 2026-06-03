<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInventarisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $inventari = $this->route('inventari');

        return [
            'kategori_id' => 'required|exists:kategoris,id',

            'kode_barang' => [
                'required',
                'max:30',
                Rule::unique('inventaris', 'kode_barang')
                    ->ignore($inventari?->id),
            ],

            'nama_barang' => 'required|min:3|max:150',
            'merek' => 'nullable|max:100',
            'lokasi' => 'required|max:100',
            'kondisi_id' => 'required|exists:kondisis,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengadaan' => 'nullable|date|before_or_equal:today',
            'keterangan' => 'nullable|max:1000',
        ];
    }
}