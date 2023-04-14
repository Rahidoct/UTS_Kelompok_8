<?php

namespace App\Models;

use App\Models\transactionDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 
        'status'
    ];

    public function transactionDetails()
    {
        return $this->hasMany(transactionDetail::class);
    }
}
