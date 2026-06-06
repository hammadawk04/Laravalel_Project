<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — HaShop Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-w: 255px;
            --ha-purple: #7c3aed;
            --ha-purple-light: #a78bfa;
            --ha-purple-dark: #4c1d95;
            --ha-neon: #06d6a0;
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
            --ha-green: #06d6a0;
            --sidebar-bg: #07070a;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Space Grotesk',sans-serif; background:var(--ha-bg); display:flex; min-height:100vh; color:var(--ha-text); }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--ha-border);
            position: fixed; top:0; left:0; height:100vh;
            overflow-y:auto; display:flex; flex-direction:column; z-index:100;
        }
        .sidebar-brand {
            padding: 1.5rem 1.4rem;
            border-bottom: 1px solid var(--ha-border);
        }
        .sidebar-brand .logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem; font-weight: 800;
            color: var(--ha-text); letter-spacing: -0.5px;
        }
        .sidebar-brand .logo .ha { color: var(--ha-purple-light); }
        .sidebar-brand .logo .dot { color: var(--ha-neon); }
        .sidebar-brand .sub { font-size: .62rem; color: var(--ha-muted); text-transform: uppercase; letter-spacing: 2px; margin-top: .3rem; }
        .sidebar-menu { padding: 1rem 0; flex: 1; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 11px;
            padding: 10px 18px;
            color: var(--ha-muted);
            text-decoration: none; font-size: .855rem;
            transition: all .2s; border-left: 2px solid transparent;
            font-weight: 500;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            color: var(--ha-purple-light);
            background: rgba(124,58,237,.08);
            border-left-color: var(--ha-purple);
        }
        .sidebar-menu a i { width: 17px; text-align: center; font-size: .875rem; }
        .sidebar-section {
            padding: 8px 18px; font-size: .58rem;
            color: var(--ha-subtle);
            text-transform: uppercase; letter-spacing: 2px; margin-top: 6px;
        }
        .sidebar-footer {
            padding: .9rem 18px;
            border-top: 1px solid var(--ha-border);
        }
        .sidebar-footer button {
            background: none; border: none; cursor: pointer;
            color: var(--ha-muted); font-size: .835rem;
            font-family: 'Space Grotesk', sans-serif; font-weight: 500;
            display: flex; align-items: center; gap: 8px;
            transition: color .2s;
        }
        .sidebar-footer button:hover { color: var(--ha-red); }

        /* Main */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }
        .topbar {
            background: rgba(9,9,11,.92);
            backdrop-filter: blur(12px);
            padding: .9rem 2rem;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid var(--ha-border);
            position: sticky; top: 0; z-index: 50;
        }
        .topbar h1 { font-size: 1.05rem; color: var(--ha-text); font-weight: 600; font-family: 'Syne', sans-serif; }
        .topbar-user { display: flex; align-items: center; gap: 10px; }
        .topbar-user .avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--ha-purple), var(--ha-purple-dark));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: .85rem; font-family: 'Syne', sans-serif;
        }
        .content { padding: 2rem; flex: 1; }

        /* Cards */
        .card { background:var(--ha-surface); border-radius:12px; border:1px solid var(--ha-border); margin-bottom:1.5rem; overflow:hidden; }
        .card-header {
            padding: 1rem 1.4rem;
            border-bottom: 1px solid var(--ha-border);
            display: flex; justify-content: space-between; align-items: center;
            background: var(--ha-surface2);
        }
        .card-header h2 { font-size: .9rem; font-weight: 700; color: var(--ha-text); font-family: 'Syne', sans-serif; }
        .card-body { padding: 1.4rem; }

        /* Table */
        table { width:100%; border-collapse:collapse; }
        th { background:var(--ha-surface2); padding:.7rem 1rem; text-align:left; font-size:.7rem; color:var(--ha-muted); text-transform:uppercase; letter-spacing:.7px; font-weight:600; border-bottom:1px solid var(--ha-border); }
        td { padding:.85rem 1rem; border-bottom:1px solid var(--ha-border); color:var(--ha-text); font-size:.855rem; vertical-align:middle; }
        tr:last-child td { border-bottom:none; }
        tr:hover td { background:rgba(124,58,237,.04); }

        /* Buttons */
        .btn { display:inline-flex; align-items:center; gap:6px; padding:.5rem 1.1rem; border-radius:8px; border:none; cursor:pointer; font-size:.84rem; font-weight:600; text-decoration:none; transition:all .2s; font-family:'Space Grotesk',sans-serif; }
        .btn-primary { background:var(--ha-purple); color:#fff; }
        .btn-primary:hover { background:var(--ha-purple-dark); }
        .btn-secondary { background:var(--ha-surface2); color:var(--ha-text); border:1px solid var(--ha-border); }
        .btn-secondary:hover { background:var(--ha-subtle); }
        .btn-success { background:rgba(6,214,160,.15); color:var(--ha-neon); border:1px solid rgba(6,214,160,.25); }
        .btn-danger { background:rgba(239,68,68,.15); color:#f87171; border:1px solid rgba(239,68,68,.25); }
        .btn-warning { background:rgba(245,158,11,.15); color:#f59e0b; border:1px solid rgba(245,158,11,.25); }
        .btn-sm { padding:.28rem .68rem; font-size:.76rem; }
        .btn-outline { background:transparent; border:1.5px solid var(--ha-purple); color:var(--ha-purple-light); }
        .btn-outline:hover { background:var(--ha-purple); color:#fff; }

        /* Forms */
        .form-group { margin-bottom:1.2rem; }
        .form-group label { display:block; margin-bottom:.4rem; font-size:.78rem; font-weight:600; color:var(--ha-muted); text-transform:uppercase; letter-spacing:.5px; }
        .form-control { width:100%; padding:.6rem .9rem; border:1.5px solid var(--ha-border); border-radius:8px; font-size:.9rem; font-family:'Space Grotesk',sans-serif; background:var(--ha-surface2); color:var(--ha-text); transition:border .2s; }
        .form-control:focus { outline:none; border-color:var(--ha-purple); box-shadow:0 0 0 3px rgba(124,58,237,.15); }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
        .form-check { display:flex; align-items:center; gap:8px; }
        .form-check input { width:16px; height:16px; cursor:pointer; accent-color:var(--ha-purple); }

        /* Alerts */
        .alert { padding:.85rem 1.2rem; border-radius:8px; margin-bottom:1rem; font-size:.865rem; display:flex; align-items:center; gap:.5rem; }
        .alert-success { background:rgba(6,214,160,.08); color:#06d6a0; border:1px solid rgba(6,214,160,.2); }
        .alert-danger  { background:rgba(239,68,68,.08); color:#f87171; border:1px solid rgba(239,68,68,.2); }
        .alert-warning { background:rgba(245,158,11,.08); color:#f59e0b; border:1px solid rgba(245,158,11,.2); }

        /* Badges */
        .badge { padding:.22rem .6rem; border-radius:6px; font-size:.68rem; font-weight:700; letter-spacing:.3px; }
        .badge-success  { background:rgba(6,214,160,.1); color:#06d6a0; border:1px solid rgba(6,214,160,.2); }
        .badge-danger   { background:rgba(239,68,68,.1); color:#f87171; border:1px solid rgba(239,68,68,.2); }
        .badge-warning  { background:rgba(245,158,11,.1); color:#f59e0b; border:1px solid rgba(245,158,11,.2); }
        .badge-info     { background:rgba(124,58,237,.12); color:var(--ha-purple-light); border:1px solid rgba(124,58,237,.2); }
        .badge-primary  { background:rgba(124,58,237,.12); color:var(--ha-purple-light); border:1px solid rgba(124,58,237,.2); }
        .badge-secondary{ background:var(--ha-surface2); color:var(--ha-muted); border:1px solid var(--ha-border); }

        /* Stat cards */
        .stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1.2rem; margin-bottom:2rem; }
        .stat-card { background:var(--ha-surface); border-radius:12px; padding:1.4rem; border:1px solid var(--ha-border); display:flex; align-items:center; gap:1rem; transition:border-color .2s; }
        .stat-card:hover { border-color:rgba(124,58,237,.4); }
        .stat-icon { width:48px; height:48px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; }
        .stat-icon.purple { background:rgba(124,58,237,.15); color:var(--ha-purple-light); }
        .stat-icon.neon   { background:rgba(6,214,160,.12); color:var(--ha-neon); }
        .stat-icon.amber  { background:rgba(245,158,11,.12); color:#f59e0b; }
        .stat-icon.red    { background:rgba(239,68,68,.12); color:#f87171; }
        .stat-value { font-family:'JetBrains Mono',monospace; font-size:1.7rem; font-weight:500; color:var(--ha-text); line-height:1; }
        .stat-label { font-size:.75rem; color:var(--ha-muted); margin-top:3px; font-weight:500; text-transform:uppercase; letter-spacing:.4px; }

        /* Pagination */
        .pagination { display:flex; gap:4px; justify-content:center; margin-top:1rem; }
        .pagination a, .pagination span { padding:.4rem .75rem; border-radius:6px; font-size:.84rem; text-decoration:none; border:1px solid var(--ha-border); color:var(--ha-muted); background:var(--ha-surface2); }
        .pagination .active span { background:var(--ha-purple); color:#fff; border-color:var(--ha-purple); font-weight:700; }

        .img-preview { width:46px; height:46px; object-fit:cover; border-radius:8px; border:1px solid var(--ha-border); }
    </style>
    @stack('styles')
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="logo"><span class="ha">Ha</span>Shop<span class="dot">·</span></div>
        <div class="sub">Admin Panel</div>
    </div>
    <nav class="sidebar-menu">
        <div class="sidebar-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>
        <div class="sidebar-section">Catalog</div>
        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Categories
        </a>
        <a href="{{ route('admin.subcategories.index') }}" class="{{ request()->routeIs('admin.subcategories*') ? 'active' : '' }}">
            <i class="fas fa-layer-group"></i> Subcategories
        </a>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <i class="fas fa-box"></i> Products
        </a>
        <div class="sidebar-section">Commerce</div>
        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <i class="fas fa-bag-shopping"></i> Orders
        </a>
        <div class="sidebar-section">Access</div>
        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Users & Roles
        </a>
        <div class="sidebar-section">Store</div>
        <a href="{{ route('shop.index') }}" target="_blank">
            <i class="fas fa-store"></i> View HaShop
        </a>
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <i class="fas fa-right-from-bracket"></i> Logout ({{ auth()->user()->name }})
            </button>
        </form>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <h1>@yield('title', 'Dashboard')</h1>
        <div class="topbar-user">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:600;font-size:.855rem;color:var(--ha-text)">{{ auth()->user()->name }}</div>
                <div style="font-size:.7rem;color:var(--ha-muted)">Administrator</div>
            </div>
        </div>
    </div>
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger"><i class="fas fa-circle-exclamation"></i> {{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
