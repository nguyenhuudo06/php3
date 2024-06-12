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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_name')->after('user_id');
            $table->string('customer_address')->after('customer_name');
            $table->string('customer_phone')->after('customer_address');
            $table->string('customer_zipcode')->after('customer_phone');
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled', 'failed'])->default('pending')->change();
            $table->enum('payment_method', ['vnpay', 'cash']);
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_name', 'customer_address', 'customer_phone', 'customer_zipcode', 'status', 'payment_method', 'payment_status']);
        });
    }
};
