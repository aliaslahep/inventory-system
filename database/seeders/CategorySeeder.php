<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Electronics', 'description' => 'Gadgets, components, and media devices.']);
        Category::create(['name' => 'Apparel', 'description' => 'Clothing, footwear, and accessories.']);
        Category::create(['name' => 'Home Goods', 'description' => 'Household items, furniture, and decor.']);
        Category::create(['name' => 'Books', 'description' => 'Printed and digital literary works.']);
    }
}