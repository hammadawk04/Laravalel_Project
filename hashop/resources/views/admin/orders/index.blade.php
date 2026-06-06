@extends('layouts.admin')
@section('title', 'Orders')
@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-shopping-bag" style="color:var(--gold)"></i> All Orders</h2>
    </div>
    <table>
        <thead>
            <tr><th>#</th><th>Customer</th><th>Total</th><th>Status</th><th>Date</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td style="font-family:'DM Mono',monospace;color:var(--muted)">#{{ $order->id }}</td>
                <td>{{ $order->user->name }}<br><small style="color:var(--muted)">{{ $order->user->email }}</small></td>
                <td style="font-family:'DM Mono',monospace;font-weight:600;color:var(--gold)">${{ number_format($order->total_amount, 2) }}</td>
                <td><span class="badge badge-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span></td>
                <td style="color:var(--muted)">{{ $order->created_at->format('M d, Y H:i') }}</td>
                <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i> View</a></td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;padding:2rem;color:var(--muted)">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="card-body">{{ $orders->links() }}</div>
</div>
@endsection
