@extends('layouts.admin')
@section('title', 'Add Product')
@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-plus" style="color:var(--gold)"></i> Add New Product</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Product Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')<small style="color:#c0392b">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label>Category *</label>
                    <select name="category_id" class="form-control" required id="categorySelect">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Subcategory</label>
                    <select name="subcategory_id" class="form-control" id="subcategorySelect">
                        <option value="">-- None --</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}" data-category="{{ $sub->category_id }}" {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Stock *</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" min="0" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Price ($) *</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label>Sale Price ($) <small style="color:var(--muted)">optional</small></label>
                    <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}" step="0.01" min="0">
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label>Product Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div style="display:flex;gap:2rem;margin-bottom:1.5rem">
                <div class="form-check">
                    <input type="checkbox" name="is_active" id="is_active" checked>
                    <label for="is_active">Active</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="is_featured" id="is_featured">
                    <label for="is_featured">Featured (shown on homepage)</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Product</button>
        </form>
    </div>
</div>
@push('scripts')
<script>
document.getElementById('categorySelect').addEventListener('change', function() {
    const catId = this.value;
    const subSelect = document.getElementById('subcategorySelect');
    subSelect.querySelectorAll('option').forEach(opt => {
        opt.style.display = (!opt.value || opt.dataset.category == catId) ? '' : 'none';
    });
    subSelect.value = '';
});
</script>
@endpush
@endsection
