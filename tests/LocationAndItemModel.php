<?php

use App\Model\Item;
use App\Model\Location;

require_once dirname(__DIR__, 1)."/Boot.php";

$item = Item::query()->where("id", "=", 1)
    ->with("location")
    ->first();

$location = Location::query()->where("id", "=", 1)
    ->with("items")
    ->first();

var_dump($item->location->id);
var_dump($location->items[0]->id);