@extends('layouts.admin')
@section('title', 'Edit Subcategory')
@section('content')
<div class="card" style="max-width:600px">
    <div class="card-header">
        <h2><i class="fas fa-edit" style="color:var(--gold)"></i> Edit Subcategory</h2>
        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.subcategories.update', $subcategory) }}">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Parent Category *</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $subcategory->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $subcategory->name) }}" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $subcategory->description) }}</textarea>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="is_active" id="is_active" {{ $subcategory->is_active ? 'checked' : '' }}>
                    <label for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
        </form>
    </div>
</div>
@endsection
