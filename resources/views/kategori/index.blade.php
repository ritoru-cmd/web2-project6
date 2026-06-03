@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')

    <h1>Data Kategori</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <p>
        <a class="btn" href="{{ route('kategori.create') }}">
            + Tambah Kategori
        </a>
    </p>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($kategoris as $kategori)

                <tr>

                    <td>{{ $kategori->id }}</td>
                    <td>{{ $kategori->kode }}</td>
                    <td>{{ $kategori->nama }}</td>

                    <td>

                        <a class="btn btn-secondary" href="{{ route('kategori.show', $kategori) }}">
                            Detail
                        </a>

                        <a class="btn btn-warning" href="{{ route('kategori.edit', $kategori) }}">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('kategori.destroy', $kategori) }}" style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger" onclick="return confirm('Hapus kategori ini?')">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4">
                        Belum ada data kategori.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <div style="margin-top:20px;">
        {{ $kategoris->links() }}
    </div>

@endsection