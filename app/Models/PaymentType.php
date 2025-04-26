<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// app/Models/PaymentType.php
class PaymentType extends Model
{
    protected $primaryKey = 'payment_type_id';
    protected $fillable = ['payment_type_description'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_type_id');
    }
}