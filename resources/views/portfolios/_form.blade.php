@php $p = $portfolio ?? null; @endphp

@if($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul></div>
@endif

<div class="card mb-4">
    <div class="card-header fw-semibold">Personal Information</div>
    <div class="card-body row g-3">
        <div class="col-md-6">
            <label class="form-label">Full Name *</label>
            <input name="full_name" class="form-control" value="{{ old('full_name', $p->full_name ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Profile Picture (max 1MB)</label>
            <input type="file" name="profile_picture" accept="image/*" class="form-control">
            @if($p && $p->profile_picture)
                <img src="{{ $p->profile_picture }}" alt="Current" class="mt-2 rounded" style="height:60px">
            @endif
        </div>
        <div class="col-md-6">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $p->email ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Contact Number *</label>
            <input name="contact_number" class="form-control" value="{{ old('contact_number', $p->contact_number ?? '') }}" required>
        </div>
        <div class="col-12">
            <label class="form-label">Address *</label>
            <input name="address" class="form-control" value="{{ old('address', $p->address ?? '') }}" required>
        </div>
        <div class="col-12">
            <label class="form-label">About Me *</label>
            <textarea name="about" rows="4" class="form-control" required>{{ old('about', $p->about ?? '') }}</textarea>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header fw-semibold">Education</div>
    <div class="card-body">
        <textarea name="education" rows="3" class="form-control" placeholder="BS Information Technology | Cebu Technological University | 2022-2026">{{ old('education', $p->education ?? '') }}</textarea>
        <div class="form-text">One per line: Degree | School | Year</div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header fw-semibold">Skills</div>
    <div class="card-body">
        <textarea name="skills" rows="2" class="form-control" placeholder="PHP, Laravel, MySQL, HTML, CSS">{{ old('skills', $p->skills ?? '') }}</textarea>
        <div class="form-text">Separate with commas.</div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header fw-semibold">Projects</div>
    <div class="card-body">
        <textarea name="projects" rows="3" class="form-control" placeholder="Task Manager | A Laravel CRUD app | https://github.com/me/task-manager">{{ old('projects', $p->projects ?? '') }}</textarea>
        <div class="form-text">One per line: Title | Description | URL (URL optional)</div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header fw-semibold">Work Experience</div>
    <div class="card-body">
        <textarea name="experience" rows="3" class="form-control" placeholder="Web Developer Intern | ABC Company | 2025 | Built internal tools">{{ old('experience', $p->experience ?? '') }}</textarea>
        <div class="form-text">One per line: Position | Company | Years | Description (description optional)</div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header fw-semibold">Social Media / Website Links</div>
    <div class="card-body">
        <textarea name="links" rows="3" class="form-control" placeholder="GitHub | https://github.com/username">{{ old('links', $p->links ?? '') }}</textarea>
        <div class="form-text">One per line: Label | URL (must start with http:// or https://)</div>
    </div>
</div>

<button class="btn btn-primary btn-lg">Save &amp; Choose Template</button>
<a href="{{ route('portfolios.index') }}" class="btn btn-outline-secondary btn-lg">Cancel</a>