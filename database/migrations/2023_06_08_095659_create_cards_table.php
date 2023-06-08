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
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card_number');
            $table->date('expiry_date');
            $table->string('pin');
            $table->foreignId('user_id')->unsignedInteger()->index();
            $table->foreignId('vendor_id')->unsignedInteger()->index();
            $table->foreignId('card_type_id')->unsignedInteger()->index();
            $table->foreignId('account_type_id')->unsignedInteger()->index();
            $table->double('interest_rate')->nullabe();
            $table->integer('card_limit')->nullable();
            $table->integer('card_token')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
