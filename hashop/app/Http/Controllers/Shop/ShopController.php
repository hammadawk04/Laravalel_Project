<?php
namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\{Category, Order, OrderItem, Product};
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $featured   = Product::where('is_active', true)->where('is_featured', true)->take(8)->get();
        $categories = Category::where('is_active', true)->withCount('products')->take(6)->get();
        $newest     = Product::where('is_active', true)->latest()->take(8)->get();
        return view('shop.index', compact('featured', 'categories', 'newest'));
    }

    public function products(Request $request)
    {
        $query = Product::where('is_active', true)->with('category');

        if ($request->category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->subcategory) {
            $query->whereHas('subcategory', fn($q) => $q->where('slug', $request->subcategory));
        }
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->sort === 'price_asc') {
            $query->orderBy('price');
        } elseif ($request->sort === 'price_desc') {
            $query->orderByDesc('price');
        } else {
            $query->latest();
        }

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->get();
        return view('shop.products', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)->get();
        return view('shop.product', compact('product', 'related'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('shop.cart', compact('cart'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $qty  = $request->quantity ?? 1;

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $qty;
        } else {
            $cart[$product->id] = [
                'name'     => $product->name,
                'price'    => $product->sale_price ?? $product->price,
                'quantity' => $qty,
                'image'    => $product->image,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Product added to cart!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back()->with('success', 'Item removed from cart.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('shop.cart');
        return view('shop.checkout', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'phone'            => 'required|string',
        ]);

        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'user_id'          => auth()->id(),
            'total_amount'     => $total,
            'shipping_address' => $request->shipping_address,
            'phone'            => $request->phone,
            'notes'            => $request->notes,
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
            // Reduce stock
            Product::find($productId)?->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');
        return redirect()->route('shop.orders')->with('success', 'Order placed successfully!');
    }

    public function orders()
    {
        $orders = auth()->user()->orders()->with('items.product')->latest()->get();
        return view('shop.orders', compact('orders'));
    }
}
