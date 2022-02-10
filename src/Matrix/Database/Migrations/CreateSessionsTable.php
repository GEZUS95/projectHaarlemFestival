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
            $table->unsignedInteger('sessions_amount');
            $table->unsignedInteger('duration');
            $table->date('start_time');
            $table->timestamps();
        });
    }
}
