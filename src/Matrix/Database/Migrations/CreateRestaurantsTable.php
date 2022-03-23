<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateRestaurantsTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('restaurants'))
            return;

        Capsule::schema()->create('restaurants', function ($table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('location_id');
            $table->longtext('description');
            $table->float("stars");
            $table->unsignedInteger("seats");
            $table->float("price");
            $table->float("price_child");
            $table->boolean("accessibility");
            $table->unsignedInteger('duration');
            $table->timestamps();
        });
    }
}
