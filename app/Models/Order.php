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
        'no_meja',
        'total_price',
        'payment_status',
    ];
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
