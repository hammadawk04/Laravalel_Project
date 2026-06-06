<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — HaShop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Space Grotesk',sans-serif; background:#07070a; min-height:100vh; display:flex; align-items:center; justify-content:center; background-image:radial-gradient(ellipse at 50% 0%,rgba(124,58,237,.22) 0%,transparent 60%); }
        .wrap { display:flex; width:100%; max-width:900px; border-radius:20px; overflow:hidden; box-shadow:0 32px 80px rgba(0,0,0,.6); border:1px solid #27272a; }
        .left { flex:1; background:linear-gradient(135deg,#06d6a0,#059669); display:flex; flex-direction:column; justify-content:space-between; padding:2.5rem; position:relative; overflow:hidden; }
        .left::before { content:''; position:absolute; inset:0; background:radial-gradient(circle at 20% 80%,rgba(124,58,237,.2) 0%,transparent 50%); pointer-events:none; }
        .left-brand { font-family:'Syne',sans-serif; font-size:2rem; font-weight:800; color:#fff; letter-spacing:-1px; }
        .left-brand .dot { color:#7c3aed; }
        .left-tagline { font-size:1.5rem; font-weight:700; color:rgba(255,255,255,.95); line-height:1.3; font-family:'Syne',sans-serif; }
        .left-sub { font-size:.85rem; color:rgba(255,255,255,.6); margin-top:.5rem; }
        .left-perks { display:flex; flex-direction:column; gap:.6rem; }
        .perk { display:flex; align-items:center; gap:.7rem; font-size:.83rem; color:rgba(255,255,255,.8); }
        .perk i { color:#fff; }
        .right { background:#111114; padding:2.5rem; width:400px; display:flex; flex-direction:column; justify-content:center; }
        .right h2 { font-family:'Syne',sans-serif; font-size:1.5rem; font-weight:800; color:#fafafa; margin-bottom:.35rem; }
        .right p { color:#71717a; font-size:.875rem; margin-bottom:1.8rem; }
        .form-group { margin-bottom:1rem; }
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
    </style>
</head>
<body>
<div class="wrap">
    <div class="left">
        <div class="left-brand">HaShop<span class="dot">·</span></div>
        <div>
            <div class="left-tagline">Join thousands of<br>happy shoppers.</div>
            <div class="left-sub">Create your free account today.</div>
        </div>
        <div class="left-perks">
            <div class="perk"><i class="fas fa-bolt"></i> Instant account activation</div>
            <div class="perk"><i class="fas fa-gift"></i> Welcome deals on signup</div>
            <div class="perk"><i class="fas fa-shield-halved"></i> Safe & secure checkout</div>
        </div>
    </div>
    <div class="right">
        <h2>Create Account</h2>
        <p>Fill in the details below to get started</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>Full Name</label>
                <div class="input-wrap"><i class="fas fa-user"></i>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Your full name" required>
                </div>
                @error('name')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrap"><i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="your@email.com" required>
                </div>
                @error('email')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap"><i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Min 6 characters" required>
                </div>
                @error('password')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <div class="input-wrap"><i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
                </div>
            </div>
            <button type="submit" class="btn">Create Account &rarr;</button>
        </form>
        <div class="link">Already have an account? <a href="{{ route('login') }}">Sign in</a></div>
    </div>
</div>
</body>
</html>
