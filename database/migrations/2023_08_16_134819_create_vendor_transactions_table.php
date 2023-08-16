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
        Schema::create('vendor_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('vendor_id')->index()->unsignedInteger();
            $table->double('amount');
            $table->string('transaction_type');
            $table->string('transaction_reference');
            $table->string('card_transaction_id')->nullable();
            $table->string('status');
            $table->string('meta_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_transactions');
    }
};
