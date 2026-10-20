@extends('layouts.app')
@section('title', 'Edit Portfolio')
@section('content')
<h2 class="mb-3">Edit Portfolio</h2>
<form method="POST" action="{{ route('portfolios.update', $portfolio) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('portfolios._form')
</form>
@endsection