@extends('layouts.app')

@section('title', 'login')

@section('content')
<div class="card">
    <h1>Login Sistem Inventaris Lab</h1>
    <form method="POST" action="{{route('login.process')}}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" value="{{old('email')}}">

        @error('email')
            <div class="alert-eror">
                {{$message}}
            </div>
        @enderror
        <div class="col-12">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        @error('password')
            <div class="alert-eror">
                {{$message}}
            </div>
        @enderror
        <button class="btn btn-primary" style="margin-top: 10px;" type="submit">Login</button>
    </form>
</div>
@endsection