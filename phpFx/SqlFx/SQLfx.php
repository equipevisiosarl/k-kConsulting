<?php

namespace phpFx\SqlFx;

trait SQLfx
{
    use Cnx;
    //protected $table;
    protected static $Table;
    protected static $primary_Key;
    protected static $select = '*'; // Éléments sélectionnés
    protected static $joins; // Joins de la table
    protected static $where; // Conditions de la table
    protected static $limit; // Limit de la table
    protected static $offset; // Offset de la table
    protected static $groupBy; // Group by de la table
    protected static $orderBy; // Order by de la table
    protected static $conditions;
    protected static $InsertColumns;
    protected static $setConditions;
    protected static $UpdateColumns;

    public function __construct()
    {
        static::$Table = $this->table ?? null;
        static::$InsertColumns = $this->insertColumns ?? [];
        static::$UpdateColumns = $this->updateColumns ?? [];
        static::$primary_Key = $this->primaryKey ?? 'id';
    }

    private static function getTable()
    {
        $nameClass =  get_called_class();
        $medel = new $nameClass();
        if (empty(static::$Table)) {
            static::$Table = strtolower(str_plural(basename($nameClass)));
        }

        return static::$Table;
    }

    public static function setTable()
    {
        $nameClass =  get_called_class();
        $medel = new $nameClass();
        if (empty(static::$Table)) {
            static::$Table = strtolower(str_plural(basename($nameClass)));
        }
    }


    // Sélectionne les colonnes
    public static function select($columns = '*')
    {
        static::$select = $columns;
        return new self;
    }

    // Sélectionne le compte des lignes
    public static function count($columns = '*')
    {
        static::$select = "COUNT(" . $columns . ") as count";
        return new self;
    }

    // Sélectionne la valeur moyenne
    public static function avg($column)
    {
        static::$select = "AVG(" . $column . ") as avg";
        return new self;
    }

    // Sélectionne la valeur maximale
    public static function max($column)
    {
        static::$select = "MAX(" . $column . ") as max";
        return new self;
    }

    // Sélectionne la valeur minimale
    public static function min($column)
    {
        static::$select = "MIN(" . $column . ") as min";
        return new self;
    }

    // Sélectionne la somme des valeurs
    public static function sum($column)
    {
        static::$select = "SUM(" . $column . ") as sum";
        return new self;
    }


    // Ajoute une condition WHERE
    public static function where(...$args)
    {
        static::setTable();
        $operator_default = '=';
        if (count($args) === 1 && is_array($args[0])) {
            $operator = $operator_default;
            foreach ($args[0] as $column => $value) {
                static::$conditions[] = compact('column', 'operator', 'value');
            }
        } elseif (count($args) === 2) {
            $operator = $operator_default;
            list($column, $value) = $args;
            static::$conditions[] = compact('column', 'operator', 'value');
        } elseif (count($args) === 3) {
            list($column, $operator, $value) = $args;
            static::$conditions[] = compact('column', 'operator', 'value');
        } else {
            // Gérer d'autres cas si nécessaire
        }

        return new self;
    }


    // Ordonne les résultats
    public static function orderBy($column, $direction = 'ASC')
    {
        static::$orderBy = compact('column', 'direction');
        return new self;
    }

    // Effectue une jointure INNER
    public static function join($table, $condition)
    {
        static::$joins[] = " INNER JOIN " . $table . " ON " . $condition;
        return new self;
    }

    // Effectue une jointure LEFT
    public static function leftJoin($table, $condition)
    {
        static::$joins[] = " LEFT JOIN " . $table . " ON " . $condition;
        return new self;
    }

    // Effectue une jointure RIGHT
    public static function rightJoin($table, $condition)
    {
        static::$joins[] = " RIGHT JOIN " . $table . " ON " . $condition;
        return new self;
    }

    // Sélectionne les valeurs distinctes
    public static function distinct($columns = null)
    {
        if ($columns) {
            static::$select = "DISTINCT " . trim($columns, " , ");
        } else {
            static::$select .= "DISTINCT *";
        }
        return new self;
    }

