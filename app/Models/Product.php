<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cost',
        'price',
        'description',
        'material',
        'weight',
        'status',
        'brand',
        'visibility',
        'create_by',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    public function productImages ()
    {
        return $this->hasMany(ProductImage::class);
    }

    Public function categories ()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id')->withTimestamps();
    }

    public function stocks ()
    {
        return $this->belongsToMany(Stock::class, 'product_stock', 'product_id', 'stock_id')->withPivot('quantity', 'out_of_date')->withTimestamps();
    }

    public function customers ()
    {
        return $this->belongsToMany(Customer::class, 'customer_product', 'product_id', 'customer_id')->withTimestamps();
    }

    public function carts ()
    {
        return $this->belongsToMany(Cart::class, 'cart_product', 'product_id', 'cart_id')->withTimestamps();
    }

    public function orderDetails ()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function reviews ()
    {
        return $this->hasMany(Review::class);
    }

    public function materialLink ()
    {
        $materialLink = str_replace(' ', '-', $this->attributes['material']);
        return $materialLink;
    }

    public function brandLink ()
    {
        $brandLink = str_replace(' ', '-', $this->attributes['brand']);
        return $brandLink;
    }

    public function getImage ()
    {
        $image = $this->productImages->first() ? $this->productImages->first()->file_name : "no-image.png";
        return $image;
    }

    public function getRating ()
    {
        return $this->reviews()->selectRaw('AVG(rating) as avg_rating, reviews.product_id as product_id')->groupBy('product_id')->first();
    }

}
