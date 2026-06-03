<?php
namespace App\Services\Inventaris;
abstract class BarangLab
{
    private string $kode;
    protected string $nama;
    protected string $kondisi;
    protected int $tahunPengadaan;
    protected bool $aktif;
    public function __construct(
        string $kode,
        string $nama,
        string $kondisi,
        int $tahunPengadaan,
        bool $aktif = true
    ) {
        $this->kode = $kode;
        $this->nama = $nama;
        $this->setKondisi($kondisi);
        $this->tahunPengadaan = $tahunPengadaan;
        $this->aktif = $aktif;
    }

    public function getKode(): string
    {
        return $this->kode;
    }
    public function getNama(): string
    {
        return $this->nama;
    }
    public function getKondisi(): string
    {
        return $this->kondisi;
    }
    public function setKondisi(string $kondisi): void
    {
        $daftarKondisi = ['Bagus', 'Perlu Perawatan', 'Rusak'];
        if (!in_array($kondisi, $daftarKondisi)) {
            $kondisi = 'Perlu Perawatan';
        }
        $this->kondisi = $kondisi;
    }
    public function getUsiaPenggunaan(): int
    {
        return (int) date('Y') - $this->tahunPengadaan;
    }
    public function getKategoriUsia(): string
    {
        $usia = $this->getUsiaPenggunaan();

        if ($usia <= 5) {
            return 'Baru';
        }

        return 'Lama';
    }
    public function isAktif(): bool
    {
        return $this->aktif;
    }
    abstract public function getKategori(): string;
    abstract public function getSpesifikasiUtama(): string;
    public function toArray(): array
    {
        return [
            'kategori' => $this->getKategori(),
            'kode' => $this->getKode(),
            'nama' => $this->getNama(),
            'kondisi' => $this->getKondisi(),
            'usia' => $this->getUsiaPenggunaan() . ' tahun',
            'kategori_usia' => $this->getKategoriUsia(),
            'spesifikasi' => $this->getSpesifikasiUtama(),
        ];
    }
}
