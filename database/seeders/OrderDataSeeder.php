<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;          // Add this
use App\Models\CustomerType;     // Add this
use App\Models\PaymentType;      // Add this

class OrderDataSeeder extends Seeder
{
    public function run()
    {
        // Create sample products
        $products = [
            [
                'product_name' => 'Laptop', 
                'product_price' => 999.99,
                'product_quantity_stock' => 50,
                'product_status' => 'In Stock'
            ],
            [
                'product_name' => 'Mouse', 
                'product_price' => 19.99,
                'product_quantity_stock' => 100,
                'product_status' => 'In Stock'
            ]
        ];
        
        foreach ($products as $product) {
            Product::create($product);
        }

        // Create customer types
        $customerTypes = [
            ['customer_type_description' => 'Regular'],
            ['customer_type_description' => 'Premium']
        ];
        
        foreach ($customerTypes as $type) {
            CustomerType::create($type);
        }

        // Create payment types
        $paymentTypes = [
            ['payment_type_description' => 'Credit Card'],
            ['payment_type_description' => 'Cash']
        ];
        
        foreach ($paymentTypes as $type) {
            PaymentType::create($type);
        }
    }
}