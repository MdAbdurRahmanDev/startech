<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Banner extends Model
{
    protected $fillable = [
        'image',
        'link',
        'type',
        'title',
        'subtitle',
        'description',
        'button_text',
        'status',
        'order',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (! $this->image) {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, '/')) {
            return asset(ltrim($this->image, '/'));
        }

        if (Str::startsWith($this->image, 'storage/')) {
            return asset($this->image);
        }

        return asset('storage/' . ltrim($this->image, '/'));
    }
}
