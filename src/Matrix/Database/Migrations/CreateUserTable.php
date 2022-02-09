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
            $table->bigIncrements('id');
            $table->string("email")->unique();
            $table->string("password");
            $table->unsignedBigInteger("role_id");
            $table->timestamps();
        });
    }
}
