<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUserTable
{
    public function up()
    {
        Capsule::schema()->create('user', function ($table) {
            $table->increments('id');
            $table->timestamps();
        });
    }
}
