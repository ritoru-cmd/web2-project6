<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Kategori {{ $kategori }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 32px;
            color: #0f172a;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 16px;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #e2e8f0;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h1>Inventaris Kategori: {{ $kategori }}</h1>
    <p>
        Jumlah Data:
        <strong>{{ count($dataInventaris) }}</strong>
    </p>

    <p>
        Total Unit:
        <strong>
            {{ collect($dataInventaris)->sum('jumlah') }}
        </strong>
    </p>
    <p>
        Total Nilai Perangkat Di Kategori Ini:

        <strong>
            Rp {{ number_format(
    collect($dataInventaris)->sum(function ($barang) {
        return $barang['jumlah'] * $barang['harga'];
    }),
    0,
    ',',
    '.'
) }}
        </strong>
    </p>
    <form method="GET">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kode, nama, lokasi...">

        <button type="submit">
            Cari
        </button>
    </form>
    @if (request('q'))
        <p>
            Hasil pencarian untuk:
            <strong>{{ request('q') }}</strong>
        </p>
    @endif
    <p><a href="{{ route('inventaris.dashboard') }}">Kembali ke Dashboard</a> | <a
            href="{{ route('inventaris.index') }}">Daftar Semua
            Inventaris</a></p>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse (
                    collect($dataInventaris)->filter(function ($barang) {

                        $keyword = strtolower(request('q'));

                        if (!$keyword) {
                            return true;
                        }

                        return
                            str_contains(strtolower($barang['kode']), $keyword)
                            || str_contains(strtolower($barang['nama']), $keyword)
                            || str_contains(strtolower($barang['lokasi']), $keyword)
                            || str_contains(strtolower($barang['kondisi']), $keyword);

                    }) as $barang
                )
                                    <tr>
                                        <td>{{ $barang['kode'] }}</td>
                                        <td>{{ $barang['nama'] }}</td>
                                        <td>{{ $barang['lokasi'] }}</td>
                                        <td>{{ $barang['kondisi'] }}</td>
                                        <td>{{ $barang['jumlah'] }} unit</td>
                                        <td><a href="{{ route('inventaris.show', $barang['kode']) }}">Detail</a></td>
                                    </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data untuk kategori ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>