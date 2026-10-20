@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="card text-center mx-auto my-4" style="max-width: 820px;">
    <div class="card-body p-4 p-md-5">
        <h1 class="display-5 fw-bold mb-3"
            style="background:linear-gradient(90deg,#4f46e5,#db2777);-webkit-background-clip:text;background-clip:text;color:transparent;">
            Online Portfolio Template Generator
        </h1>
        <p class="lead text-muted mx-auto mb-4" style="max-width: 560px;">
            Enter your information once, save it online, pick one of three templates,
            and generate your own portfolio in seconds.
        </p>
        @auth
            <a href="{{ route('portfolios.create') }}" class="btn btn-primary btn-lg px-4">Create Portfolio</a>
            <a href="{{ route('portfolios.index') }}" class="btn btn-outline-secondary btn-lg px-4">Manage Portfolios</a>
        @else
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4">Get Started</a>
            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg px-4">Log In</a>
        @endauth

        <div class="row g-3 mt-4 text-start">
            <div class="col-md-4"><div class="p-3 rounded-3 bg-body-tertiary h-100"><strong>1. Enter</strong><br><small class="text-muted">Fill in your details, skills and projects.</small></div></div>
            <div class="col-md-4"><div class="p-3 rounded-3 bg-body-tertiary h-100"><strong>2. Choose</strong><br><small class="text-muted">Pick Simple, Modern or Creative.</small></div></div>
            <div class="col-md-4"><div class="p-3 rounded-3 bg-body-tertiary h-100"><strong>3. Generate</strong><br><small class="text-muted">Preview, edit or delete anytime.</small></div></div>
        </div>
    </div>
</div>
@endsection