<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class zForeignKeys
{
    public function up()
    {
        //ROLE TABLE
        if(Capsule::schema()->hasTable("role")){
            Capsule::schema()->table('user', function ($table) {
                $table->foreign('role_id')
                    ->references('id')
                    ->on('role')
                    ->unisigned();
            });
        }

        //USER_SETTINGS TABLE
        if(Capsule::schema()->hasTable("user")){
            Capsule::schema()->table('user_settings', function ($table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('user')
                    ->unisigned();
            });
        }

        //SHOPPING_CARD TABLE
        if(Capsule::schema()->hasTable("user")){
            Capsule::schema()->table('shopping_cards', function ($table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('user')
                    ->unisigned();
            });
        }

        //PROGRAM TABLE
        if(Capsule::schema()->hasTable("events")){
            Capsule::schema()->table('programs', function ($table) {
                $table->foreign('event_id')
                    ->references('id')
                    ->on('events')
                    ->unisigned();
            });
        }

        //ITEM TABLE
        if(Capsule::schema()->hasTable("programs")){
            Capsule::schema()->table('items', function ($table) {
                $table->foreign('program_id')
                    ->references('id')
                    ->on('programs')
                    ->unisigned();
            });
        }

        if(Capsule::schema()->hasTable("locations")){
            Capsule::schema()->table('items', function ($table) {
                $table->foreign('location_id')
                    ->references('id')
                    ->on('locations')
                    ->unisigned();
            });
        }

        if(Capsule::schema()->hasTable("performers")){
            Capsule::schema()->table('items', function ($table) {
                $table->foreign('performer_id')
                    ->references('id')
                    ->on('performers')
                    ->unisigned();
            });
        }

        if(Capsule::schema()->hasTable("performers")){
            Capsule::schema()->table('items', function ($table) {
                $table->foreign('special_guest_id')
                    ->references('id')
                    ->on('performers')
                    ->unisigned();
            });
        }
    }
}
