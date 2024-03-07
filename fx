<?php
require_once 'phpFx/init.php';
$path = 'phpFx/terminal/samples/';

$fxFile = $argv[1] ?? 'help';

//$drapeau = $argv[3] ?? "";


/*if ($drapeau == '-m') {
    echo "model";
} else if ($drapeau == '-t') {
    echo "model  view   controller";
}*/

if ($fxFile == 'newController') {

    include $path . 'Controller_sample.php';
} elseif ($fxFile == 'newView') {

    include $path . 'View_sample.php';
} elseif ($fxFile == 'newModel') {

    include $path . 'Model_sample.php';
} elseif ($fxFile == 'newMigration') {

    include $path . 'Migration_sample.php';
} elseif (strpos($fxFile, 'migrate') !== false) {

    if (isset($argv[2])) {
        $directory = 'boost/migrations/';
        $migration = ucfirst($argv[2]);
        $classMigration = $migration . 'Migration';
        $search = '_' . $migration . '.php';
        $file = findToIncludeFile($directory, $search);

        if (!$file) {
            echo "Migration $migration not found";
            exit;
        }

        require_once $file;

        $migration = new $classMigration();

        switch ($fxFile) {
            case 'migrate':
                $migrate = $migration->up();
                break;

            case 'migrate:remove':
                $migrate = $migration->down();
                break;

            case 'migrate:refresh':
                $migrate = $migration->down();
                $migrate = $migration->up();
                break;

            default:
                echo "error $fxFile n 'est pas une de nos commandes";
                break;
        }


        exit;
    }

    echo " migration total reussi";
} elseif ($fxFile == 'help') {
    echo 'liste des commandes';
} else {
    echo 'commandes invalide';
}
