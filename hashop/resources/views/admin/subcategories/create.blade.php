@extends('layouts.admin')
@section('title', 'Add Subcategory')
@section('content')
<div class="card" style="max-width:600px">
    <div class="card-header">
        <h2><i class="fas fa-plus" style="color:var(--gold)"></i> Add Subcategory</h2>
        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.subcategories.store') }}">
            @csrf
            <div class="form-group">
                <label>Parent Category *</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<small style="color:#c0392b">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label>Subcategory Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="e.g. Smartphones">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="is_active" id="is_active" checked>
                    <label for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create</button>
        </form>
    </div>
</div>
@endsection
