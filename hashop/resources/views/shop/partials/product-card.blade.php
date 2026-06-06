<div class="product-card">
    <a href="{{ route('shop.product', $product) }}" style="display:block;position:relative">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        @else
            <div style="width:100%;height:210px;background:linear-gradient(135deg,#18181b,#27272a);display:flex;align-items:center;justify-content:center;color:#7c3aed;font-size:2.5rem">
                <i class="fas fa-box"></i>
            </div>
        @endif
        <div style="position:absolute;top:.75rem;left:.75rem;display:flex;gap:.35rem;flex-wrap:wrap">
            @if($product->is_featured) <span class="badge-featured">★ Featured</span> @endif
            @if($product->sale_price) <span class="badge-sale">SALE</span> @endif
        </div>
    </a>
    <div class="product-card-body">
        <div style="font-size:.73rem;color:var(--ha-muted);margin-bottom:.3rem;text-transform:uppercase;letter-spacing:.4px">{{ $product->category->name }}</div>
        <div class="product-card-title">
            <a href="{{ route('shop.product', $product) }}" style="color:inherit">{{ $product->name }}</a>
        </div>
        <div class="product-card-price" style="margin:.5rem 0">
            ${{ number_format($product->sale_price ?? $product->price, 2) }}
            @if($product->sale_price)
                <span class="original">${{ number_format($product->price, 2) }}</span>
            @endif
        </div>
        <div style="margin-top:.9rem">
            @if($product->stock > 0)
                <form method="POST" action="{{ route('shop.cart.add', $product) }}">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary btn-sm" style="width:100%;justify-content:center">
                        <i class="fas fa-bag-shopping"></i> Add to Cart
                    </button>
                </form>
            @else
                <button class="btn btn-secondary btn-sm" style="width:100%;justify-content:center;opacity:.5" disabled>Out of Stock</button>
            @endif
        </div>
    </div>
</div>
