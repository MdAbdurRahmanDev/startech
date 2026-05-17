<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'blog_category_id', 'title', 'slug', 'excerpt', 'content',
        'thumbnail', 'author', 'status', 'featured', 'sort_order', 'published_at'
    ];

    protected $casts = [
        'status'       => 'boolean',
        'featured'     => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
            if (empty($blog->published_at)) {
                $blog->published_at = now();
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function getReadTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content ?? ''));
        $minutes = ceil($words / 200);
        return max(1, $minutes) . ' min read';
    }
}
