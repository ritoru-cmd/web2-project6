@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

    <h1>Edit Kategori</h1>

    <form method="POST" action="{{ route('kategori.update', $kategori) }}">

        @csrf
        @method('PUT')

        @include('kategori._form')

    </form>

@endsection