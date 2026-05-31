<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table = 'blog_comments';

    protected $fillable = [
        'blog_id',
        'parent_id',
        'name',
        'email',
        'comment',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Blog
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    // Relationship for nested/reply comments
    public function replies()
    {
        return $this->hasMany(BlogComment::class, 'parent_id')->where('status', true);
    }

    public function parent()
    {
        return $this->belongsTo(BlogComment::class, 'parent_id');
    }

    // Scope for approved comments
    public function scopeApproved($query)
    {
        return $query->where('status', true);
    }
}
