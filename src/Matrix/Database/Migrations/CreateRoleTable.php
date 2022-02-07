<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateRoleTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('role'))
            return;

        Capsule::schema()->create('role', function ($table) {
            $table->bigIncrements('id');
            $table->longText("permissions");
            $table->timestamps();
        });
    }
}
