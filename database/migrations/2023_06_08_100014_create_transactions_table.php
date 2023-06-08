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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->unsignedInteger();
            $table->foreignId('vendor_id')->unsignedInteger();
            $table->foreignId('card_id')->unsignedInteger();
            $table->foreignId('loyalty_id')->unsignedInteger();
            $table->double('transaction_amount');
            $table->double('unit_price');
            $table->double('quantity');
            $table->double('loyalty_point');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
