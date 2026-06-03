<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inventaris Laboratorium</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 32px;
            background: #f8fafc;
            color: #0f172a;
        }

        .card {
            background: #ffffff;
            padding: 18px;
            border-radius: 12px;
            margin-bottom: 16px;
            border: 1px solid #e2e8f0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .number {
            font-size: 32px;
            font-weight: bold;
            margin: 0;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }

        ul {
            line-height: 1.8;
        }
    </style>
</head>

<body>
    <h1>Mini Dashboard Inventaris Laboratorium</h1>
    <p>Halaman ini menampilkan ringkasan data inventaris dari controller ke view Blade.</p>
    <div class="grid">
        <div class="card">
            <p>Total Jenis Barang</p>
            <p class="number">{{ $summary['total_barang'] }}</p>
        </div>
        <div class="card">
            <p>Total Unit</p>
            <p class="number">{{ $summary['total_unit'] }}</p>
        </div>
        <div class="card">
            <p>Total Nilai Aset</p>
            <p class="number">Rp {{ number_format($summary['total_nilai_aset'], 0, ',', '.') }}</p>
        </div>
    </div>
    <div class="card">
        <h2>Jumlah Unit per Kategori</h2>
        <ul>
            @foreach ($summary['kategori'] as $namaKategori => $jumlah)
                <li>
                    <a href="{{ route('inventaris.kategori', $namaKategori) }}">{{ $namaKategori }}</a>
                    : {{ $jumlah }} unit
                </li>
            @endforeach
        </ul>
    </div>
    <div class="card">
        <h2>Tentang unit</h2>

        <p>
            Total Kategori:
            <strong>{{ count($summary['kategori']) }}</strong>
        </p>

        <p>
            Barang Termahal:
            <strong>{{ $barangTermahal['nama'] }}</strong>
        </p>

        <p>
            Harga barang termahal:
            <strong>
                Rp {{ number_format($barangTermahal['harga'], 0, ',', '.') }}
            </strong>
        </p>
    </div>
    <p><a href="{{ route('inventaris.index') }}">Lihat daftar inventaris</a></p>
</body>

</html>