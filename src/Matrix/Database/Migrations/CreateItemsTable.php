<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateItemsTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('items'))
            return;
            
        Capsule::schema()->create('items', function ($table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('performer_id');
            $table->unsignedBigInteger('special_guest_id')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->float('price');
            $table->timestamps();
        });
    }
}
