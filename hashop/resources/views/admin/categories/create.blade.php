@extends('layouts.admin')
@section('title', 'Add Category')
@section('content')
<div class="card" style="max-width:600px">
    <div class="card-header">
        <h2><i class="fas fa-plus" style="color:var(--gold)"></i> Add New Category</h2>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Category Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="e.g. Electronics">
                @error('name')<small style="color:#c0392b">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Optional description...">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @error('image')<small style="color:#c0392b">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="is_active" id="is_active" checked>
                    <label for="is_active">Active (visible on shop)</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Category</button>
        </form>
    </div>
</div>
@endsection
