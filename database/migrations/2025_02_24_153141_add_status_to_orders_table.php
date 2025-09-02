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
        // Kolom status sudah ada di create_orders_table migration
        // Tidak perlu menambahkan lagi
    }

    public function down()
    {
        // Tidak ada yang perlu di-rollback
    }
};
