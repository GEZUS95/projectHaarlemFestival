<?php

use App\Model\Restaurant;

require_once dirname(__DIR__, 1)."/Boot.php";

$res = Restaurant::find(1); // Just finds first items
//$res = Restaurant::findOrFail(1); // Fails if it cannot find the item
//$res = Restaurant::query()->where("id", "=", 1)->first(); // Queries the collection and takes the first item
//$res = Restaurant::query()->where("id", "=", 1)->get()[0];// Queries the collection and take all items

//$res = Restaurant::query()->where("id", "=", 1)
//    ->with("sessions")
//    ->with("types")
//    ->get();

foreach ($res->types as $type) {
    var_dump($type->type);
}