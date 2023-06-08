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
        Schema::create('user_loyalty_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_type');
            $table->string('transaction_ref');
            $table->foreignId('vendor_id');
            $table->foreignId('loyalty_id');
            $table->foreignId('user_id');
            $table->foreignId('card_id');
            $table->double('points');
            $table->double('amount');
            $table->double('loyalty_balance');
            $table->double('previous_balance');
            $table->double('redemable');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_loyalty_accounts');
    }
};
