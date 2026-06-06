@extends('layouts.admin')
@section('title', 'Edit Product')
@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-edit" style="color:var(--gold)"></i> Edit Product</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-row">
                <div class="form-group">
                    <label>Product Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Category *</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Subcategory</label>
                    <select name="subcategory_id" class="form-control">
                        <option value="">-- None --</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}" {{ $product->subcategory_id == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Stock *</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Price ($) *</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label>Sale Price ($)</label>
                    <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}" step="0.01" min="0">
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="form-group">
                <label>Product Image</label>
                @if($product->image)
                    <div style="margin-bottom:.5rem"><img src="{{ asset('storage/' . $product->image) }}" style="width:100px;height:100px;object-fit:cover;border-radius:8px;border:1px solid var(--warm)"></div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div style="display:flex;gap:2rem;margin-bottom:1.5rem">
                <div class="form-check">
                    <input type="checkbox" name="is_active" id="is_active" {{ $product->is_active ? 'checked' : '' }}>
                    <label for="is_active">Active</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="is_featured" id="is_featured" {{ $product->is_featured ? 'checked' : '' }}>
                    <label for="is_featured">Featured</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Product</button>
        </form>
    </div>
</div>
@endsection
