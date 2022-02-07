<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once dirname(__DIR__, 1)."/Boot.php";

Capsule::schema()->disableForeignKeyConstraints();
Capsule::schema()->dropAllTables();
Capsule::schema()->enableForeignKeyConstraints();

die("dropped all tables");

