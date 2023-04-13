<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = new Cart;
        $cart->product_id = $validatedData['product_id'];
        $cart->quantity = 1; // default quantity is 1
        $cart->save();

        return back()->with('success', 'Product added to cart successfully.');
    }
    public function index()
    {
        $cartItems = cart::getCartItems();
        $cartTotal = cart::totalCartPrice();
        $cartCount = cart::cartCount();
                
        $products = $cartItems->pluck('product')->unique();
        $items = [];
        foreach ($products as $product) {
            $quantity = $cartItems->where('product_id', $product->id)->sum('quantity');
            $items[] = [
                'product_id' => $product,
                'quantity' => $quantity,
            ];
        }
                
        $carts = cart::all();
        return view('carts.index', compact('carts', 'items', 'cartCount', 'cartTotal'));
    }

    public function show($id)
    {
        $cart = cart::find($id);
        $product = $cart->product_id;

        return view('carts.show', compact('cart', 'product'));
    }

    public function store(Request $request)
    {
        $cart = cart::where('product_id', $request->product_id)->first();
        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            cart::create($request->all());
        }
        return redirect()->back();
    }

    public function update(Request $request, Cart $cart)
    {
        $cart->quantity = $request->quantity;
        $cart->save();
        return redirect()->back();
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->back();
    }
}