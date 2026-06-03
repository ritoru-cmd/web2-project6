<?php
namespace App\Services\Inventaris;
class InventarisRepository
{
    /**
     * Data sementara sebelum menggunakan database.
     * Pada pertemuan berikutnya, data ini dapat dipindahkan ke Model dan database.
     */
    private function data(): array
    {
        return [
            [
                'kode' => 'LAB-LPT-001',
                'nama' => 'Laptop Lenovo ThinkPad',
                'kategori' => 'Laptop',
                'lokasi' => 'Lab Komputer 1',
                'kondisi' => 'Baik',
                'tahun' => 2023,
                'jumlah' => 8,
                'harga' => 8500000,
            ],
            [
                'kode' => 'LAB-LPT-002',
                'nama' => 'Laptop Asus Vivobook',
                'kategori' => 'Laptop',
                'lokasi' => 'Lab Komputer 2',
                'kondisi' => 'Perlu Pengecekan',
                'tahun' => 2022,
                'jumlah' => 6,
                'harga' => 7200000,
            ],
            [
                'kode' => 'LAB-PRY-001',
                'nama' => 'Proyektor Epson EB-X500',
                'kategori' => 'Proyektor',
                'lokasi' => 'Ruang Teori 1',
                'kondisi' => 'Baik',
                'tahun' => 2021,
                'jumlah' => 2,
                'harga' => 6100000,
            ],
            [
                'kode' => 'LAB-PRN-001',
                'nama' => 'Printer Canon G-Series',
                'kategori' => 'Printer',
                'lokasi' => 'Ruang Administrasi Lab',
                'kondisi' => 'Baik',
                'tahun' => 2024,
                'jumlah' => 1,
                'harga' => 3500000,
            ],
            [
                'kode' => 'LAB-CAM-001',
                'nama' => 'Kamera Canon EOS',
                'kategori' => 'Kamera',
                'lokasi' => 'Studio Multimedia',
                'kondisi' => 'Baik',
                'tahun' => 2024,
                'jumlah' => 3,
                'harga' => 9500000,
            ],
        ];
    }
    public function all(): array
    {
        return $this->data();
    }
    public function findByKode(string $kode): ?array
    {
        foreach ($this->data() as $barang) {
            if ($barang['kode'] === $kode) {
                return $barang;
            }
        }
        return null;
    }
    public function filterByKategori(string $kategori): array
    {
        return array_values(array_filter($this->data(), function ($barang) use ($kategori) {
            return strtolower($barang['kategori']) === strtolower($kategori);
        }));
    }
    public function search(?string $keyword): array
    {
        if (!$keyword) {
            return $this->data();
        }
        return array_values(array_filter($this->data(), function ($barang) use ($keyword) {
            $keyword = strtolower($keyword);
            return str_contains(strtolower($barang['kode']), $keyword)
                || str_contains(strtolower($barang['nama']), $keyword)
                || str_contains(strtolower($barang['kategori']), $keyword)
                || str_contains(strtolower($barang['lokasi']), $keyword)
                || str_contains(strtolower($barang['kondisi']), $keyword);
        }));
    }
    public function summary(): array
    {
        $data = $this->data();
        $totalBarang = count($data);
        $totalUnit = 0;
        $totalNilaiAset = 0;
        $kategori = [];
        foreach ($data as $barang) {
            $totalUnit += $barang['jumlah'];
            $totalNilaiAset += $barang['jumlah'] * $barang['harga'];
            if (!isset($kategori[$barang['kategori']])) {
                $kategori[$barang['kategori']] = 0;
            }
            $kategori[$barang['kategori']] += $barang['jumlah'];
        }
        return [
            'total_barang' => $totalBarang,
            'total_unit' => $totalUnit,
            'total_nilai_aset' => $totalNilaiAset,
            'kategori' => $kategori,
        ];
    }
    public function barangTermahal(): array
    {
        $data = $this->data();

        usort($data, function ($a, $b) {
            return $b['harga'] <=> $a['harga'];
        });

        return $data[0];
    }
}
