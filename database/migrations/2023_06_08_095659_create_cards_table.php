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

        DB::table('cards')->insert(
            array(
                "card_number" => "120000000000",
                "expiry_date" => DB::raw('NOW()'),
                "pin" => "0000",
                "user_id" => 0,
                "vendor_id" => 0,
                "card_type_id" => 0,
                "account_type_id" => 0,
                "interest_rate" => 0,
                "card_limit" => 0,
                "card_token" => 0,
                "status" => "inactive",
                "created_at" => DB::raw('NOW()'),

            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
