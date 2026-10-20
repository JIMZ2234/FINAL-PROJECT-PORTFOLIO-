@extends('layouts.app')
@section('title', 'Manage Portfolios')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Manage Portfolios</h2>
    <a href="{{ route('portfolios.create') }}" class="btn btn-primary">+ Create Portfolio</a>
</div>

@if($portfolios->isEmpty())
    <div class="alert alert-info">No portfolios yet. Click "Create Portfolio" to start.</div>
@else
<div class="card"><div class="table-responsive">
<table class="table align-middle mb-0">
    <thead><tr><th>Name</th><th>Email</th><th>Template</th><th>Updated</th><th class="text-end">Actions</th></tr></thead>
    <tbody>
    @foreach($portfolios as $p)
        <tr>
            <td>{{ $p->full_name }}</td>
            <td>{{ $p->email }}</td>
            <td>Template {{ $p->template }}</td>
            <td>{{ $p->updated_at->format('M d, Y') }}</td>
            <td class="text-end">
                <a href="{{ route('portfolios.show', $p) }}" class="btn btn-sm btn-outline-success">View</a>
                <a href="{{ route('portfolios.edit', $p) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <a href="{{ route('portfolios.templates', $p) }}" class="btn btn-sm btn-outline-secondary">Template</a>
                <form method="POST" action="{{ route('portfolios.destroy', $p) }}" class="d-inline"
                      onsubmit="return confirm('Delete this portfolio permanently?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div></div>
@endif
@endsection