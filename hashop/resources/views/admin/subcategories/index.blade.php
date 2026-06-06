@extends('layouts.admin')
@section('title', 'Subcategories')
@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-layer-group" style="color:var(--gold)"></i> All Subcategories</h2>
        <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Subcategory</a>
    </div>
    <table>
        <thead>
            <tr><th>Name</th><th>Parent Category</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($subcategories as $sub)
            <tr>
                <td><strong style="color:var(--espresso)">{{ $sub->name }}</strong><br><small style="color:var(--muted);font-family:'DM Mono',monospace">{{ $sub->slug }}</small></td>
                <td><span class="badge badge-primary">{{ $sub->category->name }}</span></td>
                <td><span class="badge badge-{{ $sub->is_active ? 'success' : 'danger' }}">{{ $sub->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td>
                    <a href="{{ route('admin.subcategories.edit', $sub) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('admin.subcategories.destroy', $sub) }}" style="display:inline" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;padding:2rem;color:var(--muted)">No subcategories. <a href="{{ route('admin.subcategories.create') }}" style="color:var(--gold)">Add one!</a></td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="card-body">{{ $subcategories->links() }}</div>
</div>
@endsection
