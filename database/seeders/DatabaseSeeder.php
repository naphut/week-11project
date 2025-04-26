<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\CustomerType;
use App\Models\PaymentType;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with initial data.
     * Creates sample products, customer types, payment types, and orders.
     */
    public function run()
    {
        // Seed Products
        Product::create(['Product_ID' => 1, 'Product_Name' => 'Laptop', 'Product_Price' => 999.99, 'Product_Quantity_Stock' => 10, 'Product_Status' => 'Active', 'Product_Description' => 'A high-performance laptop']);
        Product::create(['Product_ID' => 2, 'Product_Name' => 'Mouse', 'Product_Price' => 29.99, 'Product_Quantity_Stock' => 50, 'Product_Status' => 'Active', 'Product_Description' => 'A wireless mouse']);

        // Seed Customer Types
        CustomerType::create(['Customer_Type_ID' => 1, 'Customer_Type_Description' => 'Regular']);
        CustomerType::create(['Customer_Type_ID' => 2, 'Customer_Type_Description' => 'Premium']);

        // Seed Payment Types
        PaymentType::create(['Payment_Type_ID' => 1, 'Payment_Type_Description' => 'Credit Card']);
        PaymentType::create(['Payment_Type_ID' => 2, 'Payment_Type_Description' => 'Cash']);

        // Seed Orders (matching the original HTML table data)
        Order::create(['Order_ID' => 1, 'Product_ID' => 1, 'Customer_Type_ID' => 1, 'Payment_Type_ID' => 1, 'Order_Quantity' => 2, 'Order_Date_Time' => '2025-03-21 10:00:00', 'Order_Status' => 'Pending']);
        Order::create(['Order_ID' => 2, 'Product_ID' => 2, 'Customer_Type_ID' => 2, 'Payment_Type_ID' => 2, 'Order_Quantity' => 1, 'Order_Date_Time' => '2025-03-21 12:00:00', 'Order_Status' => 'Shipped']);
        Order::create(['Order_ID' => 3, 'Product_ID' => 1, 'Customer_Type_ID' => 1, 'Payment_Type_ID' => 1, 'Order_Quantity' => 3, 'Order_Date_Time' => '2025-03-21 14:00:00', 'Order_Status' => 'Delivered']);
        Order::create(['Order_ID' => 4, 'Product_ID' => 2, 'Customer_Type_ID' => 2, 'Payment_Type_ID' => 2, 'Order_Quantity' => 1, 'Order_Date_Time' => '2025-03-21 16:00:00', 'Order_Status' => 'Pending']);
        Order::create(['Order_ID' => 5, 'Product_ID' => 1, 'Customer_Type_ID' => 1, 'Payment_Type_ID' => 1, 'Order_Quantity' => 2, 'Order_Date_Time' => '2025-03-21 18:00:00', 'Order_Status' => 'Cancelled']);
    }
}