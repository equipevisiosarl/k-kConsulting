#!/usr/bin/env php
<?php

// Récupérer le nom du fichier à créer en argument de la commande
if (!isset(/*$argv[1] */$argv[2])) {
  echo "Usage :  php fx newMigration nom_du_fichierController\n";
  exit(1);
}


$nom_fichier = date("jS_M_Y_H_i_s_") . ucfirst($argv[2]);

$className = ucfirst($argv[2]).'Migration';

$table = $argv[2];

// Vérifier que le nom du fichier est valide
if (preg_match('/[^a-z0-9_]/i', $nom_fichier)) {
  echo "Le nom du fichier ne doit contenir que des lettres, des chiffres et des tirets bas.\n";
  exit(1);
}

$namespace = 'use phpFx\terminal\config\Migration;';
// Générer le contenu du fichier
$contenu = <<<EOT
<?php

{$namespace}

class {$className} extends Migration {
  
    public function up()
	{

		/** columns define **/
		\$this->id();
		\$this->datetime('created_at')->default('CURRENT_TIMESTAMP');
		\$this->datetime('updated_at')->default('CURRENT_TIMESTAMP');
		/*
		//\$this->index();
		*/

        /** create table **/
		\$this->createTable('{$table}');
		
	} 

	public function down()
	{
		\$this->dropTable('{$table}');
	}

}
EOT;

// Écrire le contenu dans le fichier
$fichier = "boost/migrations/{$nom_fichier}.php";
if (file_exists($fichier)) {
  echo "Le fichier {$nom_fichier}.php existe déjà.\n";
  exit(1);
}
if (file_put_contents($fichier, $contenu) === false) {
  echo "Impossible d'écrire dans le fichier {$nom_fichier}.php.\n";
  exit(1);
}

echo "La migration {$nom_fichier}.php a été créé avec succès.\n";