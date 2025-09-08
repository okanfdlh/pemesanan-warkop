<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'category', 
        'price', 
        'image', 
        'stock', 
        'min_stock', 
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'min_stock' => 'integer',
        'is_available' => 'boolean',
    ];

    // Method untuk mengurangi stok
    public function decreaseStock($quantity)
    {
        if ($this->stock >= $quantity) {
            $this->stock -= $quantity;
            
            // Auto disable jika stok habis
            if ($this->stock <= 0) {
                $this->is_available = false;
            }
            
            $this->save();
            return true;
        }
        return false;
    }

    // Method untuk menambah stok
    public function increaseStock($quantity)
    {
        $this->stock += $quantity;
        
        // Auto enable jika stok bertambah
        if ($this->stock > 0) {
            $this->is_available = true;
        }
        
        $this->save();
        return true;
    }

    // Check apakah stok mencukupi
    public function hasEnoughStock($quantity)
    {
        return $this->stock >= $quantity && $this->is_available;
    }
}

