@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

    <h1>Tambah Kategori</h1>

    <form method="POST" action="{{ route('kategori.store') }}">

        @csrf
        
        <input type="hidden" name="return" value="{{ request('return') }}">

        @include('kategori._form')

    </form>

@endsection