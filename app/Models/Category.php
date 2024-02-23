<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'visibility',
        'sort_by',
        'create_by',
        'thumbnail',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    Public function products ()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id')->withTimestamps();
    }

    public function categoryLink ()
    {
        $categoryLink = str_replace(' ', '-', $this->attributes['name']);
        return $categoryLink;
    }
}
