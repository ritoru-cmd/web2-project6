<?php
namespace App\Services\Inventaris;
class InventarisHelper
{
    public static function hitungTotalAktif(array $daftarBarang): int
    {
        $total = 0;
        foreach ($daftarBarang as $barang) {
            if ($barang->isAktif()) {
                $total++;
            }
        }
        return $total;
    }
    public static function hitungKategori(array $daftarBarang, string $kategori): int
    {
        $total = 0;

        foreach ($daftarBarang as $barang) {

            if ($barang->getKategori() === $kategori) {
                $total++;
            }

        }

        return $total;
    }
}
