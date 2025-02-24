<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Cappuccino',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Cappuccino_in_original.jpg/1200px-Cappuccino_in_original.jpg',
            'price' => 10000.00,
            'category' => 'coffe'
        ]);

        Product::create([
            'name' => 'Matcha Latte',
            'image' => 'https://cdn.loveandlemons.com/wp-content/uploads/2023/06/iced-matcha-latte.jpg',
            'price' => 15000.00,
            'category' => 'nCoffe'  
        ]);

        Product::create([
            'name' => 'Nasi Goreng',
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSmJMddrqmH8SkxcWRq3IS-BTcIr4KRiHz3Zg&s',
            'price' => 18000.00,
            'category' => 'makanan'
        ]);

        Product::create([
            'name' => 'kentang goreng',
            'image' => 'https://cdn0-production-images-kly.akamaized.net/j5gE9hDy1k0Kk7m-MGAbmVG9dJ8=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/970871/original/021248500_1440846143-header_chiantilvpa_com.jpg',
            'price' => 10000.00,
            'category' => 'cemilan'
        ]);
    }
}

