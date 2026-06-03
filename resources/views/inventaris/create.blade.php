@extends('layouts.app')

@section('title', 'Tambah Inventaris')

@section('content')

    <h1>Tambah Inventaris Laboratorium</h1>

    <form method="POST" action="{{ route('inventaris.store') }}">

        @csrf

        @include('inventaris._form')

    </form>

@endsection