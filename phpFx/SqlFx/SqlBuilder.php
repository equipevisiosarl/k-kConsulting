<?php

namespace phpFx\SqlFx;


trait SqlBuilder
{
    use Cnx;
    protected $select = '*'; // Éléments sélectionnés
    protected $from; // Choix de la table
    protected $joins; // Joins de la table
    protected $where; // Conditions de la table
    protected $limit; // Limit de la table
    protected $offset; // Offset de la table
    protected $groupBy; // Group by de la table
    protected $orderBy; // Order by de la table
    protected $conditions;
    protected $setConditions = []; // contient les valeurs des conditions

    // Sélectionne les colonnes
    public function select($columns = '*')
    {
        $this->select =  $columns;
        return $this;
    }

    // Sélectionne le compte des lignes
    public function count($columns = '*')
    {
        $this->select = "COUNT(" . $columns . ") as count";
        return $this;
    }

    // Sélectionne la valeur moyenne
    public function avg($column)
    {
        $this->select = "AVG(" . $column . ") as avg";
        return $this;
    }

    // Sélectionne la valeur maximale
    public function max($column)
    {
        $this->select = "MAX(" . $column . ") as max";
        return $this;
    }

    // Sélectionne la valeur minimale
    public function min($column)
    {
        $this->select = "MIN(" . $column . ") as min";
        return $this;
    }

    // Sélectionne la somme des valeurs
    public function sum($column)
    {
        $this->select = "SUM(" . $column . ") as sum";
        return $this;
    }

    // Choisi la table
    public function from($table)
    {
        $this->from = $table;
        return $this;
    }

    

    public function where(...$args)
    {
        $operator_default = '=';
        if (count($args) === 1 && is_array($args[0])) {
            $operator = $operator_default;
            foreach ($args[0] as $column => $value) {
                $this->conditions[] = compact('column', 'operator', 'value');
            }
        } elseif (count($args) === 2) {
            $operator = $operator_default;
            list($column, $value) = $args;
            $this->conditions[] = compact('column', 'operator', 'value');
        } elseif (count($args) === 3) {
            list($column, $operator, $value) = $args;
            $this->conditions[] = compact('column', 'operator', 'value');
        } else {
            // Gérer d'autres cas si nécessaire
        }

        return $this;
    }

    

    // Ordonne les résultats
    public function orderBy($column, $direction = 'ASC')
    {
        $this->orderBy = compact('column', 'direction');
        return $this;
    }

    // Effectue une jointure INNER
    public function join($table, $condition)
    {
        $this->joins[] = " INNER JOIN " . $table . " ON " . $condition;
        return $this;
    }

    // Effectue une jointure LEFT
    public function leftJoin($table, $condition)
    {
        $this->joins[] = " LEFT JOIN " . $table . " ON " . $condition;
        return $this;
    }

    // Effectue une jointure RIGHT
    public function rightJoin($table, $condition)
    {
        $this->joins[] = " RIGHT JOIN " . $table . " ON " . $condition;
        return $this;
    }

    // Sélectionne les valeurs distinctes
    public function distinct($columns = null)
    {
        if ($columns) {
            $this->select = "DISTINCT " . trim($columns, " , ");
        } else {
            $this->select .= "DISTINCT *";
        }
        return $this;
    }

    // Groupe les résultats par colonne
    public function groupBy($columns)
    {
        $this->groupBy = " GROUP BY " . $columns;
        return $this;
    }

    // Limite le nombre de résultats
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    // Définit un offset pour les résultats
    public function offset($offset)
    {
        $this->offset = " OFFSET " . $offset;
        return $this;
    }

    // Exécute la requête SELECT
    public function find()
    {
        $query = "SELECT " . $this->select . " FROM " . $this->from;

        if (!empty($this->joins)) {
            $query .= " " . implode(" ", $this->joins);
        }

        if (!empty($this->conditions)) {
            $query .= " WHERE " .$this->buildWhereClause();
        }

        if (!empty($this->groupBy)) {
            $query .= " " . $this->groupBy;
        }

        if (!empty($this->orderBy)) {
            $query .= $this->buildOrderByClause();
        }

        if (!empty($this->limit)) {
            $query .= " LIMIT {$this->limit}";
        }

        if (!empty($this->offset)) {
            $query .= " " . $this->offset;
        }


       // echo $query; // pour le debug
    $result = $this->query($query , $this->setConditions);

        unset($this->setConditions, $this->conditions);

        if ($result) { 
            $numkey = array_keys($result[0])[0]; 
            if (in_array($numkey, ['min' , 'max', 'count', 'sum']) ) {
              return  $result = $result[0][$numkey];
            }
            return $result;
        } else {
            return false;
        }
    }

    // Construit la clause WHERE
   protected function buildWhereClause()
    {
        $conditions = [];

        foreach ($this->conditions as $condition) {
            $conditions[] = "{$condition['column']} {$condition['operator']} ? ";
            $this->setConditions[] = $condition['value'];
        }

        return implode(' AND ', $conditions);
    }

    // Construit la clause ORDER BY
    protected function buildOrderByClause()
    {
        return " ORDER BY {$this->orderBy['column']} {$this->orderBy['direction']}";
    }

    public function insert($table, array $datas, $insertColumns=[])
    {

        /** remove unwanted data **/
        if (!empty($insertColumns)) {
            foreach ($datas as $key => $value) {

                if (!in_array($key, $insertColumns)) {
                    unset($datas[$key]);
                }
            }
        }


        $keys = array_keys($datas);

        $query = "insert into $table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
        $this->query($query, $datas);

        return true;
    }

    public function update($table, array $datas, $updateColumns=[])
    {


        /** remove unwanted data **/
        if (!empty($updateColumns)) {
            foreach ($datas as $key => $value) {

                if (!in_array($key, $updateColumns)) {
                    unset($datas[$key]);
                }
            }
        }

        // Construction de la chaîne SET pour les champs à mettre à jour
        $setChamps = implode(' , ', array_map(function ($champ) {
            return " $champ = ? ";
        }, array_keys($datas)));
        // Préparation de la requête SQL
        $query = "UPDATE $table SET $setChamps ";

        if (!empty($this->conditions)) {
            $query .= $this->buildWhereClause();
        }

        // Construction du tableau des valeurs à mettre à jour
        $setValeurs = array_values($datas);

        $data = array_merge($setValeurs, $this->setConditions);

        // Exécution de la requête SQL avec les valeurs à mettre à jour et les conditions
        $result = $this->query($query, $data);

        unset($this->setConditions, $this->conditions);
        return true;
    }

    public function delete($table)
    {

        $query = "DELETE FROM $table ";

        if (!empty($this->conditions)) {
            $query .= $this->buildWhereClause();
        }

        $this->query($query, $this->setConditions);

        unset($this->setConditions);

        unset($this->setConditions, $this->conditions);
        return true;
    }


   
}
