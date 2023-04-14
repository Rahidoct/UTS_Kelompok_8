<?php

namespace App\Models;

use App\Models\transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id', 
        'quantity'
    ];

    public function transaction()
    {
        return $this->belongsTo(transaction::class);
    }
}
