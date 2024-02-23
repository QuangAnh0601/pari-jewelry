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
        Schema::disableForeignKeyConstraints();
        Schema::table('orders', function (Blueprint $table) {
            $table->dropUnique('orders_coupon_code_unique');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            Schema::table('orders', function (Blueprint $table) {
                $table->uuid('coupon_code')->unique()->nullable();
            });
            Schema::enableForeignKeyConstraints();
        });
    }
};
