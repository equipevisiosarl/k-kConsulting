<?php

function  myAutoloader($className)
{
    // Convertir les barres obliques inverses en barres obliques pour correspondre à la structure des fichiers
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    // Chemin de base où se trouvent vos fichiers de classe
    $baseDir = __DIR__ . '/..';

    // Chemin complet du fichier de classe
    $filePath = $baseDir . DIRECTORY_SEPARATOR . $className . '.php';

    // Vérifier si le fichier existe avant de l'inclure
    if (file_exists($filePath)) {
        include $filePath;
    }
}





// Enregistrez la fonction d'autoloading
spl_autoload_register('myAutoloader');
