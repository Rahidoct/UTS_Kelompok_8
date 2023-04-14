<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\product;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\transactionDetail;

class BuyNowController extends Controller
{
    public function buyNow(Request $request)
    {
        // Mendapatkan data produk yang dibeli
        $product = product::find($request->product_id);

        // Memanggil controller TransactionController untuk membuat data transaksi
        $transactionController = new TransactionController();
        $transaction = $transactionController->store([
            'date' => date('Y-m-d H:i:s'),
            'status' => 'completed'
        ]);

        // Memanggil controller TransactionDetailController untuk membuat data transaksi detail
        $product = product::find($request->product_id);
        $requestDetail = new Request([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price
        ]);

        $transactionDetailController = new TransactionDetailController();
        $transactionDetail = $transactionDetailController->store($requestDetail);

        
        $transactionDetailController = new TransactionDetailController();
        $transactionDetail = $transactionDetailController->store($requestDetail);
    
        // Menghapus data cart
        cart::where('product_id', $product->id)->delete();
    
        // Redirect ke halaman invoice
        return redirect()->route('invoice', ['transaction_id' => $transaction->id]);
    }    

    public function store(Request $request)
    {
        // mengambil data dari request yang dikirimkan
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        // menyimpan data ke dalam cart
        $cart = new Cart;
        $cart->product_id = $product_id;
        $cart->quantity = $quantity;
        $cart->save();

        // mengirimkan pesan berhasil ditambahkan ke cart
        return redirect()->back()->with('success', 'Product has been added to cart.');
    }

}