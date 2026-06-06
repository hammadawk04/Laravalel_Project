@extends('layouts.admin')
@section('title', 'Edit Category')
@section('content')
<div class="card" style="max-width:600px">
    <div class="card-header">
        <h2><i class="fas fa-edit" style="color:var(--gold)"></i> Edit Category</h2>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Category Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                @error('name')<small style="color:#c0392b">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
            </div>
            <div class="form-group">
                <label>Image</label>
                @if($category->image)
                    <div style="margin-bottom:.5rem"><img src="{{ asset('storage/' . $category->image) }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid var(--warm)"></div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="is_active" id="is_active" {{ $category->is_active ? 'checked' : '' }}>
                    <label for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Category</button>
        </form>
    </div>
</div>
@endsection
