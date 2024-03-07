<?php

namespace phpFx\SqlFx;


trait Cnx
{

    public static function connexion()
    {


        try {

            $bdd = new \PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8", DBUSER, DBPASS);
            return $bdd;
        } catch (\Exception $e) {
            return "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    public static function query($query, $data = [])
    {

        $connexion = self::connexion();
        $statement = $connexion->prepare($query);

        $check = $statement->execute($data);
        if ($check) {
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if (is_array($result) && count($result)) {
                return $result;
            }
        }

        return [];
    }
}
