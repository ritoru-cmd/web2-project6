@extends('layouts.app')

@section('title', 'Data Inventaris Laboratorium')

@section('content')

    <h1>Data Inventaris Laboratorium</h1>
    <p>
        Halaman ini menampilkan data inventaris dari database menggunakan
        Model Eloquent dan relasi kategori.
    </p>
    <div style="
                    display:grid;
                    grid-template-columns:repeat(4,1fr);
                    gap:15px;
                    margin:20px 0;
                    ">

        <div class="card">
            <h3>Total</h3>
            <h2>{{ $totalInventaris }}</h2>
        </div>

        <div class="card">
            <h3>🟢 Baik</h3>
            <h2>{{ $totalBaik }}</h2>
        </div>

        <div class="card">
            <h3>🟡 Ringan</h3>
            <h2>{{ $totalRingan }}</h2>
        </div>

        <div class="card">
            <h3>🔴 Berat</h3>
            <h2>{{ $totalBerat }}</h2>
        </div>

    </div>


    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="filter" method="GET" action="{{ route('inventaris.index') }}">

        <div>
            <label>Cari Data</label>

            <input type="text" name="q" value="{{ request('q') }}" placeholder="Kode, nama barang, atau lokasi">
        </div>

        <div>
            <label>Kategori</label>

            <select name="kategori_id" onchange="this.form.submit()">
                <option value="">Semua</option>

                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" @selected(request('kategori_id') == $kategori->id)>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Kondisi</label>

            <select name="kondisi_id" onchange="this.form.submit()">

                <option value="">
                    Semua
                </option>

                @foreach ($kondisis as $kondisi)

                    <option value="{{ $kondisi->id }}" @selected(request('kondisi_id') == $kondisi->id)>

                        {{ $kondisi->nama }}

                    </option>

                @endforeach

            </select>
        </div>

        <div>
            <button class="btn" type="submit">
                Filter
            </button>
        </div>

    </form>
    @auth
    @if (auth()->user()->role === 'admin')
    <p style="margin-top:20px;">
        <a class="btn" href="{{ route('inventaris.create') }}">
            + Tambah Barang
        </a>
    </p>
    @else
    <p style="margin-top:20px;">
        <button class="btn" onclick="alert('Fitur ini hanya dapat diakses Admin')">
            + Tambah Barang 🔒
        </button>
    </p>
    @endif
    @endauth

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($inventaris as $item)

                <tr>

                    <td>{{ $item->kode_barang }}</td>

                    <td>
                        {{ $item->nama_barang }}
                        <br>
                        <small>{{ $item->merek ?? '-' }}</small>
                    </td>

                    <td>{{ $item->kategori->nama }}</td>

                    <td>{{ $item->lokasi }}</td>

                    <td>@if(($item->kondisi->nama ?? '') == 'Baik')

                        <span class="badge badge-success">
                            🟢 Baik
                        </span>

                    @elseif(($item->kondisi->nama ?? '') == 'Rusak Ringan')

                            <span class="badge badge-warning">
                                🟡 Rusak Ringan
                            </span>

                        @else

                            <span class="badge badge-danger">
                                🔴 Rusak Berat
                            </span>

                        @endif
                    </td>

                    <td>{{ $item->jumlah }}</td>

                    <td>

                        <div class="actions">

                            <a class="btn btn-secondary" href="{{ route('inventaris.show', $item) }}">
                                Detail
                            </a>
                            @if (auth()->user()->role === 'admin')
                                <a class="btn btn-warning" href="{{ route('inventaris.edit', $item) }}">
                                    Edit
                                </a>
                            @else
                                <button type="button" class="btn btn-warning"
                                    onclick="alert('Fitur ini hanya dapat diakses Admin')">
                                    Edit 🔒
                                </button>
                            @endif
                            @if (auth()->user()->role === 'admin')
                                <form method="POST" action="{{ route('inventaris.destroy', $item) }}"
                                    onsubmit="return confirm('Hapus data ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger" type="submit">
                                        Hapus
                                    </button>

                                </form>
                            @else
                                <button type="button" class="btn btn-danger" onclick="alert('Fitur ini hanya dapat diakses Admin')">
                                    Hapus 🔒
                                </button>
                            @endif

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7">
                        Data inventaris belum tersedia.
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>

    <div style="margin-top:20px;">
        {{ $inventaris->links() }}
    </div>

@endsection