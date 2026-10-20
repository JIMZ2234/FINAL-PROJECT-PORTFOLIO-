<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portfolio Generator')</title>

    {{-- Apply the saved theme BEFORE the page draws (prevents a white flash) --}}
    <script>
        (function () {
            var t = null;
            try { t = localStorage.getItem('theme'); } catch (e) {}
            if (t !== 'dark' && t !== 'light') {
                t = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            document.documentElement.setAttribute('data-bs-theme', t);
        })();
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ===== Theme colors (light) ===== */
        :root {
            --bg-grad: linear-gradient(135deg, #eef2ff, #fdf2f8, #ecfeff);
            --blob-opacity: .55;
            --glass-nav: rgba(255, 255, 255, .72);
            --glass-card: rgba(255, 255, 255, .93);
            --glass-border: rgba(255, 255, 255, .8);
            --nav-line: rgba(0, 0, 0, .06);
            --header-line: #eef0f6;
            --nav-link: #374151;
            --brand: #4f46e5;
        }
        /* ===== Theme colors (dark) ===== */
        [data-bs-theme="dark"] {
            --bg-grad: linear-gradient(135deg, #0b1020, #1e1b4b, #082f49);
            --blob-opacity: .22;
            --glass-nav: rgba(15, 23, 42, .78);
            --glass-card: rgba(30, 41, 59, .92);
            --glass-border: rgba(255, 255, 255, .08);
            --nav-line: rgba(255, 255, 255, .08);
            --header-line: rgba(255, 255, 255, .08);
            --nav-link: #d1d5db;
            --brand: #818cf8;
        }

        body { font-family: 'Inter', sans-serif; min-height: 100vh; }

        /* ===== Live background ===== */
        .bg-live {
            position: fixed; inset: 0; z-index: -1; overflow: hidden;
            background: var(--bg-grad);
            background-size: 300% 300%;
            animation: bgShift 20s ease infinite;
        }
        .bg-live span {
            position: absolute; border-radius: 50%;
            filter: blur(70px); opacity: var(--blob-opacity);
            animation: blobFloat 18s ease-in-out infinite;
            will-change: transform;
        }
        .bg-live span:nth-child(1) { width: 420px; height: 420px; background: #a5b4fc; top: -100px; left: -80px; }
        .bg-live span:nth-child(2) { width: 380px; height: 380px; background: #f9a8d4; top: 30%; right: -100px; animation-duration: 22s; animation-delay: -6s; }
        .bg-live span:nth-child(3) { width: 340px; height: 340px; background: #67e8f9; bottom: -100px; left: 30%; animation-duration: 26s; animation-delay: -12s; }

        @keyframes blobFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%      { transform: translate(60px, 40px) scale(1.1); }
            66%      { transform: translate(-50px, 60px) scale(.95); }
        }
        @keyframes bgShift {
            0%, 100% { background-position: 0% 50%; }
            50%      { background-position: 100% 50%; }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: none; }
        }

        /* ===== Readable glass surfaces ===== */
        .navbar {
            background: var(--glass-nav) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--nav-line);
        }
        .navbar-brand { font-weight: 800; color: var(--brand) !important; }
        .nav-link { font-weight: 600; color: var(--nav-link) !important; }
        .nav-link:hover { color: var(--brand) !important; }

        main { animation: fadeUp .5s ease; }
        main .card {
            background: var(--glass-card);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(79, 70, 229, .08);
        }
        .t2 .card { background: #fff; }           /* keep Template 2 cards solid */
        .card-header { background: transparent !important; border-bottom: 1px solid var(--header-line); }

        .form-control, .form-select { border-radius: 10px; padding: .6rem .85rem; }
        .form-control:focus { border-color: #6366f1; box-shadow: 0 0 0 .2rem rgba(99, 102, 241, .2); }
        .btn { border-radius: 10px; font-weight: 600; }
        .btn-primary { background: #4f46e5; border-color: #4f46e5; }
        .btn-primary:hover { background: #4338ca; border-color: #4338ca; }

        /* ===== Dark / light toggle button ===== */
        .theme-toggle {
            width: 40px; height: 40px; padding: 0; border-radius: 50%;
            border: 1px solid var(--nav-line); background: var(--glass-card);
            font-size: 1.1rem; line-height: 1; transition: transform .2s ease;
        }
        .theme-toggle:hover { transform: rotate(15deg); }
        [data-bs-theme="light"] .theme-toggle .icon-sun  { display: none; }
        [data-bs-theme="dark"]  .theme-toggle .icon-moon { display: none; }

        @media (prefers-reduced-motion: reduce) {
            .bg-live, .bg-live span, main { animation: none; }
        }
    </style>
</head>
<body>

<div class="bg-live" aria-hidden="true"><span></span><span></span><span></span></div>

<nav class="navbar navbar-expand-md sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">PortfolioGen</a>

        <div class="d-flex align-items-center gap-2 order-md-last ms-auto ms-md-3">
            <button id="themeToggle" type="button" class="btn theme-toggle"
                    aria-label="Toggle dark mode" title="Switch dark / light mode">
                <span class="icon-moon">🌙</span><span class="icon-sun">☀️</span>
            </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto align-items-md-center">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('portfolios.create') }}">Create Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('portfolios.index') }}">Manage Portfolios</a></li>
                    <li class="nav-item"><span class="nav-link text-muted">Hi, {{ auth()->user()->name }}</span></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button class="btn btn-link nav-link">Log Out</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Log In</a></li>
                    <li class="nav-item"><a class="btn btn-primary btn-sm ms-md-2" href="{{ route('register') }}">Sign Up</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('themeToggle').addEventListener('click', function () {
        var root = document.documentElement;
        var next = root.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
        root.setAttribute('data-bs-theme', next);
        try { localStorage.setItem('theme', next); } catch (e) {}
    });
</script>
</body>
</html>