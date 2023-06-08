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
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category');
            $table->string('business_name');
            $table->string('region');
            $table->string('city');
            $table->string('state');
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('status')->default('active');
            $table->string('password');
            $table->string('logo')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
