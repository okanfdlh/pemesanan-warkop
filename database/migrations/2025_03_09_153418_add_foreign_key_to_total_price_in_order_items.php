<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Pastikan order_items memiliki kolom total_price
            $table->decimal('total_price', 10, 2)->nullable()->change();

            // Tambahkan foreign key ke tabel orders
            $table->foreign('total_price')->references('total_price')->on('orders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['total_price']);
        });
    }
};
