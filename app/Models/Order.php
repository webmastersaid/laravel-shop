<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $guarded = false;

    const PAYMENT_FAILED = 0;
    const PAYMENT_SUCCESS = 1;

    static function getPaymentStatus()
    {
        return [
            self::PAYMENT_FAILED => 'Failed',
            self::PAYMENT_SUCCESS => 'Success',
        ];
    }

    public function getPaymentStatusTitleAttribute()
    {
        return self::getPaymentStatus()[$this->payment_status];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
