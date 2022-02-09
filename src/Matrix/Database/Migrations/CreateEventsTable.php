<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateEventsTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('events'))
            return;
            
        Capsule::schema()->create('events', function ($table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->float('total_price_event');
            $table->longText('description');
            $table->longText('images');
            $table->timestamps();
        });
    }
}
