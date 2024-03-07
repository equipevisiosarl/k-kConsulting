#!/usr/bin/env php
<?php

// Récupérer le nom du fichier à créer en argument de la commande
if (!isset(/*$argv[1] */$argv[2])) {
  echo "Usage :  php fx newModel nom_du_fichier\n";
  exit(1);
}

$nom_fichier = ucfirst($argv[2]);

// Vérifier que le nom du fichier est valide
if (preg_match('/[^a-z0-9_]/i', $nom_fichier)) {
  echo "Le nom du fichier ne doit contenir que des lettres, des chiffres et des tirets bas.\n";
  exit(1);
}

$namespace = 'use phpFx\SqlFx\SQLfx;';
$table = strtolower($nom_fichier) . 's';
// Générer le contenu du fichier
$contenu = <<<EOT
<?php
namespace app\models;
{$namespace}

class {$nom_fichier} {

    use SQLfx;
    //protected \$table = 'votre_table si elle est différente de {$table}';
    //protected \$insertColumns =  [];
    //protected \$updateColumns = [];
    //Ajoutez votre code ici
}
EOT;

// Écrire le contenu dans le fichier
$fichier = "app/models/{$nom_fichier}.php";
if (file_exists($fichier)) {
  echo "Le fichier {$nom_fichier}.php existe déjà.\n";
  exit(1);
}
if (file_put_contents($fichier, $contenu) === false) {
  echo "Impossible d'écrire dans le fichier {$nom_fichier}.php.\n";
  exit(1);
}

echo "Le model {$nom_fichier}.php a été créé avec succès.\n";
