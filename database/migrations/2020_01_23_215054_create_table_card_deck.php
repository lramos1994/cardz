<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCardDeck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'card_deck',
            function (Blueprint $table) {
                $table->integer('card_id')
                    ->references('id')->on('cards')
                    ->onDelete('cascade');
                $table->integer('deck_id')
                    ->references('id')->on('decks')
                    ->onDelete('cascade');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign(['card_id','deck_id']);
        Schema::dropIfExists('card_deck');
    }
}
