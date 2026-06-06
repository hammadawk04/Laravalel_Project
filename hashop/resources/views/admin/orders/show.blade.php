@extends('layouts.admin')
@section('title', 'Order #' . $order->id)
@section('content')
<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">
    <div>
        <div class="card">
            <div class="card-header">
                <h2>Order #{{ $order->id }} — Items</h2>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Back</a>
            </div>
            <table>
                <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr></thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td style="color:var(--espresso)">{{ $item->product->name }}</td>
                        <td style="font-family:'DM Mono',monospace">${{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="font-family:'DM Mono',monospace;font-weight:600">${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align:right;font-weight:700;padding:.75rem 1rem;color:var(--espresso)">Total:</td>
                        <td style="font-weight:700;color:var(--gold);font-size:1.1rem;font-family:'DM Mono',monospace;padding:.75rem 1rem">${{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div>
        <div class="card">
            <div class="card-header"><h2>Customer & Shipping</h2></div>
            <div class="card-body" style="font-size:.9rem;color:var(--brown);line-height:2">
                <p><strong style="color:var(--espresso)">Name:</strong> {{ $order->user->name }}</p>
                <p><strong style="color:var(--espresso)">Email:</strong> {{ $order->user->email }}</p>
                <p><strong style="color:var(--espresso)">Phone:</strong> {{ $order->phone }}</p>
                <p><strong style="color:var(--espresso)">Address:</strong> {{ $order->shipping_address }}</p>
                @if($order->notes)
                    <p><strong style="color:var(--espresso)">Notes:</strong> {{ $order->notes }}</p>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h2>Update Status</h2></div>
            <div class="card-body">
                <p style="margin-bottom:1rem">Current: <span class="badge badge-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span></p>
                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <select name="status" class="form-control">
                            @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center"><i class="fas fa-save"></i> Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
