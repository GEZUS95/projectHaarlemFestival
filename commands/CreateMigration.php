<?php
require_once dirname(__DIR__, 1) . "/Boot.php";

if (!isset($argv[1]))
    die("Give the name of the migration example: php .\commands\CreateMigration.php name");

$pathToMigrationFolder = dirname(__DIR__, 1) . "/src/Matrix/Database/Migrations/";
$filename = $argv[1];
$allFiles = scandir($pathToMigrationFolder);

foreach ($allFiles as $n)
    if (str_contains($n, $filename))
        die("File already exist");

$updateFullPath = $pathToMigrationFolder . "Create" . ucfirst($filename) . "Table" . ".php";

$content = "
<?php

namespace Matrix\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class Create" . ucfirst($filename) . "Table
{
    public function up()
    {
        if (Capsule::schema()->hasTable('" . $filename . "'))
            return;
            
        Capsule::schema()->create('" . $filename . "', function (\$table) {
            \$table->bigIncrements('id');
            \$table->timestamps();
        });
    }
}
";

$fileWriter = fopen($updateFullPath, 'w');
fwrite($fileWriter, substr($content, strpos($content, "\n") + 1));
fclose($fileWriter);

die("Migration Create" . ucfirst($filename) . "Table created successfully");

