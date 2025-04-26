<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Product.php
class Product extends Model
{
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name', 'product_price', 'product_quantity_stock',
        'product_status', 'product_description'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
}