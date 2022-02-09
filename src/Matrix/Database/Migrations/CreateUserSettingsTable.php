<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUserSettingsTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('user_settings'))
            return;
            
        Capsule::schema()->create('user_settings', function ($table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->longText("settings");
            $table->timestamps();
        });
    }
}
