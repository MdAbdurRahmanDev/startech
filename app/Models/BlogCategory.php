<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'status', 'sort_order'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function activeBlogs()
    {
        return $this->hasMany(Blog::class)->where('status', 1)->orderBy('sort_order')->orderBy('published_at', 'desc');
    }
}
