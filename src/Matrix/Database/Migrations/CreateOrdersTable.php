<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateOrdersTable
{
    public function up()
    {
        if (Capsule::schema()->hasTable('orders'))
            return;
            
        Capsule::schema()->create('orders', function ($table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->string('uuid');
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
        });

        if (Capsule::schema()->hasTable('order_able'))
            return;

        Capsule::schema()->create('order_able', function ($table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('order_able_id');
            $table->string('order_able_type');
            $table->timestamps();
        });
    }
}
