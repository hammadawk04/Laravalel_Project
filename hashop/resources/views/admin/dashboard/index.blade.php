@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-shopping-bag"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_orders'] }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon amber"><i class="fas fa-box"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_products'] }}</div>
            <div class="stat-label">Products</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon neon"><i class="fas fa-users"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Customers</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-dollar-sign"></i></div>
        <div>
            <div class="stat-value">${{ number_format($stats['revenue'], 0) }}</div>
            <div class="stat-label">Revenue</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-clock" style="color:var(--gold)"></i> Recent Orders</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
    <table>
        <thead>
            <tr><th>#</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th><th>Action</th></tr>
        </thead>
        <tbody>
            @forelse($stats['recent_orders'] as $order)
            <tr>
                <td style="font-family:'DM Mono',monospace;color:var(--muted)">#{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td style="font-family:'DM Mono',monospace;font-weight:600;color:var(--gold)">${{ number_format($order->total_amount, 2) }}</td>
                <td><span class="badge badge-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span></td>
                <td style="color:var(--muted)">{{ $order->created_at->format('M d, Y') }}</td>
                <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a></td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
    <div class="card">
        <div class="card-header"><h2>Quick Actions</h2></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:.7rem">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-secondary"><i class="fas fa-plus"></i> Add Category</a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-outline"><i class="fas fa-user-plus"></i> Add User</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h2>Catalog ({{ $stats['total_categories'] }} categories)</h2></div>
        <div class="card-body">
            <p style="color:var(--muted);font-size:.875rem">Manage your product catalog by adding and organizing categories and subcategories.</p>
            <div style="margin-top:1rem;display:flex;gap:.5rem">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm">Categories</a>
                <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary btn-sm">Subcategories</a>
            </div>
        </div>
    </div>
</div>

@endsection
