<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Admin\{
    DashboardController,
    CategoryController,
    SubcategoryController,
    ProductController,
    UserController,
    OrderController
};

// ─── Auth ──────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ─── Shop (Public) ─────────────────────────────────────────────────
Route::get('/',           [ShopController::class, 'index'])->name('shop.index');
Route::get('/products',   [ShopController::class, 'products'])->name('shop.products');
Route::get('/products/{product}', [ShopController::class, 'show'])->name('shop.product');

// ─── Cart & Orders (Auth) ──────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/cart',                         [ShopController::class, 'cart'])->name('shop.cart');
    Route::post('/cart/add/{product}',          [ShopController::class, 'addToCart'])->name('shop.cart.add');
    Route::delete('/cart/remove/{id}',          [ShopController::class, 'removeFromCart'])->name('shop.cart.remove');
    Route::get('/checkout',                     [ShopController::class, 'checkout'])->name('shop.checkout');
    Route::post('/checkout',                    [ShopController::class, 'placeOrder'])->name('shop.order.place');
    Route::get('/my-orders',                    [ShopController::class, 'orders'])->name('shop.orders');
});

// ─── Admin Panel ───────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/',             [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Subcategories
    Route::resource('subcategories', SubcategoryController::class);

    // Products
    Route::resource('products', ProductController::class);

    // Users & Roles
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/role', [UserController::class, 'updateRole'])->name('users.role');

    // Orders
    Route::get('orders',                          [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}',                  [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status',         [OrderController::class, 'updateStatus'])->name('orders.status');
});
