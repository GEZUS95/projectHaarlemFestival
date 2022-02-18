<?php

use App\Model\Restaurant;

require_once dirname(__DIR__, 1)."/Boot.php";

$res = Restaurant::find(1);

foreach ($res->types as $type) {
    var_dump($type->type);
}