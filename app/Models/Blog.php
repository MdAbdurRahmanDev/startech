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

    public function comments()
    {
        return $this->hasMany(BlogComment::class)->where('parent_id', null)->where('status', true)->orderBy('created_at', 'desc');
    }

    public function allComments()
    {
        return $this->hasMany(BlogComment::class);
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

    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail) {
            return null;
        }

        // If already a full URL, return as-is
        if (Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
            return $this->thumbnail;
        }

        // If starts with /, already absolute path
        if (Str::startsWith($this->thumbnail, '/')) {
            return $this->thumbnail;
        }

        // Bare path like 'blogs/filename.jpg' - directly accessible from public
        return asset($this->thumbnail);
    }
}
