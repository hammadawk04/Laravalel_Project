@extends('layouts.admin')
@section('title', 'Products')
@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-box" style="color:var(--gold)"></i> All Products</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>
    </div>
    <table>
        <thead>
            <tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-preview">
                    @else
                        <div style="width:48px;height:48px;background:var(--sand);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--gold)"><i class="fas fa-box"></i></div>
                    @endif
                </td>
                <td>
                    <strong style="color:var(--espresso)">{{ $product->name }}</strong>
                    @if($product->is_featured) <span class="badge badge-warning" style="margin-left:4px">Featured</span> @endif
                </td>
                <td>{{ $product->category->name }}</td>
                <td style="font-family:'DM Mono',monospace">
                    @if($product->sale_price)
                        <span style="color:var(--gold);font-weight:700">${{ $product->sale_price }}</span>
                        <span style="text-decoration:line-through;color:var(--muted);font-size:.8rem"> ${{ $product->price }}</span>
                    @else
                        ${{ $product->price }}
                    @endif
                </td>
                <td><span class="badge badge-{{ $product->stock < 5 ? 'danger' : 'success' }}">{{ $product->stock }}</span></td>
                <td><span class="badge badge-{{ $product->is_active ? 'success' : 'danger' }}">{{ $product->is_active ? 'Active' : 'Off' }}</span></td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display:inline" onsubmit="return confirm('Delete this product?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;padding:2rem;color:var(--muted)">No products. <a href="{{ route('admin.products.create') }}" style="color:var(--gold)">Add one!</a></td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="card-body">{{ $products->links() }}</div>
</div>
@endsection
