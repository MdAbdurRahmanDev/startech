<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'app_name',
        'logo',
        'favicon',
        'contact_email',
        'phone_number',
        'address',
        'footer_text',
        'facebook_url',
        'whatsapp_number',
        'youtube_url',
        'instagram_url',
    ];
}
