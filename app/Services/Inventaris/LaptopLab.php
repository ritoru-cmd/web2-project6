<?php
namespace App\Services\Inventaris;
class LaptopLab extends BarangLab
{
    private string $processor;
    private int $ramGb;
    public function __construct(
        string $kode,
        string $nama,
        string $kondisi,
        int $tahunPengadaan,
        string $processor,
        int $ramGb,

        bool $aktif = true
    ) {
        parent::__construct($kode, $nama, $kondisi, $tahunPengadaan, $aktif);
        $this->processor = $processor;
        $this->ramGb = $ramGb;
    }
    public function getKategori(): string
    {
        return 'Laptop';
    }
    public function getSpesifikasiUtama(): string
    {
        return $this->processor . ', RAM ' . $this->ramGb . ' GB';
    }
    public function cekKelayakanPraktikum(): string
    {
        if ($this->ramGb >= 16 && $this->kondisi === 'Bagus') {
            return 'Layak untuk Laravel, VS Code, dan browser';
        }
        return 'Masih dapat digunakan, disarankan upgrade RAM/SSD';
    }
    public function toArray(): array
    {
        $data = parent::toArray();
        $data['keterangan'] = $this->cekKelayakanPraktikum();
        return $data;
    }
}