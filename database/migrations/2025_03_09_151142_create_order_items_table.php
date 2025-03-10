<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Relasi ke orders
        $table->string('product_name'); // Nama produk
        $table->integer('quantity'); // Jumlah
        $table->decimal('price', 10, 2); // Harga satuan
        $table->decimal('subtotal', 10, 2); // Harga total (price * quantity)
        $table->timestamps();
    });
    Schema::table('order_items', function (Blueprint $table) {
        $table->string('product_name')->default('Unknown')->change();
    });
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
