<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\transactionDetail;

class TransactionController extends Controller
{
    public function index()
    {
        // Mengambil data transaksi dari database
        $transactions = transaction::all();

        // Menampilkan halaman view "transactions" dan mengirim data transaksi ke dalam view
        return view('transactions', ['transactions' => $transactions]);
    }

    public function showInvoice($transaction_id)
    {
        // Mengambil data transaksi dari database berdasarkan ID transaksi
        $transaction = transaction::find($transaction_id);

        // Jika transaksi tidak ditemukan, tampilkan error 404
        if (!$transaction) {
            abort(404);
        }

        // Mengambil data detail transaksi dari database berdasarkan ID transaksi
        $transaction_details = transactionDetail::where('transaction_id', $transaction_id)->get();

        // Menampilkan halaman view "invoice" dan mengirim data transaksi dan detail transaksi ke dalam view
        return view('invoice', ['transaction' => $transaction, 'transaction_details' => $transaction_details]);
    }

    public function store($data)
    {
        $transaction = new transaction;
        $transaction->date = $data['date'];
        $transaction->status = $data['status'];
        $transaction->save();

        return $transaction;
    }
}

