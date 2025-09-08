<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Tambahkan kolom fee_platform dan total_bayar
            $table->decimal('fee_platform', 10, 2)->default(0)->after('total_price');
            $table->decimal('total_bayar', 10, 2)->default(0)->after('fee_platform');
            
            // Tambahkan kolom payment_status jika belum ada
            if (!Schema::hasColumn('orders', 'payment_status')) {
                $table->string('payment_status')->default('pending')->after('total_bayar');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['fee_platform', 'total_bayar']);
            
            // Hanya drop payment_status jika kita yang menambahkannya
            if (Schema::hasColumn('orders', 'payment_status')) {
                $table->dropColumn('payment_status');
            }
        });
    }
};
