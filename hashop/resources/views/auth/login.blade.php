<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — HaShop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Space Grotesk',sans-serif;
            background: #07070a;
            min-height:100vh; display:flex; align-items:center; justify-content:center;
            background-image: radial-gradient(ellipse at 50% 0%, rgba(124,58,237,.25) 0%, transparent 60%),
                              radial-gradient(ellipse at 100% 100%, rgba(6,214,160,.1) 0%, transparent 50%);
        }
        .wrap { display:flex; width:100%; max-width:900px; min-height:560px; border-radius:20px; overflow:hidden; box-shadow:0 32px 80px rgba(0,0,0,.6); border:1px solid #27272a; }
        .left {
            flex:1; background:linear-gradient(135deg,#4c1d95,#7c3aed);
            display:flex; flex-direction:column; justify-content:space-between; padding:2.5rem;
            position:relative; overflow:hidden;
        }
        .left::before { content:''; position:absolute; inset:0; background:radial-gradient(circle at 80% 20%,rgba(6,214,160,.15) 0%,transparent 50%); pointer-events:none; }
        .left-brand { font-family:'Syne',sans-serif; font-size:2rem; font-weight:800; color:#fff; letter-spacing:-1px; }
        .left-brand .dot { color:#06d6a0; }
        .left-tagline { font-size:1.5rem; font-weight:700; color:rgba(255,255,255,.9); line-height:1.3; font-family:'Syne',sans-serif; }
        .left-sub { font-size:.85rem; color:rgba(255,255,255,.55); margin-top:.5rem; }
        .left-perks { display:flex; flex-direction:column; gap:.6rem; }
        .perk { display:flex; align-items:center; gap:.7rem; font-size:.83rem; color:rgba(255,255,255,.7); }
        .perk i { color:#06d6a0; }
        .right { background:#111114; padding:2.5rem; width:380px; display:flex; flex-direction:column; justify-content:center; }
        .right h2 { font-family:'Syne',sans-serif; font-size:1.5rem; font-weight:800; color:#fafafa; margin-bottom:.35rem; }
        .right p { color:#71717a; font-size:.875rem; margin-bottom:2rem; }
        .form-group { margin-bottom:1.1rem; }
        .form-group label { display:block; margin-bottom:.35rem; font-size:.75rem; font-weight:700; color:#71717a; text-transform:uppercase; letter-spacing:.5px; }
        .input-wrap { position:relative; }
        .input-wrap i { position:absolute; left:13px; top:50%; transform:translateY(-50%); color:#7c3aed; font-size:.83rem; }
        .form-control { width:100%; padding:.65rem .9rem .65rem 2.5rem; border:1.5px solid #27272a; border-radius:9px; font-size:.9rem; font-family:'Space Grotesk',sans-serif; background:#18181b; color:#fafafa; transition:border .2s; }
        .form-control:focus { outline:none; border-color:#7c3aed; box-shadow:0 0 0 3px rgba(124,58,237,.15); }
        .btn { width:100%; padding:.78rem; background:#7c3aed; color:#fff; border:none; border-radius:9px; font-size:.95rem; font-weight:700; cursor:pointer; transition:all .2s; font-family:'Space Grotesk',sans-serif; }
        .btn:hover { background:#4c1d95; }
        .error-msg { color:#f87171; font-size:.76rem; margin-top:.3rem; }
        .link { text-align:center; margin-top:1.2rem; font-size:.84rem; color:#71717a; }
        .link a { color:#a78bfa; font-weight:700; }
        .demo { background:#18181b; border:1px solid #27272a; border-left:3px solid #7c3aed; border-radius:9px; padding:.9rem 1rem; margin-bottom:1.5rem; font-size:.78rem; color:#71717a; }
        .demo strong { color:#a78bfa; display:block; margin-bottom:.25rem; font-size:.8rem; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="left">
        <div class="left-brand">HaShop<span class="dot">·</span></div>
        <div>
            <div class="left-tagline">Welcome back to<br>your favourite store.</div>
            <div class="left-sub">Sign in and keep shopping.</div>
        </div>
        <div class="left-perks">
            <div class="perk"><i class="fas fa-circle-check"></i> Free shipping on all orders</div>
            <div class="perk"><i class="fas fa-circle-check"></i> Exclusive member deals</div>
            <div class="perk"><i class="fas fa-circle-check"></i> Track orders in real-time</div>
        </div>
    </div>
    <div class="right">
        <h2>Sign In</h2>
        <p>Enter your credentials to continue</p>
        <div class="demo">
            <strong>Demo Accounts</strong>
            Admin: admin@hashop.com / password<br>
            Customer: customer@hashop.com / password
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="your@email.com" required>
                </div>
                @error('email')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>
            <button type="submit" class="btn">Sign In &rarr;</button>
        </form>
        <div class="link">No account? <a href="{{ route('register') }}">Create one free</a></div>
    </div>
</div>
</body>
</html>
