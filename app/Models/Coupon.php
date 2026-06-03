<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'type', 'value', 'min_order', 'max_discount',
        'max_uses', 'used_count', 'expires_at', 'status',
    ];

    protected $casts = [
        'expires_at' => 'date',
    ];

    public function isValid(float $orderTotal): array
    {
        if (!$this->status) {
            return ['valid' => false, 'message' => 'This coupon is inactive.'];
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return ['valid' => false, 'message' => 'This coupon has expired.'];
        }

        if ($this->max_uses !== null && $this->used_count >= $this->max_uses) {
            return ['valid' => false, 'message' => 'This coupon has reached its usage limit.'];
        }

        if ($orderTotal < $this->min_order) {
            return ['valid' => false, 'message' => 'Minimum order amount of ' . number_format($this->min_order, 0) . '৳ required.'];
        }

        return ['valid' => true, 'message' => 'Coupon applied successfully!'];
    }

    public function calculateDiscount(float $orderTotal): float
    {
        if ($this->type === 'percent') {
            $discount = $orderTotal * ($this->value / 100);
            if ($this->max_discount) {
                $discount = min($discount, $this->max_discount);
            }
            return round($discount, 2);
        }

        return min($this->value, $orderTotal);
    }
}
