<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_id')->unique();
        $table->string('customer_name');
        $table->string('customer_phone');
        $table->text('note')->nullable();
        $table->decimal('total_price', 10, 2);
        $table->enum('status', ['Pending', 'Selesai'])->default('Pending');
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
