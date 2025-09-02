<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_name', 'quantity', 'price', 'subtotal']; // ganti total_price jadi subtotal

    public function order()
    {
        return $this->belongsTo(Order::class); // gunakan konvensi Laravel
    }
}
