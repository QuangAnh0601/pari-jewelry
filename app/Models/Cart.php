<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        // 'customer_id',
    ];

    public function customer ()
    {
        return $this->belongsTo(Customer::class);
    }

    public function products ()
    {
        return $this->belongsToMany(Product::class, 'cart_product', 'cart_id', 'product_id')->withPivot('quantity')->withTimestamps();
    }
}
