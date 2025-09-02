<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Foreign key sudah ada di create_order_items_table migration
        // menggunakan order_id, bukan total_price
    }

    public function down()
    {
        // Tidak ada yang perlu di-rollback
    }
};
