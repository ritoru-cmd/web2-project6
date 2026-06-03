<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode' => 'LPT',
                'nama' => 'Laptop'
            ],
            [
                'kode' => 'PRJ',
                'nama' => 'Proyektor'
            ],
            [
                'kode' => 'JRG',
                'nama' => 'Perangkat Jaringan'
            ],
            [
                'kode' => 'AKS',
                'nama' => 'Aksesoris Lab'
            ]
        ];

        foreach ($data as $item) {
            Kategori::updateOrCreate(
                ['kode' => $item['kode']],
                $item
            );
        }
    }
}