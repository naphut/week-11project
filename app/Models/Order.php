<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Order.php
class Order extends Model
{
    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $fillable = [
        'order_id', 'product_id', 'customer_type_id', 'payment_type_id',
        'order_quantity', 'order_date_time', 'order_status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class, 'customer_type_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }
}
