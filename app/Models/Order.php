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
        'customer_meja',
        'customer_phone',
        'notes',
        'total_price',
        'fee_platform',
        'total_bayar',
        'payment_status',
        'status',
        'payment_method'
    ];
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
