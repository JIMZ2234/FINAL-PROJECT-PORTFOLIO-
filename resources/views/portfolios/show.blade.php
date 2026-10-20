@extends('layouts.app')
@section('title', $portfolio->full_name)
@section('content')
<div class="d-flex flex-wrap gap-2 mb-3 align-items-center">
    <a href="{{ route('portfolios.index') }}" class="btn btn-outline-secondary btn-sm">Manage</a>
    <a href="{{ route('portfolios.edit', $portfolio) }}" class="btn btn-outline-primary btn-sm">Edit</a>
    <a href="{{ route('portfolios.templates', $portfolio) }}" class="btn btn-outline-secondary btn-sm">Change Template</a>
    @if($tpl != $portfolio->template)
        <form method="POST" action="{{ route('portfolios.select', $portfolio) }}">
            @csrf
            <input type="hidden" name="template" value="{{ $tpl }}">
            <button class="btn btn-primary btn-sm">Use this template</button>
        </form>
    @endif
    <span class="badge text-bg-secondary ms-auto">Template {{ $tpl }}</span>
</div>

{{-- Generated portfolio keeps its own light design in both modes --}}
<div data-bs-theme="light">
    @include('templates.' . [1 => 'simple', 2 => 'modern', 3 => 'creative'][$tpl])
</div>
@endsection