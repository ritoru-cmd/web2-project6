<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

    protected $fillable = [
        'kategori_id',
        'kode_barang',
        'nama_barang',
        'merek',
        'lokasi',
        'kondisi_id',
        'jumlah',
        'tanggal_pengadaan',
        'keterangan',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class);
    }
}