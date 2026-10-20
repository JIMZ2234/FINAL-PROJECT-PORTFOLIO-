<style>
    .t3 { border-radius:20px; overflow:hidden; box-shadow:0 8px 30px rgba(0,0,0,.15); background:#fff; color:#212529; }
    .t3 .side { background:linear-gradient(180deg,#2d1b69,#d63384); color:#fff; padding:36px 28px; height:100%; }
    .t3 .side img { width:100%; max-width:200px; aspect-ratio:1; object-fit:cover; border-radius:30% 70% 70% 30% / 30% 30% 70% 70%; border:4px solid rgba(255,255,255,.6); }
    .t3 .side h6 { text-transform:uppercase; letter-spacing:.12em; font-size:.75rem; margin-top:26px; opacity:.8; }
    .t3 .side a { color:#fff; }
    .t3 .tag { display:inline-block; border:1px solid rgba(255,255,255,.7); border-radius:6px; padding:2px 10px; margin:3px 3px 0 0; font-size:.85rem; }
    .t3 .main { padding:40px; }
    .t3 .main h2 { font-weight:800; color:#2d1b69; }
    .t3 .quote { border-left:5px solid #d63384; padding-left:16px; font-size:1.1rem; font-style:italic; color:#444; }
    .t3 .timeline { border-left:3px solid #d63384; margin-left:8px; padding-left:22px; }
    .t3 .timeline .item { position:relative; margin-bottom:20px; }
    .t3 .timeline .item::before { content:''; position:absolute; left:-31px; top:6px; width:14px; height:14px; background:#2d1b69; border:3px solid #fff; border-radius:50%; box-shadow:0 0 0 2px #d63384; }
    .t3 .num { display:inline-block; width:30px; height:30px; line-height:30px; text-align:center; border-radius:50%; background:#d63384; color:#fff; font-weight:700; margin-right:8px; }
</style>

<div class="t3">
    <div class="row g-0">
        <div class="col-md-4">
            <div class="side">
                @if($portfolio->profile_picture)
                    <img src="{{ $portfolio->profile_picture }}" alt="Profile picture">
                @endif
                <h3 class="mt-3 fw-bold">{{ $portfolio->full_name }}</h3>

                <h6>Contact</h6>
                <div>{{ $portfolio->email }}</div>
                <div>{{ $portfolio->contact_number }}</div>
                <div>{{ $portfolio->address }}</div>

                <h6>Skills</h6>
                @foreach($portfolio->skillsList() as $skill)<span class="tag">{{ $skill }}</span>@endforeach

                @if($portfolio->linksList())
                    <h6>Find me</h6>
                    @foreach($portfolio->linksList() as [$label, $url])
                        <div><a href="{{ $portfolio->safeUrl($url) }}" target="_blank" rel="noopener">{{ $label }}</a></div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="col-md-8">
            <div class="main">
                <h2>Hello, I'm {{ $portfolio->full_name }}</h2>
                <p class="quote">{!! nl2br(e($portfolio->about)) !!}</p>

                @if($portfolio->experienceList())
                    <h4 class="mt-4 fw-bold">Experience</h4>
                    <div class="timeline">
                        @foreach($portfolio->experienceList() as [$position, $company, $years, $desc])
                            <div class="item"><strong>{{ $position }}</strong> &middot; {{ $company }}<br>
                                <small class="text-muted">{{ $years }}</small>
                                @if($desc)<div>{{ $desc }}</div>@endif</div>
                        @endforeach
                    </div>
                @endif

                @if($portfolio->educationList())
                    <h4 class="mt-4 fw-bold">Education</h4>
                    <div class="timeline">
                        @foreach($portfolio->educationList() as [$degree, $school, $year])
                            <div class="item"><strong>{{ $degree }}</strong><br>
                                <small class="text-muted">{{ $school }} &middot; {{ $year }}</small></div>
                        @endforeach
                    </div>
                @endif

                @if($portfolio->projectsList())
                    <h4 class="mt-4 fw-bold">Projects</h4>
                    @foreach($portfolio->projectsList() as $i => [$title, $desc, $url])
                        <div class="mb-3">
                            <span class="num">{{ $i + 1 }}</span><strong>{{ $title }}</strong>
                            @if($url)<a href="{{ $portfolio->safeUrl($url) }}" target="_blank" rel="noopener">&rarr; open</a>@endif
                            <div class="ms-5 text-muted">{{ $desc }}</div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>