<?php
namespace App\Services\Inventaris;
class ProyektorLab extends BarangLab
{
    private int $lumens;
    private string $resolusi;
    public function __construct(
        string $kode,
        string $nama,
        string $kondisi,
        int $tahunPengadaan,
        int $lumens,
        string $resolusi,
        bool $aktif = true
    ) {
        parent::__construct($kode, $nama, $kondisi, $tahunPengadaan, $aktif);
        $this->lumens = $lumens;
        $this->resolusi = $resolusi;
    }
    public function getKategori(): string
    {
        return 'Proyektor';
    }
    public function getSpesifikasiUtama(): string
    {
        return $this->lumens . ' lumens, ' . $this->resolusi;
    }
    public function cekKelayakanRuangan(): string
    {
        if ($this->lumens >= 3000 && $this->kondisi === 'Bagus') {
            return 'Terang untuk ruang kelas standar';
        }

        return 'Perlu pengecekan lampu sebelum digunakan';
    }
    public function toArray(): array
    {
        $data = parent::toArray();
        $data['keterangan'] = $this->cekKelayakanRuangan();
        return $data;
    }
}