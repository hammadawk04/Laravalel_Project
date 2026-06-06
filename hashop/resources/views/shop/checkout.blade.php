@extends('layouts.shop')
@section('title', 'Checkout')
@section('content')

<div class="container" style="padding:2.5rem 1.5rem">
    <h1 style="font-family:'Syne',sans-serif;font-size:1.8rem;font-weight:800;color:var(--ha-text);margin-bottom:2rem;display:flex;align-items:center;gap:.7rem">
        <i class="fas fa-lock" style="color:var(--ha-purple-light)"></i> Checkout
    </h1>

    <div style="display:grid;grid-template-columns:3fr 2fr;gap:2rem;align-items:start">
        <div style="background:var(--ha-surface);border-radius:14px;padding:2rem;border:1px solid var(--ha-border)">
            <h3 style="font-family:'Syne',sans-serif;font-weight:800;margin-bottom:1.5rem;color:var(--ha-text);text-transform:uppercase;letter-spacing:.5px;font-size:.9rem">Shipping Information</h3>
            <form method="POST" action="{{ route('shop.order.place') }}">
                @csrf
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled style="opacity:.5">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled style="opacity:.5">
                </div>
                <div class="form-group">
                    <label>Phone Number *</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}" required placeholder="+1 (555) 000-0000">
                    @error('phone')<small style="color:#f87171">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label>Shipping Address *</label>
                    <textarea name="shipping_address" class="form-control" rows="3" required placeholder="Street, City, State, ZIP">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                    @error('shipping_address')<small style="color:#f87171">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label>Order Notes <small style="color:var(--ha-subtle)">(optional)</small></label>
                    <textarea name="notes" class="form-control" rows="2" placeholder="Any special instructions?">{{ old('notes') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;padding:.9rem;font-size:1rem;justify-content:center;border-radius:10px">
                    <i class="fas fa-circle-check"></i> Place Order
                </button>
            </form>
        </div>

        <div style="background:var(--ha-surface);border-radius:14px;padding:1.6rem;border:1px solid var(--ha-border)">
            <h3 style="font-family:'Syne',sans-serif;font-weight:800;margin-bottom:1.2rem;color:var(--ha-text);text-transform:uppercase;letter-spacing:.5px;font-size:.9rem">Your Order</h3>
            @php $total = 0; @endphp
            @foreach($cart as $item)
                @php $sub = $item['price'] * $item['quantity']; $total += $sub; @endphp
                <div style="display:flex;justify-content:space-between;margin-bottom:.8rem;font-size:.88rem;padding-bottom:.8rem;border-bottom:1px solid var(--ha-border)">
                    <span style="color:var(--ha-text)">{{ $item['name'] }} <span style="color:var(--ha-muted)">×{{ $item['quantity'] }}</span></span>
                    <span style="font-weight:600;font-family:'JetBrains Mono',monospace;color:var(--ha-purple-light)">${{ number_format($sub, 2) }}</span>
                </div>
            @endforeach
            <div style="display:flex;justify-content:space-between;font-size:1.1rem;font-weight:700;margin-top:.5rem">
                <span style="color:var(--ha-text)">Total</span>
                <span style="color:var(--ha-purple-light);font-family:'JetBrains Mono',monospace">${{ number_format($total, 2) }}</span>
            </div>
            <div style="margin-top:1.2rem;padding:.85rem;background:rgba(6,214,160,.06);border:1px solid rgba(6,214,160,.15);border-radius:8px;font-size:.78rem;color:var(--ha-muted);display:flex;align-items:center;gap:.5rem">
                <i class="fas fa-shield-halved" style="color:var(--ha-neon)"></i> Secure checkout. Your info is safe.
            </div>
        </div>
    </div>
</div>
@endsection
