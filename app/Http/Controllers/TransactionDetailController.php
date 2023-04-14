<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;

class TransactionDetailController extends Controller
{
    public function store(Request $request)
    {
        $product = product::find($request->input('product')->id);

        $transactionDetail = new TransactionDetail;
        $transactionDetail->transaction_id = $request->input('transaction_id');
        $transactionDetail->product_id = $product->id;
        $transactionDetail->quantity = $request->input('quantity');
        $transactionDetail->price = $product->price;
        $transactionDetail->save();

        return $transactionDetail;
    }
}