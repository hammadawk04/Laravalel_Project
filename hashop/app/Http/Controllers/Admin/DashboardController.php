<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, Order, Product, User};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'      => User::where('role', 'customer')->count(),
            'total_products'   => Product::count(),
            'total_orders'     => Order::count(),
            'total_categories' => Category::count(),
            'recent_orders'    => Order::with('user')->latest()->take(5)->get(),
            'revenue'          => Order::where('status', 'delivered')->sum('total_amount'),
        ];
        return view('admin.dashboard.index', compact('stats'));
    }
}
