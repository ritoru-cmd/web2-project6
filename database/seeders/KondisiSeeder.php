<?php

namespace Database\Seeders;

use App\Models\Kondisi;
use Illuminate\Database\Seeder;

class KondisiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Baik'],
            ['nama' => 'Rusak Ringan'],
            ['nama' => 'Rusak Berat'],
        ];

        foreach ($data as $item) {
            Kondisi::updateOrCreate(
                ['nama' => $item['nama']],
                $item
            );
        }
    }
}