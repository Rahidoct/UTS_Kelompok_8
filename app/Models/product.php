<?php

namespace App\Models;

use App\Models\cart;
use App\Models\category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function cart()
    {
        return $this->hasMany(cart::class);
    }
}
