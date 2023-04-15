<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\product;
use App\Models\transaction;
use App\Models\transactionDetail;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Ambil data cart dari session
        $carts = collect(session('carts'));
        
        // Jika cart kosong, redirect ke halaman cart
        if ($carts->isEmpty()) {
            return redirect()->route('carts.index')->with('error', 'Cart kosong.');
        }
        
        // Hitung total harga dari cart
        $total = $carts->sum(function ($cart) {
            return $cart['product']['price'] * $cart['quantity'];
        });
        
        // Tampilkan halaman invoice
        return view('invoice', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        // Memanggil controller TransactionController untuk membuat data transaksi
        $transactions = new TransactionController();
        $transaction = $transactions->store([
            'date' => date('Y-m-d H:i:s'),
            'status' => 'Success'
        ]);

        // Mendapatkan data cart yang akan dibeli
        $carts = cart::all();

        // Memanggil controller TransactionDetailController untuk membuat data transaksi detail
        foreach ($carts as $cart) {
            $requestDetail = new Request([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price
            ]);

            $transactionDetail = new TransactionDetailController();
            $transaction = $transactionDetail->store($requestDetail);
        }

        // Menghapus data cart
        cart::truncate();

        // Redirect ke halaman invoice
        return redirect()->route('invoice', ['transaction_id' => $transaction->id]);
    }
}