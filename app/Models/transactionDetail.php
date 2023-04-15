<?php

namespace App\Models;

use App\Models\product;
use App\Models\transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id', 
        'quantity',
        'price'
    ];

    public function transaction()
    {
        return $this->belongsTo(transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}