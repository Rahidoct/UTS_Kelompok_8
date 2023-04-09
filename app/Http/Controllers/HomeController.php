<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = category::all();
        $products = product::all();
        return view('home', compact('categories', 'products'));
    }
    public function showProductsByCategory($categoryId)
    {
        $category = category::find($categoryId)->get();

        if (!$category) {
            throw new \Exception('Kategori tidak ditemukan');
        }

        $categories = category::all();
        $products = product::where('category_id', $categoryId)->get();

        return view('products_by_category', compact('category','categories','products'));
    }
  
}
