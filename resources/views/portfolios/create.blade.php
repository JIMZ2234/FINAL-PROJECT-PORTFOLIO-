@extends('layouts.app')
@section('title', 'Create Portfolio')
@section('content')
<h2 class="mb-3">Create Portfolio</h2>
<form method="POST" action="{{ route('portfolios.store') }}" enctype="multipart/form-data">
    @csrf
    @include('portfolios._form')
</form>
@endsection