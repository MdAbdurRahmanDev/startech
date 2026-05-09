<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title', 'slug', 'image', 'short_description', 
        'long_description', 'start_date', 'end_date', 'type', 'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true)
                     ->where('start_date', '<=', now())
                     ->where('end_date', '>=', now());
    }
}
