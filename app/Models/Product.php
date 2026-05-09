<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'tags',
        'buy_price',
        'price',
        'discount_price',
        'stock',
        'thumbnail',
        'is_featured',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class);
    }
}
