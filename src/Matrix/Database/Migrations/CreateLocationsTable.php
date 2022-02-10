<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateLocationsTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('locations'))
            return;
            
        Capsule::schema()->create('locations', function ($table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('city');
            $table->string('address');
            $table->string('stage')->nullable();
            $table->string('color');
            $table->unsignedInteger('seats');
            $table->timestamps();
        });
    }
}
