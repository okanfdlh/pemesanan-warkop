<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        
        if ($orders->count() >= 1) {
            // Order items untuk order pertama
            OrderItem::create([
                'order_id' => $orders[0]->id,
                'product_name' => 'Cappuccino',
                'quantity' => 2,
                'price' => 10000.00,
                'subtotal' => 20000.00
            ]);
            
            OrderItem::create([
                'order_id' => $orders[0]->id,
                'product_name' => 'kentang goreng',
                'quantity' => 1,
                'price' => 10000.00,
                'subtotal' => 10000.00
            ]);
        }
        
        if ($orders->count() >= 2) {
            // Order items untuk order kedua
            OrderItem::create([
                'order_id' => $orders[1]->id,
                'product_name' => 'Matcha Latte',
                'quantity' => 1,
                'price' => 15000.00,
                'subtotal' => 15000.00
            ]);
            
            OrderItem::create([
                'order_id' => $orders[1]->id,
                'product_name' => 'Nasi Goreng',
                'quantity' => 1,
                'price' => 18000.00,
                'subtotal' => 18000.00
            ]);
        }
        
        if ($orders->count() >= 3) {
            // Order items untuk order ketiga
            OrderItem::create([
                'order_id' => $orders[2]->id,
                'product_name' => 'Cappuccino',
                'quantity' => 1,
                'price' => 10000.00,
                'subtotal' => 10000.00
            ]);
            
            OrderItem::create([
                'order_id' => $orders[2]->id,
                'product_name' => 'Nasi Goreng',
                'quantity' => 1,
                'price' => 18000.00,
                'subtotal' => 18000.00
            ]);
        }
    }
}