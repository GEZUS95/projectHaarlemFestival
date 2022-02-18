<?php

require_once dirname(__DIR__, 1)."/Boot.php";

$pathToMigrationFolder = dirname(__DIR__, 1)."/src/Matrix/Database/Migrations";

foreach (glob($pathToMigrationFolder . "/*.php") as $file)
{
    require_once $file;

    $class = basename($file, '.php');
    $prf = "Matrix\Database\Migrations\\";

    {
        $s = $prf . $class;
        $obj = new  $s;
        $obj->up();
    }
}

echo ("Migrations ran, updated the database correctly! \n");

