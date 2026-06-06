<?php
namespace Database\Seeders;

use App\Models\{Category, Product, Subcategory, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@hashop.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Sample customer
        User::create([
            'name'     => 'John Customer',
            'email'    => 'customer@hashop.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
        ]);

        // Categories
        $electronics = Category::create(['name' => 'Electronics', 'description' => 'Latest gadgets and tech']);
        $clothing    = Category::create(['name' => 'Clothing',    'description' => 'Fashion for everyone']);
        $home        = Category::create(['name' => 'Home & Garden','description' => 'Make your home beautiful']);

        // Subcategories
        $phones    = Subcategory::create(['category_id' => $electronics->id, 'name' => 'Phones']);
        $laptops   = Subcategory::create(['category_id' => $electronics->id, 'name' => 'Laptops']);
        $mens      = Subcategory::create(['category_id' => $clothing->id,    'name' => "Men's Clothing"]);
        $womens    = Subcategory::create(['category_id' => $clothing->id,    'name' => "Women's Clothing"]);
        $furniture = Subcategory::create(['category_id' => $home->id,        'name' => 'Furniture']);

        // Products
        $products = [
            ['name' => 'iPhone 15 Pro', 'price' => 999.99, 'sale_price' => 949.99, 'stock' => 50, 'category_id' => $electronics->id, 'subcategory_id' => $phones->id, 'is_featured' => true],
            ['name' => 'Samsung Galaxy S24', 'price' => 799.99, 'stock' => 30, 'category_id' => $electronics->id, 'subcategory_id' => $phones->id, 'is_featured' => true],
            ['name' => 'MacBook Pro 14"', 'price' => 1999.99, 'sale_price' => 1799.99, 'stock' => 20, 'category_id' => $electronics->id, 'subcategory_id' => $laptops->id, 'is_featured' => true],
            ['name' => 'Dell XPS 15', 'price' => 1499.99, 'stock' => 15, 'category_id' => $electronics->id, 'subcategory_id' => $laptops->id],
            ['name' => 'Classic White T-Shirt', 'price' => 29.99, 'stock' => 100, 'category_id' => $clothing->id, 'subcategory_id' => $mens->id],
            ['name' => 'Floral Summer Dress', 'price' => 59.99, 'sale_price' => 39.99, 'stock' => 60, 'category_id' => $clothing->id, 'subcategory_id' => $womens->id, 'is_featured' => true],
            ['name' => 'Leather Sofa', 'price' => 899.99, 'stock' => 10, 'category_id' => $home->id, 'subcategory_id' => $furniture->id],
            ['name' => 'Oak Dining Table', 'price' => 499.99, 'sale_price' => 399.99, 'stock' => 8, 'category_id' => $home->id, 'subcategory_id' => $furniture->id],
        ];

        foreach ($products as $p) {
            Product::create(array_merge($p, [
                'description' => 'High quality product with excellent features.',
                'is_active'   => true,
                'is_featured' => $p['is_featured'] ?? false,
                'sale_price'  => $p['sale_price'] ?? null,
            ]));
        }
    }
}
