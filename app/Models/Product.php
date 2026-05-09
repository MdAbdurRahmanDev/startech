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
        'brand_id',
        'supplier_id',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
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
