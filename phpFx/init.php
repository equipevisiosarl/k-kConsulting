<?php

require_once 'config/config.php';

//recense toutes les dependances a l 'applications
$dependencies =  [
    'phpFx/fonctionsFx/fonctionsFx.php',
    'phpFx/routerFx/fonctionsRouter.php',
];

//inclut toutes les dependances a l 'applications
foreach ($dependencies as $dependency){
    require_once $dependency;
}

function  myAutoloader($className)
{
    // Convertir les barres obliques inverses en barres obliques pour correspondre à la structure des fichiers
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    // Chemin complet du fichier de classe
    $filePath = $className . '.php';

    // Vérifier si le fichier existe avant de l'inclure
    if (file_exists($filePath)) {
        include $filePath;
    }
}





// Enregistrez la fonction d'autoloading
spl_autoload_register('myAutoloader');

