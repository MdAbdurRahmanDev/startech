<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company_name', 
        'project_type', 'budget_range', 'project_description', 
        'attachment', 'status'
    ];
}
