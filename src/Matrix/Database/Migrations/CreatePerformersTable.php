<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreatePerformersTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('performers'))
            return;
            
        Capsule::schema()->create('performers', function ($table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('type');
            $table->longText('description');
            $table->longText('images');
            $table->longText('socials');
            $table->timestamps();
        });
    }
}
