<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\product;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\transactionDetail;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = new cart;
        $cart->product_id = $validatedData['product_id'];
        $cart->quantity = 1; // default quantity is 1
        $cart->save();

        return back()->with('success', 'Product added to cart successfully.');
    }

    public function checkout()
    {
        $carts = cart::all();
        // Mendapatkan data produk yang dibeli
        $product = product::all();

        // Membuat transaksi baru
        $transaction = transaction::create([
            'date' => date('Y-m-d H:i:s'),
            'status' => 'success',
        ]);

        // Menyimpan detail transaksi
        foreach (cart::all() as $cart) {
            transactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
        }

        // Menghitung harga total dari semua item di keranjang belanja
        $total = cart::all()->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        // Menghapus semua item di keranjang belanja
        cart::destroy(cart::pluck('id')->toArray());

        // Mengambil data detail transaksi yang baru dibuat
        $transactionDetails = transactionDetail::where('transaction_id', $transaction->id)->get();

        // Mengirimkan data detail transaksi ke halaman invoice
        return view('carts.invoice', compact('transactionDetails'));
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