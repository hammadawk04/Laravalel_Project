@extends('layouts.shop')
@section('title', $product->name)
@section('content')

<div class="container" style="padding:2.5rem 1.5rem">
    <div style="font-size:.78rem;color:var(--ha-muted);margin-bottom:1.5rem;display:flex;align-items:center;gap:.4rem">
        <a href="{{ route('shop.index') }}" style="color:var(--ha-purple-light)">Home</a>
        <i class="fas fa-chevron-right" style="font-size:.6rem"></i>
        <a href="{{ route('shop.products') }}" style="color:var(--ha-purple-light)">Products</a>
        <i class="fas fa-chevron-right" style="font-size:.6rem"></i>
        <span>{{ $product->name }}</span>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:3.5rem;align-items:start">
        <div>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                     style="width:100%;border-radius:14px;border:1px solid var(--ha-border)">
            @else
                <div style="width:100%;padding-top:100%;background:linear-gradient(135deg,#18181b,#27272a);border-radius:14px;position:relative;border:1px solid var(--ha-border)">
                    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;color:var(--ha-purple-light);font-size:4rem">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            @endif
        </div>

        <div>
            <div style="display:flex;gap:.5rem;margin-bottom:.9rem;flex-wrap:wrap">
                @if($product->is_featured) <span class="badge badge-info">★ Featured</span> @endif
                @if($product->sale_price)  <span class="badge badge-success">SALE</span>   @endif
                <span class="badge badge-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                    {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ')' : 'Out of Stock' }}
                </span>
            </div>

            <h1 style="font-family:'Syne',sans-serif;font-size:2rem;font-weight:800;color:var(--ha-text);margin-bottom:.5rem;line-height:1.15">{{ $product->name }}</h1>

            <div style="font-size:.83rem;color:var(--ha-muted);margin-bottom:1.3rem">
                <a href="{{ route('shop.products', ['category' => $product->category->slug]) }}" style="color:var(--ha-purple-light)">{{ $product->category->name }}</a>
                @if($product->subcategory) <span style="color:var(--ha-subtle)"> / {{ $product->subcategory->name }}</span> @endif
            </div>

            <div style="margin-bottom:1.6rem">
                <span style="font-family:'JetBrains Mono',monospace;font-size:2.5rem;font-weight:500;color:var(--ha-purple-light)">
                    ${{ number_format($product->sale_price ?? $product->price, 2) }}
                </span>
                @if($product->sale_price)
                    <span style="font-size:1.05rem;text-decoration:line-through;color:var(--ha-muted);margin-left:.5rem">${{ number_format($product->price, 2) }}</span>
                    <span style="font-size:.83rem;color:var(--ha-neon);margin-left:.5rem;font-weight:600">Save ${{ number_format($product->price - $product->sale_price, 2) }}</span>
                @endif
            </div>

            @if($product->description)
                <p style="color:var(--ha-muted);line-height:1.78;margin-bottom:1.6rem;font-size:.93rem">{{ $product->description }}</p>
            @endif

            <div style="background:var(--ha-surface);border:1px solid var(--ha-border);border-radius:10px;padding:1rem 1.2rem;margin-bottom:1.5rem;display:flex;gap:2rem">
                <div style="display:flex;align-items:center;gap:.5rem;font-size:.8rem;color:var(--ha-muted)"><i class="fas fa-truck" style="color:var(--ha-neon)"></i> Free Shipping</div>
                <div style="display:flex;align-items:center;gap:.5rem;font-size:.8rem;color:var(--ha-muted)"><i class="fas fa-shield-halved" style="color:var(--ha-purple-light)"></i> Secure Checkout</div>
            </div>

            @if($product->stock > 0)
                <form method="POST" action="{{ route('shop.cart.add', $product) }}">
                    @csrf
                    <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1rem">
                        <label style="font-weight:600;color:var(--ha-muted);font-size:.8rem;text-transform:uppercase;letter-spacing:.5px">Qty:</label>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                               style="width:80px;padding:.5rem;border:1.5px solid var(--ha-border);border-radius:8px;text-align:center;font-size:1rem;color:var(--ha-text);background:var(--ha-surface2)">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;padding:.9rem;font-size:1rem;justify-content:center;border-radius:10px">
                        <i class="fas fa-bag-shopping"></i> Add to Cart
                    </button>
                </form>
            @else
                <button class="btn btn-secondary" style="width:100%;padding:.9rem;opacity:.5;justify-content:center" disabled>Out of Stock</button>
            @endif
        </div>
    </div>

    @if($related->count())
    <div style="margin-top:4.5rem;padding-top:3rem;border-top:1px solid var(--ha-border)">
        <h2 style="font-family:'Syne',sans-serif;font-size:1.5rem;font-weight:800;color:var(--ha-text);margin-bottom:1.5rem">Related Products</h2>
        <div class="products-grid">
            @foreach($related as $product)
                @include('shop.partials.product-card')
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
