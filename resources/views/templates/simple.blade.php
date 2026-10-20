<style>
    .t1 { background:#fff; max-width:800px; margin:0 auto; padding:48px; font-family:Georgia,serif; color:#222; border:1px solid #e5e5e5; }
    .t1 h1 { font-size:2.2rem; margin:0; }
    .t1 h2 { font-size:.95rem; text-transform:uppercase; letter-spacing:.15em; border-bottom:1px solid #222; padding-bottom:4px; margin:32px 0 12px; }
    .t1 img.pic { width:110px; height:110px; border-radius:50%; object-fit:cover; }
    .t1 .muted { color:#666; }
    .t1 a { color:#222; }
</style>

<div class="t1">
    <div class="d-flex align-items-center gap-4 flex-wrap">
        @if($portfolio->profile_picture)
            <img class="pic" src="{{ $portfolio->profile_picture }}" alt="Profile picture">
        @endif
        <div>
            <h1>{{ $portfolio->full_name }}</h1>
            <div class="muted">{{ $portfolio->email }} &middot; {{ $portfolio->contact_number }}<br>{{ $portfolio->address }}</div>
        </div>
    </div>

    <h2>About Me</h2>
    <p>{!! nl2br(e($portfolio->about)) !!}</p>

    @if($portfolio->educationList())
        <h2>Education</h2>
        @foreach($portfolio->educationList() as [$degree, $school, $year])
            <p class="mb-2"><strong>{{ $degree }}</strong><br><span class="muted">{{ $school }} {{ $year }}</span></p>
        @endforeach
    @endif

    @if($portfolio->skillsList())
        <h2>Skills</h2>
        <p>{{ implode(' · ', $portfolio->skillsList()) }}</p>
    @endif

    @if($portfolio->projectsList())
        <h2>Projects</h2>
        @foreach($portfolio->projectsList() as [$title, $desc, $url])
            <p class="mb-2">
                <strong>{{ $title }}</strong>
                @if($url)<a href="{{ $portfolio->safeUrl($url) }}" target="_blank" rel="noopener">(link)</a>@endif
                <br><span class="muted">{{ $desc }}</span>
            </p>
        @endforeach
    @endif

    @if($portfolio->experienceList())
        <h2>Work Experience</h2>
        @foreach($portfolio->experienceList() as [$position, $company, $years, $desc])
            <p class="mb-2"><strong>{{ $position }}</strong>, {{ $company }} <span class="muted">({{ $years }})</span><br>
                <span class="muted">{{ $desc }}</span></p>
        @endforeach
    @endif

    @if($portfolio->linksList())
        <h2>Links</h2>
        @foreach($portfolio->linksList() as [$label, $url])
            <div><a href="{{ $portfolio->safeUrl($url) }}" target="_blank" rel="noopener">{{ $label }}</a></div>
        @endforeach
    @endif
</div>