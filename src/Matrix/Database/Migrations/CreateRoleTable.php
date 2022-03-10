<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateRoleTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('roles'))
            return;

        Capsule::schema()->create('roles', function ($table) {
            $table->bigIncrements('id');
            $table->string("name")->unique();
            $table->longText("permissions");
            $table->timestamps();
        });
    }
}
