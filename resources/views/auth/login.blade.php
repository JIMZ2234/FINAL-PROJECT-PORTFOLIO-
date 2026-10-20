@extends('layouts.app')
@section('title', 'Log In')
@section('content')
<div class="card mx-auto my-4" style="max-width: 440px;">
    <div class="card-body p-4 p-md-5">
        <h2 class="fw-bold mb-1">Welcome back</h2>
        <p class="text-muted mb-4">Log in to manage your portfolios.</p>

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input id="email" type="email" name="email" class="form-control"
                       value="{{ old('email') }}" required autofocus autocomplete="email">
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control"
                       required autocomplete="current-password">
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button class="btn btn-primary w-100 btn-lg">Log In</button>
        </form>

        <p class="text-center mt-4 mb-0 small">
            No account yet? <a href="{{ route('register') }}">Create one</a>
        </p>
    </div>
</div>
@endsection