    // Groupe les résultats par colonne
    public static function groupBy($columns)
    {
        static::$groupBy = " GROUP BY " . $columns;
        return new self;
    }

    // Limite le nombre de résultats
    public static function limit($limit)
    {
        static::$limit = $limit;
        return new self;
    }

    // Définit un offset pour les résultats
    public static function offset($offset)
    {
        static::$offset = " OFFSET " . $offset;
        return new self;
    }

    // Exécute la requête SELECT
    public static function find($param = null)
    {       

        $query = "SELECT " . static::$select . " FROM " . static::getTable();

        if (!empty(static::$joins)) {
            $query .= " " . implode(" ", static::$joins);
        }

        if (!empty(static::$conditions)) {
            $query .= " WHERE " . static::buildWhereClause();
        }

        if (!empty(static::$groupBy)) {
            $query .= " " . static::$groupBy;
        }

        if (!empty(static::$orderBy)) {
            $query .= static::buildOrderByClause();
        }

        if ($param !== null && is_int($param)) {
            $query .= " LIMIT " . $param;
        }

        if (!empty(static::$offset)) {
            $query .= " " . static::$offset;
        }
        
        //echo $query; // Pour le debug
        $result = static::query($query, static::$setConditions); 

       static::$setConditions =  static::$conditions = null;

        if ($result) {
            $numkey = array_keys($result[0])[0];
            if (in_array($numkey, ['min', 'max', 'count', 'sum'])) {
                return  $result = $result[0][$numkey];
            }
            return $result;
        } else {
            return false;
        }
    }

    // Construit la clause WHERE
    protected static function buildWhereClause()
    {

        $conditions = [];

        foreach (static::$conditions as $condition) {
            $conditions[] = "{$condition['column']} {$condition['operator']} ? ";
            static::$setConditions[] = $condition['value'];
        }
        return implode(' AND ', $conditions);
    }

    // Construit la clause ORDER BY
    protected static function buildOrderByClause()
    {
        return " ORDER BY " . static::$orderBy['column'] . " " . static::$orderBy['direction'];
    }

    public static function insert(array $datas)
    {
        static::setTable();
        /** remove unwanted data **/
        if (!empty(static::$InsertColumns)) {
            foreach ($datas as $key => $value) {

                if (!in_array($key, static::$InsertColumns)) {
                    unset($datas[$key]);
                }
            }
        }


        $keys = array_keys($datas);

        $query = "insert into " . static::$Table . " (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
        static::query($query, $datas);

        return true;
    }

    public static function update(array $datas)
    {

        static::setTable();
        /** remove unwanted data **/
        if (!empty(static::$UpdateColumns)) {
            foreach ($datas as $key => $value) {

                if (!in_array($key, static::$UpdateColumns)) {
                    unset($datas[$key]);
                }
            }
        }

        // Construction de la chaîne SET pour les champs à mettre à jour
        $setChamps = implode(' , ', array_map(function ($champ) {
            return " $champ = ? ";
        }, array_keys($datas)));
        // Préparation de la requête SQL
        $query = "UPDATE " . static::$Table . " SET $setChamps ";

        if (!empty(static::$conditions)) {
            $query .= " WHERE " . static::buildWhereClause();
        }

        // Construction du tableau des valeurs à mettre à jour
        $setValeurs = array_values($datas);

        $data = array_merge($setValeurs, static::$setConditions); 

        // Exécution de la requête SQL avec les valeurs à mettre à jour et les conditions
        $result = static::query($query, $data);

        static::$setConditions =  static::$conditions = null;
        return true;
    }

    public static function delete()
    {
        static::setTable();
        $query = "DELETE FROM " . static::$Table;

        if (!empty(static::$conditions)) {
            $query .= " WHERE " . static::buildWhereClause();
        }

        static::query($query, static::$setConditions);

        static::$setConditions =  static::$conditions = null;
        return true;
    }
}
