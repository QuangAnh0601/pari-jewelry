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
            $table->string('company')->nullable();
            $table->string('country');
            $table->string('postal_code');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->dropForeign(['create_by']);
            $table->dropColumn('create_by');
            $table->dropColumn('guard');
            $table->nullableMorphs('create_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('company');
            $table->dropColumn('country');
            $table->dropColumn('postal_code');
            $table->dropColumn('full_name');
            $table->dropColumn('email');
            $table->dropColumn('phone_number');
            $table->dropMorphs('create_by');
            $table->string('guard')->default('web');
            $table->unsignedBigInteger('create_by');
            $table->foreign('create_by')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
