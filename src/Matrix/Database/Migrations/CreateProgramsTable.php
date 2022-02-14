<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateProgramsTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('program'))
            return;
            
        Capsule::schema()->create('programs', function ($table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->float('total_price_program');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('color');
            $table->unsignedBigInteger('event_id');
            $table->timestamps();
        });
    }
}
