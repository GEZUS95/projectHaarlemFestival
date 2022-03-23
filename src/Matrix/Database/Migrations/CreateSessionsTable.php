<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateSessionsTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('sessions'))
            return;

        Capsule::schema()->create('sessions', function ($table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();
        });
    }
}
