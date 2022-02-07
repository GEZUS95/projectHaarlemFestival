<?php

require_once dirname(__DIR__, 1)."/Boot.php";

$pathToMigrationFolder = dirname(__DIR__, 1)."/src/Matrix/Database/Seeder";

foreach (glob($pathToMigrationFolder . "/*.php") as $file)
{
    require_once $file;

    $class = basename($file, '.php');
    $prf = "Matrix\Database\Seeder\\";

    {
        $s = $prf . $class;
        $obj = new  $s;
        $obj->seed();
    }
}

die("Seeder ran, filled the database correctly!");

