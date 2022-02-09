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
            $table->string('title');
            $table->float('float');
            $table->longText('menu');
            $table->string('logo');
            $table->timestamps();
        });
    }
}
