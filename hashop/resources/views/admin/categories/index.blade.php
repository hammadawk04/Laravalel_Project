@extends('layouts.admin')
@section('title', 'Categories')
@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-tags" style="color:var(--gold)"></i> All Categories</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Category</a>
    </div>
    <table>
        <thead>
            <tr><th>Image</th><th>Name</th><th>Products</th><th>Subcategories</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" class="img-preview">
                    @else
                        <div style="width:48px;height:48px;background:var(--sand);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--gold)"><i class="fas fa-image"></i></div>
                    @endif
                </td>
                <td><strong style="color:var(--espresso)">{{ $category->name }}</strong><br><small style="color:var(--muted);font-family:'DM Mono',monospace">{{ $category->slug }}</small></td>
                <td><span class="badge badge-primary">{{ $category->products_count }}</span></td>
                <td><span class="badge badge-info">{{ $category->subcategories_count }}</span></td>
                <td><span class="badge badge-{{ $category->is_active ? 'success' : 'danger' }}">{{ $category->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" style="display:inline" onsubmit="return confirm('Delete this category?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;padding:2rem;color:var(--muted)">No categories. <a href="{{ route('admin.categories.create') }}" style="color:var(--gold)">Add one!</a></td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="card-body">{{ $categories->links() }}</div>
</div>
@endsection
