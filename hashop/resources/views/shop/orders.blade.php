@extends('layouts.shop')
@section('title', 'My Orders')
@section('content')

<div class="container" style="padding:2.5rem 1.5rem">
    <h1 style="font-family:'Syne',sans-serif;font-size:1.8rem;font-weight:800;color:var(--ha-text);margin-bottom:2rem;display:flex;align-items:center;gap:.7rem">
        <i class="fas fa-box" style="color:var(--ha-purple-light)"></i> My Orders
    </h1>

    @forelse($orders as $order)
    <div style="background:var(--ha-surface);border-radius:14px;border:1px solid var(--ha-border);margin-bottom:1.5rem;overflow:hidden;transition:border-color .2s" onmouseover="this.style.borderColor='rgba(124,58,237,.4)'" onmouseout="this.style.borderColor='var(--ha-border)'">
        <div style="padding:1.1rem 1.5rem;background:var(--ha-surface2);display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid var(--ha-border)">
            <div>
                <strong style="color:var(--ha-text);font-family:'Syne',sans-serif">Order #{{ $order->id }}</strong>
                <span style="color:var(--ha-muted);font-size:.78rem;margin-left:.8rem">{{ $order->created_at->format('M d, Y') }}</span>
            </div>
            <div style="display:flex;align-items:center;gap:1rem">
                <span class="badge badge-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span>
                <strong style="color:var(--ha-purple-light);font-family:'JetBrains Mono',monospace">${{ number_format($order->total_amount, 2) }}</strong>
            </div>
        </div>
        <div style="padding:1.2rem 1.5rem">
            @foreach($order->items as $item)
            <div style="display:flex;justify-content:space-between;align-items:center;padding:.45rem 0;border-bottom:1px solid var(--ha-border)">
                <div>
                    <span style="font-weight:500;color:var(--ha-text)">{{ $item->product->name }}</span>
                    <span style="color:var(--ha-muted);font-size:.8rem"> × {{ $item->quantity }}</span>
                </div>
                <span style="font-family:'JetBrains Mono',monospace;color:var(--ha-muted);font-size:.88rem">${{ number_format($item->subtotal, 2) }}</span>
            </div>
            @endforeach
            <div style="margin-top:.9rem;font-size:.8rem;color:var(--ha-muted);display:flex;align-items:center;gap:.4rem">
                <i class="fas fa-location-dot" style="color:var(--ha-purple-light)"></i> {{ $order->shipping_address }}
            </div>
        </div>
    </div>
    @empty
    <div style="text-align:center;padding:5rem;background:var(--ha-surface);border-radius:14px;border:1px solid var(--ha-border)">
        <i class="fas fa-box-open" style="font-size:3.5rem;color:var(--ha-subtle);display:block;margin-bottom:1rem"></i>
        <h3 style="color:var(--ha-muted);margin-bottom:1rem;font-family:'Syne',sans-serif">No orders yet</h3>
        <a href="{{ route('shop.products') }}" class="btn btn-primary">Start Shopping</a>
    </div>
    @endforelse
</div>
@endsection
