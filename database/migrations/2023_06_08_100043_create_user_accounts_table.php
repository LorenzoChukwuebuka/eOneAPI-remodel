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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_type');
            $table->string('transaction_ref');
            $table->foreignId('user_id')->unsignedInteger();
            $table->foreignId('card_id')->unsignedIneger();
            $table->double('amount');
            $table->double('card_balance');
            $table->double('previous_balance');
            $table->string('remarks')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accounts');
    }
};
