@extends('layouts.app')
@section('title', 'Choose Template')
@section('content')
@php
    $opts = [
        1 => ['Simple',   'Clean and professional single-column layout.', '#ffffff', '#212529'],
        2 => ['Modern',   'Cards, sections and visual elements.',         '#0d6efd', '#ffffff'],
        3 => ['Creative', 'Sidebar and timeline arrangement.',            '#6f42c1', '#ffffff'],
    ];
@endphp
<h2>Choose a Template</h2>
<p class="text-muted">Portfolio of {{ $portfolio->full_name }}</p>

<div class="row g-4">
    @foreach($opts as $n => [$name, $desc, $bg, $fg])
        <div class="col-md-4">
            <div class="card h-100 shadow-sm {{ $portfolio->template == $n ? 'border-primary border-2' : '' }}">
                <div class="d-flex align-items-center justify-content-center"
                     style="height:140px;background:{{ $bg }};color:{{ $fg }};border-bottom:1px solid #ddd;border-radius:16px 16px 0 0">
                    <h3 class="m-0">{{ $name }}</h3>
                </div>
                <div class="card-body">
                    <h5>Template {{ $n }} - {{ $name }}</h5>
                    <p class="text-muted mb-0">{{ $desc }}</p>
                </div>
                <div class="card-footer bg-transparent d-flex gap-2">
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('portfolios.show', [$portfolio, 'template' => $n]) }}">Preview</a>
                    <form method="POST" action="{{ route('portfolios.select', $portfolio) }}">
                        @csrf
                        <input type="hidden" name="template" value="{{ $n }}">
                        <button class="btn btn-primary btn-sm">Use this template</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection