@extends('layouts.shop')
@section('title', 'Your Cart')
@section('content')

<div class="container" style="padding:2.5rem 1.5rem">
    <h1 style="font-family:'Syne',sans-serif;font-size:1.8rem;font-weight:800;color:var(--ha-text);margin-bottom:2rem;display:flex;align-items:center;gap:.7rem">
        <i class="fas fa-bag-shopping" style="color:var(--ha-purple-light)"></i> Your Cart
    </h1>

    @if(empty($cart))
        <div style="text-align:center;padding:5rem;background:var(--ha-surface);border-radius:14px;border:1px solid var(--ha-border)">
            <i class="fas fa-bag-shopping" style="font-size:3.5rem;color:var(--ha-subtle);display:block;margin-bottom:1rem"></i>
            <h3 style="color:var(--ha-muted);margin-bottom:1rem;font-family:'Syne',sans-serif;font-size:1.2rem">Your cart is empty</h3>
            <a href="{{ route('shop.products') }}" class="btn btn-primary">Start Shopping</a>
        </div>
    @else
        <div style="display:grid;grid-template-columns:2fr 1fr;gap:2rem;align-items:start">
            <div style="background:var(--ha-surface);border-radius:14px;border:1px solid var(--ha-border);overflow:hidden">
                <table>
                    <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th></tr></thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $item)
                            @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:12px">
                                        @if($item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" style="width:50px;height:50px;object-fit:cover;border-radius:8px;border:1px solid var(--ha-border)">
                                        @else
                                            <div style="width:50px;height:50px;background:var(--ha-surface2);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--ha-purple-light)"><i class="fas fa-box"></i></div>
                                        @endif
                                        <strong style="color:var(--ha-text)">{{ $item['name'] }}</strong>
                                    </div>
                                </td>
                                <td style="font-family:'JetBrains Mono',monospace;color:var(--ha-muted)">${{ number_format($item['price'], 2) }}</td>
                                <td style="color:var(--ha-muted)">{{ $item['quantity'] }}</td>
                                <td style="font-weight:700;color:var(--ha-purple-light);font-family:'JetBrains Mono',monospace">${{ number_format($subtotal, 2) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('shop.cart.remove', $id) }}">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="background:var(--ha-surface);border-radius:14px;padding:1.6rem;border:1px solid var(--ha-border)">
                <h3 style="font-family:'Syne',sans-serif;font-weight:800;margin-bottom:1.3rem;color:var(--ha-text);font-size:1rem;text-transform:uppercase;letter-spacing:.5px">Order Summary</h3>
                <div style="display:flex;justify-content:space-between;margin-bottom:.7rem;font-size:.9rem;color:var(--ha-muted)">
                    <span>Subtotal</span><span style="font-family:'JetBrains Mono',monospace;color:var(--ha-text)">${{ number_format($total, 2) }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:.7rem;font-size:.9rem;color:var(--ha-muted)">
                    <span>Shipping</span><span style="color:var(--ha-neon);font-weight:600">Free</span>
                </div>
                <div style="border-top:1px solid var(--ha-border);margin:1rem 0"></div>
                <div style="display:flex;justify-content:space-between;font-size:1.1rem;font-weight:700;margin-bottom:1.5rem">
                    <span style="color:var(--ha-text)">Total</span>
                    <span style="color:var(--ha-purple-light);font-family:'JetBrains Mono',monospace">${{ number_format($total, 2) }}</span>
                </div>
                @auth
                    <a href="{{ route('shop.checkout') }}" class="btn btn-primary" style="width:100%;justify-content:center;padding:.85rem">
                        <i class="fas fa-lock"></i> Proceed to Checkout
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%;justify-content:center;padding:.85rem">
                        <i class="fas fa-right-to-bracket"></i> Login to Checkout
                    </a>
                @endauth
                <a href="{{ route('shop.products') }}" class="btn btn-secondary" style="width:100%;justify-content:center;margin-top:.7rem">
                    Continue Shopping
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
