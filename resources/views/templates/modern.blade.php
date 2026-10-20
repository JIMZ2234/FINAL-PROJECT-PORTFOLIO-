<style>
    .t2 .hero { background:linear-gradient(135deg,#0d6efd,#6610f2); color:#fff; border-radius:20px; padding:40px; }
    .t2 .hero img { width:130px; height:130px; border-radius:50%; object-fit:cover; border:4px solid #fff; }
    .t2 .card { border:0; border-radius:16px; box-shadow:0 4px 14px rgba(0,0,0,.08); }
    .t2 .card-title { color:#0d6efd; font-weight:700; }
    .t2 .pill { display:inline-block; background:#e7f0ff; color:#0d6efd; padding:6px 14px; border-radius:999px; margin:3px; font-size:.9rem; font-weight:600; }
</style>

<div class="t2">
    <div class="hero mb-4 d-flex align-items-center gap-4 flex-wrap">
        @if($portfolio->profile_picture)
            <img src="{{ $portfolio->profile_picture }}" alt="Profile picture">
        @endif
        <div>
            <h1 class="fw-bold mb-1">{{ $portfolio->full_name }}</h1>
            <div>{{ $portfolio->email }} &middot; {{ $portfolio->contact_number }}</div>
            <div>{{ $portfolio->address }}</div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card h-100"><div class="card-body">
                <h5 class="card-title">About Me</h5>
                <p class="mb-0">{!! nl2br(e($portfolio->about)) !!}</p>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card h-100"><div class="card-body">
                <h5 class="card-title">Skills</h5>
                @foreach($portfolio->skillsList() as $skill)<span class="pill">{{ $skill }}</span>@endforeach
            </div></div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card h-100"><div class="card-body">
                <h5 class="card-title">Education</h5>
                @foreach($portfolio->educationList() as [$degree, $school, $year])
                    <div class="mb-3"><strong>{{ $degree }}</strong><br><small class="text-muted">{{ $school }} &middot; {{ $year }}</small></div>
                @endforeach
            </div></div>
        </div>
        <div class="col-md-6">
            <div class="card h-100"><div class="card-body">
                <h5 class="card-title">Work Experience</h5>
                @foreach($portfolio->experienceList() as [$position, $company, $years, $desc])
                    <div class="mb-3"><strong>{{ $position }}</strong> at {{ $company }}<br>
                        <small class="text-muted">{{ $years }}</small>
                        @if($desc)<br><small>{{ $desc }}</small>@endif</div>
                @endforeach
            </div></div>
        </div>
    </div>

    @if($portfolio->projectsList())
    <h4 class="fw-bold mb-3">Projects</h4>
    <div class="row g-4 mb-4">
        @foreach($portfolio->projectsList() as [$title, $desc, $url])
            <div class="col-md-4">
                <div class="card h-100"><div class="card-body">
                    <h6 class="fw-bold">{{ $title }}</h6>
                    <p class="small text-muted">{{ $desc }}</p>
                    @if($url)<a href="{{ $portfolio->safeUrl($url) }}" target="_blank" rel="noopener" class="btn btn-sm btn-primary">View</a>@endif
                </div></div>
            </div>
        @endforeach
    </div>
    @endif

    @if($portfolio->linksList())
        <div class="text-center">
            @foreach($portfolio->linksList() as [$label, $url])
                <a href="{{ $portfolio->safeUrl($url) }}" target="_blank" rel="noopener" class="btn btn-outline-primary rounded-pill m-1">{{ $label }}</a>
            @endforeach
        </div>
    @endif
</div>