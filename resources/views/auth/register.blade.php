@extends('layouts.app')
@section('title', 'Create Account')
@section('content')
<div class="card mx-auto my-4" style="max-width: 480px;">
    <div class="card-body p-4 p-md-5">
        <h2 class="fw-bold mb-1">Create an account</h2>
        <p class="text-muted mb-4">Sign up to build and save your portfolios.</p>

        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul></div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="name">Full Name</label>
                <input id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name">
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="email">
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
                <div class="form-text">At least 8 characters.</div>
            </div>
            <div class="mb-4">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
            </div>
            <button class="btn btn-primary w-100 btn-lg">Create Account</button>
        </form>

        <p class="text-center mt-4 mb-0 small">
            Already have an account? <a href="{{ route('login') }}">Log in</a>
        </p>
    </div>
</div>
@endsection