<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateImagesTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('images'))
            return;

        Capsule::schema()->create('images', function ($table) {
            $table->bigIncrements('id');
            $table->string('file_location');
            $table->timestamps();
        });

        if (Capsule::schema()->hasTable('image_ables'))
            return;

        Capsule::schema()->create('image_ables', function ($table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('image_id');
            $table->unsignedBigInteger('image_ables_id');
            $table->string('image_ables_type');
            $table->timestamps();
        });
    }
}
