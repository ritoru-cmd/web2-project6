@extends('layouts.app')

@section('title', 'Detail Inventaris')

@section('content')

    <h1>Detail Inventaris</h1>

    <table>
        <tr>
            <th>Kode Barang</th>
            <td>{{ $item->kode_barang }}</td>
        </tr>

        <tr>
            <th>Nama Barang</th>
            <td>{{ $item->nama_barang }}</td>
        </tr>

        <tr>
            <th>Kategori</th>
            <td>{{ $item->kategori->nama }}</td>
        </tr>

        <tr>
            <th>Merek</th>
            <td>{{ $item->merek ?? '-' }}</td>
        </tr>

        <tr>
            <th>Lokasi</th>
            <td>{{ $item->lokasi }}</td>
        </tr>

        <tr>
            <th>Kondisi</th>
            <td>{{ $item->kondisi->nama ?? '-' }}</td>
        </tr>

        <tr>
            <th>Jumlah</th>
            <td>{{ $item->jumlah }}</td>
        </tr>

        <tr>
            <th>Tanggal Pengadaan</th>
            <td>{{ $item->tanggal_pengadaan ?? '-' }}</td>
        </tr>

        <tr>
            <th>Keterangan</th>
            <td>{{ $item->keterangan ?? '-' }}</td>
        </tr>
    </table>

    <p>
        @auth
        @if (auth()->user()->role === 'admin')
        <a class="btn btn-warning" href="{{ route('inventaris.edit', $item) }}">
            Edit
        </a>
        @else
        <button class="btn btn-warning" onclick="alert('Fitur ini hanya dapat diakses Admin')">
            Edit 🔒
        </button>
        @endif
        @endauth
        <a class="btn btn-secondary" href="{{ route('inventaris.index') }}">
            Kembali
        </a>
    </p>

@endsection