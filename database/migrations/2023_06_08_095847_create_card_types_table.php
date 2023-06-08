<?php

use App\Models\CardType;
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
        Schema::create('card_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->timestamps();
        });

        $data = array(['type' => 'physical'], ['type' => 'virtual']);

        foreach ($data as $datum) {
            $card_type = new CardType(); //The Category is the model for your migration
            $card_type->type = $datum['type'];
            $card_type->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_types');
    }
};
