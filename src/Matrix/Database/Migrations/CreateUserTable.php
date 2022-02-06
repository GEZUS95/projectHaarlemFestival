<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUserTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('user'))
            return;

        Capsule::schema()->create('user', function ($table) {
            $table->increments('id');
            $table->string("email")->unique();
            $table->string("password");
            $table->bigInteger("role_id");
            $table->timestamps();
        });
    }
}
