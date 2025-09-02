<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'order_id' => 'ORD-' . Str::random(8),
            'customer_name' => 'John Doe',
            'customer_meja' => 'A1',
            'customer_phone' => '081234567890',
            'notes' => 'Gula sedikit',
            'total_price' => 25000.00,
            'status' => 'Pending',
            'payment_method' => 'midtrans'
        ]);

        Order::create([
            'order_id' => 'ORD-' . Str::random(8),
            'customer_name' => 'Jane Smith',
            'customer_meja' => 'B2',
            'customer_phone' => '081987654321',
            'notes' => 'Tanpa es',
            'total_price' => 33000.00,
            'status' => 'Selesai',
            'payment_method' => 'midtrans'
        ]);

        Order::create([
            'order_id' => 'ORD-' . Str::random(8),
            'customer_name' => 'Ahmad Rahman',
            'customer_meja' => 'C3',
            'customer_phone' => '082111222333',
            'notes' => null,
            'total_price' => 28000.00,
            'status' => 'Pending',
            'payment_method' => 'midtrans'
        ]);
    }
}