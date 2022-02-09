<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateShoppingCardsTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('shopping_cards'))
            return;
            
        Capsule::schema()->create('shopping_cards', function ($table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("user_id");
            $table->longText("card");
            $table->timestamps();
        });
    }
}
