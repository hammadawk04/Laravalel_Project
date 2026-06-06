@extends('layouts.shop')
@section('title', 'All Products')
@section('content')

<div class="container" style="padding-top:2.5rem;padding-bottom:3rem">
    <div style="display:grid;grid-template-columns:240px 1fr;gap:2rem;align-items:start">

        {{-- Sidebar --}}
        <aside>
            <div style="background:var(--ha-surface);border-radius:12px;padding:1.5rem;border:1px solid var(--ha-border);position:sticky;top:86px">
                <h3 style="font-family:'Syne',sans-serif;font-weight:800;margin-bottom:1.2rem;color:var(--ha-text);font-size:1rem;text-transform:uppercase;letter-spacing:.5px">Filters</h3>
                <form method="GET" action="{{ route('shop.products') }}">
                    <div class="form-group">
                        <label>Search</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search products...">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price Range</label>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.5rem">
                            <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}" min="0">
                            <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}" min="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sort By</label>
                        <select name="sort" class="form-control">
                            <option value="">Newest</option>
                            <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Price: Low → High</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High → Low</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center"><i class="fas fa-filter"></i> Apply</button>
                    <a href="{{ route('shop.products') }}" class="btn btn-secondary" style="width:100%;margin-top:.5rem;text-align:center;justify-content:center">Clear</a>
                </form>
            </div>
        </aside>

        {{-- Products --}}
        <div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
                <h2 style="font-family:'Syne',sans-serif;font-size:1.2rem;font-weight:800;color:var(--ha-text)">
                    <span style="color:var(--ha-purple-light)">{{ $products->total() }}</span> Products Found
                </h2>
            </div>
            @if($products->count())
                <div class="products-grid">
                    @foreach($products as $product)
                        @include('shop.partials.product-card')
                    @endforeach
                </div>
                <div style="margin-top:2rem">{{ $products->links() }}</div>
            @else
                <div style="text-align:center;padding:5rem;background:var(--ha-surface);border-radius:12px;border:1px solid var(--ha-border)">
                    <i class="fas fa-magnifying-glass" style="font-size:3rem;margin-bottom:1rem;display:block;color:var(--ha-subtle)"></i>
                    <p style="font-size:1.05rem;color:var(--ha-muted);margin-bottom:1.2rem">No products found. Try different filters.</p>
                    <a href="{{ route('shop.products') }}" class="btn btn-primary">View All Products</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
