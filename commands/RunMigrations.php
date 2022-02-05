<?php

require_once dirname(__DIR__, 1)."/Boot.php";

$pathToMigrationFolder = dirname(__DIR__, 1)."/src/Matrix/Database/Migrations";
var_dump(glob($pathToMigrationFolder . "/*.php"));

foreach (glob($pathToMigrationFolder . "/*.php") as $file)
{
    require_once $file;

    $class = basename($file, '.php');
    $prf = "Matrix\Database\Migrations\\";

    if (class_exists($prf.$class))
    {
        $s = $prf . $class;
        $obj = new  $s;
        $obj->up();
    }
}

