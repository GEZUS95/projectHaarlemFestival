<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class zForeignKeys
{
    public function up()
    {
        //ROLE TABLE
        Capsule::schema()->table('users', function ($table) {
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->unisigned();
        });


        //USER_SETTINGS TABLE
        Capsule::schema()->table('user_settings', function ($table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->unisigned();
        });


        //SHOPPING_CARD TABLE
        Capsule::schema()->table('orders', function ($table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->unisigned();
        });


        //PROGRAM TABLE
        Capsule::schema()->table('programs', function ($table) {
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->unisigned();
        });


        //ITEM TABLE
        Capsule::schema()->table('items', function ($table) {
            $table->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->unisigned();

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->unisigned();

            $table->foreign('performer_id')
                ->references('id')
                ->on('performers')
                ->unisigned();

            $table->foreign('special_guest_id')
                ->references('id')
                ->on('performers')
                ->unisigned();
        });

        //restaurant_types_link
//        Capsule::schema()->table('restaurant_types_link', function ($table) {
//            $table->foreign('restaurant_types_id')
//                ->references('id')
//                ->on('restaurant_types')
//                ->unisigned();
//
//            $table->foreign('restaurant_id')
//                ->references('id')
//                ->on('restaurants')
//                ->unisigned();
//        });

        Capsule::schema()->table('sessions', function ($table) {
            $table->foreign('restaurant_id')
                ->references('id')
                ->on('restaurants')
                ->unisigned();
        });
    }
}
