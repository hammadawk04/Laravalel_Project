@extends('layouts.shop')
@section('title', 'HaShop — Where Style Meets You')
@section('content')

{{-- Hero --}}
<section style="background:var(--ha-surface);padding:6rem 0;text-align:center;position:relative;overflow:hidden;border-bottom:1px solid var(--ha-border)">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 50% -20%,rgba(124,58,237,.3) 0%,transparent 60%),radial-gradient(ellipse at 80% 100%,rgba(6,214,160,.12) 0%,transparent 50%);pointer-events:none"></div>
    {{-- Grid overlay --}}
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(124,58,237,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(124,58,237,.04) 1px,transparent 1px);background-size:40px 40px;pointer-events:none"></div>
    <div class="container" style="position:relative;z-index:1">
        <div style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(124,58,237,.12);border:1px solid rgba(124,58,237,.3);border-radius:20px;padding:.35rem 1rem;margin-bottom:1.8rem">
            <span style="width:6px;height:6px;background:#06d6a0;border-radius:50%;animation:pulse 2s infinite"></span>
            <span style="font-size:.75rem;font-weight:600;color:var(--ha-purple-light);letter-spacing:.8px;text-transform:uppercase">Now Open — HaShop</span>
        </div>
        <h1 style="font-family:'Syne',sans-serif;font-size:4rem;font-weight:800;margin-bottom:1.2rem;letter-spacing:-2px;line-height:1.05;color:var(--ha-text)">
            Where Style<br><span style="color:var(--ha-purple-light)">Meets</span> <span style="color:var(--ha-neon)">You.</span>
        </h1>
        <p style="font-size:1.05rem;color:var(--ha-muted);margin-bottom:2.5rem;max-width:440px;margin-left:auto;margin-right:auto;font-weight:400;line-height:1.7">Curated products from top categories. Fast shipping, zero compromise on quality.</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('shop.products') }}" class="btn btn-primary" style="padding:.8rem 2.2rem;font-size:.95rem;border-radius:10px">
                <i class="fas fa-bag-shopping"></i> Shop Now
            </a>
            <a href="{{ route('shop.products') }}" class="btn btn-secondary" style="padding:.8rem 2.2rem;font-size:.95rem;border-radius:10px">
                Browse Categories <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div style="display:flex;justify-content:center;gap:3rem;margin-top:3rem;flex-wrap:wrap">
            <div style="text-align:center">
                <div style="font-family:'JetBrains Mono',monospace;font-size:1.6rem;font-weight:500;color:var(--ha-purple-light)">500+</div>
                <div style="font-size:.75rem;color:var(--ha-muted);text-transform:uppercase;letter-spacing:.5px">Products</div>
            </div>
            <div style="text-align:center">
                <div style="font-family:'JetBrains Mono',monospace;font-size:1.6rem;font-weight:500;color:var(--ha-neon)">Free</div>
                <div style="font-size:.75rem;color:var(--ha-muted);text-transform:uppercase;letter-spacing:.5px">Shipping</div>
            </div>
            <div style="text-align:center">
                <div style="font-family:'JetBrains Mono',monospace;font-size:1.6rem;font-weight:500;color:var(--ha-purple-light)">24/7</div>
                <div style="font-size:.75rem;color:var(--ha-muted);text-transform:uppercase;letter-spacing:.5px">Support</div>
            </div>
        </div>
    </div>
</section>
<style>@keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}</style>

{{-- Categories --}}
@if($categories->count())
<section style="padding:5rem 0;background:var(--ha-bg)">
    <div class="container">
        <div style="text-align:center;margin-bottom:3rem">
            <p style="font-size:.72rem;text-transform:uppercase;letter-spacing:2px;color:var(--ha-purple-light);font-weight:700;margin-bottom:.5rem">Explore</p>
            <h2 class="section-title">Browse Categories</h2>
            <p class="section-sub">Find exactly what you're looking for</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:1rem">
            @foreach($categories as $cat)
            <a href="{{ route('shop.products', ['category' => $cat->slug]) }}" style="text-decoration:none">
                <div style="background:var(--ha-surface);border:1px solid var(--ha-border);border-radius:12px;padding:1.6rem 1rem;text-align:center;transition:all .2s;cursor:pointer" onmouseover="this.style.borderColor='rgba(124,58,237,.5)';this.style.background='rgba(124,58,237,.08)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='var(--ha-border)';this.style.background='var(--ha-surface)';this.style.transform=''">
                    <div style="width:48px;height:48px;background:rgba(124,58,237,.12);border-radius:10px;display:flex;align-items:center;justify-content:center;margin:0 auto .9rem;font-size:1.3rem;color:var(--ha-purple-light)">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div style="font-weight:700;color:var(--ha-text);font-size:.9rem">{{ $cat->name }}</div>
                    <div style="font-size:.73rem;color:var(--ha-muted);margin-top:.2rem">{{ $cat->products_count }} items</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Featured Products --}}
@if($featured->count())
<section style="padding:5rem 0;background:var(--ha-surface);border-top:1px solid var(--ha-border);border-bottom:1px solid var(--ha-border)">
    <div class="container">
        <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:2.5rem">
            <div>
                <p style="font-size:.72rem;text-transform:uppercase;letter-spacing:2px;color:var(--ha-purple-light);font-weight:700;margin-bottom:.5rem">Curated</p>
                <h2 class="section-title" style="margin-bottom:0">Featured Products</h2>
            </div>
            <a href="{{ route('shop.products') }}" class="btn btn-outline">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="products-grid">
            @foreach($featured as $product)
            @include('shop.partials.product-card')
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Newest --}}
@if($newest->count())
<section style="padding:5rem 0;background:var(--ha-bg)">
    <div class="container">
        <div style="margin-bottom:2.5rem">
            <p style="font-size:.72rem;text-transform:uppercase;letter-spacing:2px;color:var(--ha-neon);font-weight:700;margin-bottom:.5rem">Just Dropped</p>
            <h2 class="section-title">New Arrivals</h2>
            <p class="section-sub">Fresh picks, just landed</p>
        </div>
        <div class="products-grid">
            @foreach($newest as $product)
            @include('shop.partials.product-card')
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
