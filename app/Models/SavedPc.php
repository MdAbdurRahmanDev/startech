<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedPc extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'build_data',
        'total_price'
    ];

    protected $casts = [
        'build_data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
