<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// app/Models/CustomerType.php
class CustomerType extends Model
{
    protected $primaryKey = 'customer_type_id';
    protected $fillable = ['customer_type_description'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_type_id');
    }
}