<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_name', 'quantity', 'price', 'total_price'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'total_price', 'total_price'); // Relasi ke total_price di tabel orders
    }
}
