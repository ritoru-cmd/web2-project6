@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')

    <h1>Detail Kategori</h1>

    <table>
        <tr>
            <th>ID</th>
            <td>{{ $kategori->id }}</td>
        </tr>

        <tr>
            <th>Kode</th>
            <td>{{ $kategori->kode }}</td>
        </tr>

        <tr>
            <th>Nama</th>
            <td>{{ $kategori->nama }}</td>
        </tr>
    </table>

    <p>
        <a class="btn" href="{{ route('kategori.edit', $kategori) }}">
            Edit
        </a>

        <a class="btn btn-secondary" href="{{ route('kategori.index') }}">
            Kembali
        </a>
    </p>

@endsection