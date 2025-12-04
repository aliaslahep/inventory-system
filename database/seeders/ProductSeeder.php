<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        
        $electronics = Category::where('name', 'Electronics')->first()->id;
        $apparel = Category::where('name', 'Apparel')->first()->id;
        $homeGoods = Category::where('name', 'Home Goods')->first()->id;

        
        $product1 = Product::create([
            'name' => 'Laptop Pro X13',
            'sku' => 'LPX13-001',
            'price' => 1499.99,
            'quantity' => 12,
            'description' => 'Ultra-thin business laptop with 16GB RAM.',
            'status' => 'active',
        ]);
        $product1->categories()->attach($electronics);

        $product2 = Product::create([
            'name' => 'Ergo Wireless Mouse',
            'sku' => 'EWM-05',
            'price' => 45.00,
            'quantity' => 55,
            'description' => 'Ergonomic mouse for comfortable all-day use.',
            'status' => 'active',
        ]);
        
        $product2->categories()->attach($electronics);

        
        $product3 = Product::create([
            'name' => 'Cotton Crew Neck Tee',
            'sku' => 'CNT-BLK-M',
            'price' => 25.50,
            'quantity' => 80,
            'description' => 'Basic black crew neck cotton T-shirt.',
            'status' => 'active',
        ]);
        $product3->categories()->attach($apparel);

        
        $product4 = Product::create([
            'name' => 'LED Task Lamp',
            'sku' => 'LTL-D200',
            'price' => 75.99,
            'quantity' => 30,
            'description' => 'Adjustable LED lamp for desk work.',
            'status' => 'inactive',
        ]);
        $product4->categories()->attach($homeGoods);
        
        $product5 = Product::create([
            'name' => 'Travel Backpack 40L',
            'sku' => 'TBP-40L',
            'price' => 120.00,
            'quantity' => 25,
            'description' => 'Waterproof travel backpack.',
            'status' => 'active',
        ]);
        $product5->categories()->attach([$apparel, $homeGoods]);
    }
}