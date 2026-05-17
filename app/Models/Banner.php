<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
