<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'slug', 'logo', 'phone', 'email', 'address', 'status'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
