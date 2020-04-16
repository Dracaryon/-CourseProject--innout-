<?php

class Model {
    protected static $tableName = '';
    protected static $columns = [];
    protected $values = [];

    function __construct($arr) {
        $this->loadFromArray($arr);
    }


    public function loadFromArray($arr){
        if($arr) {
            foreach($arr as $key => $value) {
                $this->$key = $value;
            }
        }
    }
    
    public function __get($key) {
        // if (isset($key)){
            return $this->values[$key];
        // }
        
    }

    public function __set($key, $value){
        $this->values[$key] = $value;
    }

    
    public static function getOne($filters = [], $columns = '*') { //implementar no login
        
        $class = get_called_class(); //pegar a classe que chamou o get
        $result = static::getResultSetFromSelect($filters, $columns);

        return $result ? new $class($result->fetch_assoc()) : null;
    }

    public static function get($filters = [], $columns = '*') {
        $objects = [];
        $result = static::getResultSetFromSelect($filters, $columns);
        if($result) {
            $class = get_called_class(); //pegar a classe que chamou o get
            while($row = $result->fetch_assoc()) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function getResultSetFromSelect($filters = [], $columns = '*') {
        $sql = "SELECT ${columns} FROM "
            . static::$tableName
            .static::getFilters($filters);
        $result = Database::getResultFromQuery($sql);
        if($result->num_rows === 0) {
            return null;
        } else {
            return $result;
        }
    }
    //aula 274:
    //metódo pra inserir dados no BD
    //"implode()" transforma um array em string
    public function insert() {
        $sql = "INSERT INTO " . static::$tableName . " ("
            . implode(",", static::$columns) . ") VALUES (";
        foreach(static::$columns as $col) {
            //como esse metódo n é estático e sim acessado através de uma instância (ex.: user ou working hours) deverá ser feito conforme abaixo (em parenteses); para termos o valor exato da coluna do objeto precisa ser com o "$this". Foreach precisa ser na mesma ordem das colunas
            $sql .= static::getFormatedValue($this->$col) . ",";
        }
        //No último foreach, haverá uma vírgula, mas o parenteses precisa ser fechado. O metódo abaixo remove a vírgula e coloca uma vírgula no final da string.
        $sql[strlen($sql) - 1] = ')';
        $id = Database::executeSQL($sql);
        echo "$id";
        $this->id = $id;
       
    }

    public function update() {
        $sql = "UPDATE " . static::$tableName . " SET ";
        foreach(static::$columns as $col) {
            $sql .= " ${col} = " . static::getFormatedValue($this->$col) . ",";
        }
        $sql[strlen($sql) - 1] = ' ';
        $sql .= "WHERE id = {$this->id}";
        Database::executeSQL($sql);
    }

    //trabalhar a clausula where
    private static function getFilters($filters) {
        $sql = '';
        if(count($filters) > 0) {
            $sql .= " WHERE 1 = 1";
            foreach($filters as $column => $value) {
            $sql .= " AND ${column} = " . static::getFormatedValue($value);
            }
        }
        return $sql;
    }

    //colocar as apas nas strings para usar o metodo anterior
    private static function getFormatedValue($value) {
        if(is_null($value)) {
            return "null";
        } elseif(gettype($value) === 'string') {
            return "'${value}'";
        } else {
            return $value;
        }
    }
}

