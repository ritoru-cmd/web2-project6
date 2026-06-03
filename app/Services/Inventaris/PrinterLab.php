<?php

namespace App\Services\Inventaris;

class PrinterLab extends BarangLab
{
    private string $merek;
    private string $tipePrinter;
    private string $statusTinta;


public function __construct(
    string $kode,
    string $nama,
    string $kondisi,
    int $tahunPengadaan,
    string $merek,
    string $tipePrinter,
    string $statusTinta,
    bool $aktif = true
)
{
    parent::__construct(
        $kode,
        $nama,
        $kondisi,
        $tahunPengadaan,
        $aktif
    );

    $this->merek = $merek;
    $this->tipePrinter = $tipePrinter;
    $this->statusTinta = $statusTinta;
}
public function getKategori(): string
{
    return 'Printer';
}

public function getSpesifikasiUtama(): string
{
    return $this->merek . ' - ' . $this->tipePrinter;
}
public function cekKetersediaanTinta(): string
{
    if ($this->statusTinta === 'Penuh') {
        return 'Siap cetak';
    }

    return 'Perlu isi ulang tinta';
}
public function toArray(): array
{
    $data = parent::toArray();

    $data['keterangan'] = $this->cekKetersediaanTinta();

    return $data;
}
}