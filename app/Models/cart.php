<?php

namespace App\Models;

use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public static function totalCartPrice()
    {
        return self::leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->selectRaw('SUM(products.price * carts.quantity) as total_price')
            ->first()->total_price;
    }

    public static function cartCount()
    {
        return cart::sum('quantity');
    }

    public static function getCartItems()
    {
        return cart::with('product')->get();
    }

}
