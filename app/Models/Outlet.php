<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $fillable = ['name', 'address', 'phones', 'timing', 'off_day', 'map_link', 'status', 'sort_order'];
    protected $casts = ['phones' => 'array'];
}
