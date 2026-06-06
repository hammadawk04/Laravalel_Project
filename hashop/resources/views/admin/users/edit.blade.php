@extends('layouts.admin')
@section('title', 'Edit User')
@section('content')
<div class="card" style="max-width:600px">
    <div class="card-header">
        <h2><i class="fas fa-user-edit" style="color:var(--gold)"></i> Edit User</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')
            <div class="form-row">
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>New Password <small style="color:var(--muted)">(leave blank to keep)</small></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label>Role *</label>
                <select name="role" class="form-control" required {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                    <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin"    {{ $user->role === 'admin'    ? 'selected' : '' }}>Admin</option>
                </select>
                @if($user->id === auth()->id())
                    <input type="hidden" name="role" value="{{ $user->role }}">
                    <small style="color:var(--muted)">You cannot change your own role.</small>
                @endif
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update User</button>
        </form>
    </div>
</div>
@endsection
