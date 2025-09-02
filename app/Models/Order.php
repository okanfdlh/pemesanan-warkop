<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_name',
        'customer_phone',
        'customer_meja',
        'notes',
        'total_price',
        'status',
        'payment_method', // tambahkan ini
        // hapus 'no_meja' dan 'payment_status'
    ];
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
