<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HaShop') — Where Style Meets You</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --ha-purple: #7c3aed;
            --ha-purple-light: #a78bfa;
            --ha-purple-dark: #4c1d95;
            --ha-neon: #06d6a0;
            --ha-neon-dim: #034c39;
            --ha-bg: #09090b;
            --ha-surface: #111114;
            --ha-surface2: #18181b;
            --ha-border: #27272a;
            --ha-text: #fafafa;
            --ha-muted: #71717a;
            --ha-subtle: #3f3f46;
            --ha-white: #ffffff;
            --ha-red: #ef4444;
            --ha-amber: #f59e0b;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Space Grotesk',sans-serif; color:var(--ha-text); background:var(--ha-bg); }
        a { text-decoration:none; color:inherit; }

        /* Navbar */
        .navbar {
            background: rgba(9,9,11,0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--ha-border);
            padding: 0 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
            position: sticky;
            top: 0;
            z-index: 200;
        }
        .navbar-brand {
            font-family: 'Syne', sans-serif;
            font-size: 1.7rem;
            font-weight: 800;
            letter-spacing: -1px;
            color: var(--ha-white);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .navbar-brand .ha { color: var(--ha-purple-light); }
        .navbar-brand .dot { color: var(--ha-neon); font-size: 2rem; line-height: 0; }
        .navbar-nav { display:flex; align-items:center; gap:2rem; list-style:none; }
        .navbar-nav a { color:var(--ha-muted); font-size:.875rem; font-weight:500; transition:color .2s; letter-spacing:.2px; }
        .navbar-nav a:hover { color:var(--ha-text); }
        .cart-btn {
            background: var(--ha-purple);
            color: #fff;
            padding: .55rem 1.4rem;
            border-radius: 8px;
            font-size: .875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all .2s;
            border: 1px solid rgba(167,139,250,.3);
        }
        .cart-btn:hover { background: var(--ha-purple-dark); transform: translateY(-1px); }
        .cart-count {
            background: var(--ha-neon);
            color: #000;
            border-radius: 50%;
            width: 20px; height: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: .68rem; font-weight: 700;
        }

        main { min-height: calc(100vh - 70px - 68px); }

        footer {
            background: var(--ha-surface);
            border-top: 1px solid var(--ha-border);
            padding: 2rem;
            text-align: center;
        }
        .footer-brand { font-family:'Syne',sans-serif; font-size:1.1rem; font-weight:800; color:var(--ha-text); margin-bottom:.4rem; }
        .footer-brand .ha { color: var(--ha-purple-light); }
        .footer-sub { color:var(--ha-muted); font-size:.8rem; }
        .footer-student { margin-top:.8rem; padding:.6rem 1rem; background:var(--ha-surface2); border:1px solid var(--ha-border); border-radius:8px; display:inline-block; font-size:.75rem; color:var(--ha-muted); }
        .footer-student span { color:var(--ha-purple-light); font-weight:600; }

        /* Alerts */
        .alert { padding:.9rem 1.5rem; font-size:.875rem; display:flex; align-items:center; gap:.6rem; }
        .alert-success { background:rgba(6,214,160,.08); color:#06d6a0; border-bottom:1px solid rgba(6,214,160,.15); }
        .alert-danger  { background:rgba(239,68,68,.08); color:#f87171; border-bottom:1px solid rgba(239,68,68,.15); }

        /* Buttons */
        .btn { display:inline-flex; align-items:center; gap:7px; padding:.58rem 1.3rem; border-radius:8px; border:none; cursor:pointer; font-size:.875rem; font-weight:600; transition:all .2s; text-decoration:none; font-family:'Space Grotesk',sans-serif; }
        .btn-primary { background:var(--ha-purple); color:#fff; }
        .btn-primary:hover { background:var(--ha-purple-dark); transform:translateY(-1px); }
        .btn-secondary { background:var(--ha-surface2); color:var(--ha-text); border:1px solid var(--ha-border); }
        .btn-secondary:hover { background:var(--ha-subtle); }
        .btn-outline { background:transparent; border:1.5px solid var(--ha-purple); color:var(--ha-purple-light); }
        .btn-outline:hover { background:var(--ha-purple); color:#fff; }
        .btn-neon { background:var(--ha-neon); color:#000; font-weight:700; }
        .btn-neon:hover { opacity:.88; transform:translateY(-1px); }
        .btn-danger { background:var(--ha-red); color:#fff; }
        .btn-sm { padding:.3rem .75rem; font-size:.78rem; }

        .container { max-width:1200px; margin:0 auto; padding:0 1.5rem; }

        /* Product card */
        .product-card {
            border-radius:12px;
            overflow:hidden;
            background:var(--ha-surface);
            border:1px solid var(--ha-border);
            transition:transform .2s, box-shadow .2s, border-color .2s;
        }
        .product-card:hover { transform:translateY(-5px); box-shadow:0 16px 40px rgba(124,58,237,.2); border-color:rgba(124,58,237,.4); }
        .product-card img { width:100%; height:210px; object-fit:cover; background:var(--ha-surface2); }
        .product-card-body { padding:1.2rem; }
        .product-card-title { font-weight:600; margin-bottom:.3rem; font-size:.95rem; color:var(--ha-text); }
        .product-card-price { color:var(--ha-purple-light); font-weight:700; font-size:1.1rem; font-family:'JetBrains Mono',monospace; }
        .product-card-price .original { color:var(--ha-muted); text-decoration:line-through; font-size:.8rem; font-weight:400; margin-left:6px; }
        .badge-featured { background:rgba(124,58,237,.18); color:var(--ha-purple-light); border:1px solid rgba(124,58,237,.3); font-size:.68rem; padding:.18rem .55rem; border-radius:20px; font-weight:700; letter-spacing:.5px; }
        .badge-sale { background:rgba(6,214,160,.12); color:var(--ha-neon); border:1px solid rgba(6,214,160,.25); font-size:.68rem; padding:.18rem .55rem; border-radius:20px; font-weight:700; }

        .products-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(235px,1fr)); gap:1.5rem; }

        /* Forms */
        .form-control { width:100%; padding:.65rem .9rem; border:1.5px solid var(--ha-border); border-radius:8px; font-size:.9rem; font-family:'Space Grotesk',sans-serif; background:var(--ha-surface2); color:var(--ha-text); transition:border .2s; }
        .form-control:focus { outline:none; border-color:var(--ha-purple); box-shadow:0 0 0 3px rgba(124,58,237,.15); }
        .form-group { margin-bottom:1.2rem; }
        .form-group label { display:block; margin-bottom:.4rem; font-size:.83rem; font-weight:600; color:var(--ha-muted); text-transform:uppercase; letter-spacing:.5px; }

        /* Table */
        table { width:100%; border-collapse:collapse; }
        th { background:var(--ha-surface2); padding:.75rem 1rem; text-align:left; font-size:.72rem; color:var(--ha-muted); text-transform:uppercase; letter-spacing:.7px; font-weight:600; border-bottom:1px solid var(--ha-border); }
        td { padding:.9rem 1rem; border-bottom:1px solid var(--ha-border); color:var(--ha-text); font-size:.875rem; }
        tr:last-child td { border-bottom:none; }

        /* Badge */
        .badge { padding:.22rem .6rem; border-radius:6px; font-size:.7rem; font-weight:700; letter-spacing:.3px; }
        .badge-success  { background:rgba(6,214,160,.1); color:#06d6a0; border:1px solid rgba(6,214,160,.2); }
        .badge-warning  { background:rgba(245,158,11,.1); color:#f59e0b; border:1px solid rgba(245,158,11,.2); }
        .badge-info     { background:rgba(124,58,237,.12); color:var(--ha-purple-light); border:1px solid rgba(124,58,237,.2); }
        .badge-primary  { background:rgba(124,58,237,.12); color:var(--ha-purple-light); border:1px solid rgba(124,58,237,.2); }
        .badge-danger   { background:rgba(239,68,68,.1); color:#f87171; border:1px solid rgba(239,68,68,.2); }
        .badge-secondary{ background:var(--ha-surface2); color:var(--ha-muted); border:1px solid var(--ha-border); }

        .section-title { font-family:'Syne',sans-serif; font-size:2rem; font-weight:800; color:var(--ha-text); margin-bottom:.4rem; }
        .section-sub { color:var(--ha-muted); margin-bottom:2rem; font-size:.95rem; }

        /* Glow accents */
        .glow-purple { text-shadow: 0 0 20px rgba(124,58,237,.5); }
        .tag-chip { background:rgba(124,58,237,.12); border:1px solid rgba(124,58,237,.25); color:var(--ha-purple-light); font-size:.72rem; font-weight:600; padding:.2rem .65rem; border-radius:20px; }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar">
    <a class="navbar-brand" href="{{ route('shop.index') }}">
        <span class="ha">Ha</span>Shop<span class="dot">·</span>
    </a>
    <ul class="navbar-nav">
        <li><a href="{{ route('shop.index') }}">Home</a></li>
        <li><a href="{{ route('shop.products') }}">Products</a></li>
        @auth
            <li><a href="{{ route('shop.orders') }}">Orders</a></li>
            @if(auth()->user()->isAdmin())
                <li><a href="{{ route('admin.dashboard') }}" style="color:var(--ha-purple-light);font-weight:700">Admin</a></li>
            @endif
            <li>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:var(--ha-muted);cursor:pointer;font-size:.875rem;font-family:'Space Grotesk',sans-serif;font-weight:500">Logout</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}" style="color:var(--ha-purple-light);font-weight:600">Register</a></li>
        @endauth
    </ul>
    <a href="{{ route('shop.cart') }}" class="cart-btn">
        <i class="fas fa-bag-shopping"></i>
        Cart
        @php $cartCount = count(session()->get('cart', [])); @endphp
        @if($cartCount > 0)
            <span class="cart-count">{{ $cartCount }}</span>
        @endif
    </a>
</nav>

<main>
    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger"><i class="fas fa-circle-exclamation"></i> {{ session('error') }}</div>
    @endif
    @yield('content')
</main>

<footer>
    <div class="footer-brand"><span class="ha">Ha</span>Shop·</div>
    <div class="footer-sub">Modern shopping, curated for you.</div>
    <div class="footer-student">
        Student: <span>Hammadahamane Alousseyna</span> &nbsp;|&nbsp; ID: <span>20222022769</span>
    </div>
</footer>

@stack('scripts')
</body>
</html>
