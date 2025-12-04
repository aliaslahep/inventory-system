<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view with key statistics.
     */
    public function index(): View
    {
        // Fetch the total count of Products and Categories
        $totalProducts = Product::count();
        $totalCategories = Category::count();

        return view('dashboard', [
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
        ]);
    }
}