<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateRestaurantTypesTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('restaurant_types'))
            return;

        Capsule::schema()->create('restaurant_types', function ($table) {
            $table->bigIncrements('id');
            $table->string("type");
            $table->timestamps();
        });

        if (Capsule::schema()->hasTable('restaurant_types_link'))
            return;

        Capsule::schema()->create('restaurant_types_link', function ($table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');
            $table->unsignedBigInteger('restaurant_types_id');
            $table->timestamps();
        });
    }
}
