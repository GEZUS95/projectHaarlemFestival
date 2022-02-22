<?php

use App\Model\Location;

require_once dirname(__DIR__, 1)."/Boot.php";

$loc = Location::find(48); // Just finds first items

foreach ($loc->images as $s) {
    var_dump($s->file_location);
}