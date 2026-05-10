<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'first_name', 'last_name', 'email', 'phone', 
        'address', 'upazila', 'district', 'note', 'shipping_method_id', 
        'shipping_cost', 'subtotal', 'total', 'payment_method', 'transaction_id', 'payment_status', 'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function refundRequest()
    {
        return $this->hasOne(RefundRequest::class);
    }
}
