<?php

namespace phpFx\terminal\config;

use phpFx\SqlFx\Cnx;

class Migration
{
    use Cnx;

    protected $table;
    protected $columns      = [];
    protected $keys         = [];
    protected $primaryKeys  = [];
    protected $uniqueKeys   = [];
    protected $data         = [];
    protected $currentColumn;
    // protected $columnOptions = [];
    protected $indexes = [];
    protected $foreignKeys = [];



    protected function addColumn($text)
    {
        $this->columns[] = $text /*. $this->getColumnOptions()*/;
    }

    /* protected function getColumnOptions()
    {
        $options = '';

        if (!empty($this->columnOptions)) {
            $options .= ' ' . implode(' ', $this->columnOptions);
            $this->columnOptions = [];
        }

        return $options;
    }*/

    public function addPrimaryKey($columns)
    {
        if (is_array($columns)) {
            $this->primaryKeys = array_merge($this->primaryKeys, $columns);
        } else {
            $this->primaryKeys[] = $columns;
        }
        return $this;
    }

    public function addUniqueKey($columns)
    {
        if (is_array($columns)) {
            $this->uniqueKeys = array_merge($this->uniqueKeys, $columns);
        } else {
            $this->uniqueKeys[] = $columns;
        }
        return $this;
    }

    public function index($columns)
    {
        if (is_array($columns)) {
            $this->indexes = array_merge($this->indexes, $columns);
        } else {
            $this->indexes[] = $columns;
        }
        return $this;
    }

    public function addData($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function createTable($table)
    {
        if (!empty($this->columns)) {
            $query = "CREATE TABLE IF NOT EXISTS $table (";

            foreach ($this->columns as $column) {
                $query .= checkNullString($column) . ",";
            }

            if (!empty($this->primaryKeys)) {
                $query .= " PRIMARY KEY (" . implode(",", $this->primaryKeys) . "),";
            }

            if (!empty($this->uniqueKeys)) {
                $query .= " UNIQUE KEY (" . implode(",", $this->uniqueKeys) . "),";
            }

            if (!empty($this->indexes)) {
                $query .= " INDEX (" . implode(",", $this->indexes) . "),";
            }

            if (!empty($this->foreignKeys)) {
                $query .= implode(",", $this->foreignKeys) . ",";
            }

            $query = rtrim($query, ",");
            $query .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

            $this->query($query);


            $this->resetProperties();

            echo "\n\r Table $table successfully created! \n\r";
        } else {
            echo "\n\r Table $table could not be created! \n\r";
        }
    }

    public function dropTable($table)
    {
        $this->query('drop table ' . $table);

        echo "\n\r Table $table successfully removed! \n\r";
    }

    public function insertData($table)
    {
        if (!empty($this->data)) {
            $keys = array_keys($this->data);
            $query = "insert into $table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
            $this->query($query, $this->data);

            $this->data   = [];

            echo "\n\r Data inserted successfully in table: $table \n\r";
        } else {
            echo "\n\r Data could not be inserted in table: $table \n\r";
        }
    }

    public function id($columnName = 'id')
    {
        $this->addColumn("`$columnName` INT UNSIGNED NOT NULL AUTO_INCREMENT");
        $this->addPrimaryKey($columnName);
        return $this;
    }

    public function string($columnName, $length = 255)
    {
        $this->addColumn("`$columnName` VARCHAR($length)");
        return $this;
    }

    public function int($columnName, $length = 11)
    {
        $this->addColumn("`$columnName` INT($length)");
        return $this;
    }

    public function text($columnName)
    {
        $this->addColumn("`$columnName` TEXT");
        return $this;
    }

    public function date($columnName)
    {
        $this->addColumn("`$columnName` DATE");
        return $this;
    }

    public function datetime($columnName)
    {
        $this->addColumn("`$columnName` DATETIME");
        return $this;
    }

    public function timestamp($columnName)
    {
        $this->addColumn("`$columnName` TIMESTAMP");
        return $this;
    }

    public function decimal($columnName, $totalDigits, $decimalDigits)
    {
        $this->addColumn("`$columnName` DECIMAL($totalDigits, $decimalDigits)");
        return $this;
    }

    public function float($columnName)
    {
        $this->addColumn("`$columnName` FLOAT");
        return $this;
    }

    public function double($columnName)
    {
        $this->addColumn("`$columnName` DOUBLE");
        return $this;
    }

    public function real($columnName)
    {
        $this->addColumn("`$columnName` REAL");
        return $this;
    }

    public function time($columnName)
    {
        $this->addColumn("`$columnName` TIME");
        return $this;
    }

    public function year($columnName)
    {
        $this->addColumn("`$columnName` YEAR");
        return $this;
    }

    public function custom_columns($columnDefinition)
    {
        $this->addColumn($columnDefinition);
        return $this;
    }

    public function custom_table($tableName)
    {
        // $table($tableName);
        return $this;
    }

    public function default($value)
    {
        if (!in_array($value, [null, NULL, 'CURRENT_TIMESTAMP']) && !is_int($value)) {
            $value = "'" . $value . "'";
        }

        $this->columns[count($this->columns) - 1] .= " DEFAULT $value";
        return $this;
    }

    public function nullable()
    {
        $this->columns[count($this->columns) - 1] .= " NULL";
        return $this;
    }

    public function unique()
    {
        $this->columns[count($this->columns) - 1] .= " UNIQUE";
        return $this;
    }

    public function longtext($columnName)
    {
        $this->addColumn("`$columnName` LONGTEXT");
        return $this;
    }

    protected function resetProperties()
    {
        $this->columns = [];
        $this->primaryKeys = [];
        $this->uniqueKeys = [];
        $this->indexes = [];
        $this->foreignKeys = [];
        // $this->defaults = [];
    }
}

function checkNullString($inputString)
{
    if (stripos($inputString, 'NULL') !== false) {
        return $inputString;
    } else {
        return $inputString . ' NOT NULL';
    }
}
