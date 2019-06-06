<?php


class SQLBuilder
{

    private static $instance = null;
    private static $camps;
    public static $table = null;
    private $from ;
    private $where_string;
    private $or;
    private $and;
    private $limit;
    private $offset;
    private $orderBy;
    private $sortBy;
    private $groupBy;
    private $joins = array();

    private $where_data = array();
    private $orData = array();
    private $andData = array();

    private static $tableUpdate;
    private $fieldUpdate;
    private $valueUpdate = array();

    private static $deleteFrom;

    private static $insertInto;
    private $fieldsInsert;
    private $insertValues;
    private $insertData = array();

    public static function table($table)
    {
        self::$instance = new SQLBuilder();
        self::$table = $table;
        self::$tableUpdate = $table;
        self::$deleteFrom = $table;
        self::$insertInto = $table;
        return self::$instance;
    }


    public static function select(...$camps1)
    {
        $fields = func_get_args();
        self::$instance = new SQLBuilder();
        if (is_array($fields) && !empty($fields)) {
            self::$camps = implode(',', $fields);
        } elseif (is_array($fields) && empty($fields)) {
            self::$camps = '*';
        } elseif ($fields !== '') {
            self::$camps = $fields;
        }
        return self::$instance;
    }


    public function from(...$tableParam)
    {
        // Check this!
        if(!self::$table){
            $this->from = self::$table;
        }
        $table = func_get_args();
        $count = func_num_args();
        if($count === 1)
            $this->from = implode($table);
        else if($count>1)
            $this->from = implode(",", $table);
        else
            $this->from = false;

        return $this;
    }



    public function where($where, ...$wildcard)
    {
        // echo 'Okay guys';
        $params = func_get_args();
        array_shift($params);
        // print_r($params);
        // echo count($params);
        $this ->where_string = ' WHERE '.$where;
        $this ->where_data = $params;

        return $this;
    }




    public function whereBetween($field, $values)
    {
        if (empty($values) || count($values) > 2) {
            return false;
        }
        if (empty($values[0]) || empty($values[1])) {
            return false;
        }
        return $this->where("{$field} BETWEEN " . (is_numeric($values[0]) ? $values[0] : "'{$values[0]}'") . " AND " . (is_numeric($values[1]) ? $values[1] : "'{$values[1]}'"));
    }


    public function whereNull($field)
    {
        return $this->where("{$field} IS NULL");
    }


    public function WhereNotNull($field)
    {
        return $this->where("{$field} IS NOT NULL");
    }


    public function or($or, ...$wildcard)
    {
        $params = func_get_args();
        array_shift($params);
        $this ->or = ' OR '.$or;
        $this ->orData = $params;
        return $this;
    }


    public function and($and, ...$wildcard)
    {
        $params = func_get_args();
        array_shift($params);
        $this ->and =  $this ->and.' AND '.$and;
        $this ->andData[] = $params[0];
        return $this;
    }



    public function join($table = array(), $condition = '', $type = 'inner')
    {
        return call_user_func_array([$this, ($type . 'Join')], [$table, $condition]);
    }



    public function innerJoin($table = array(), $condition = '')
    {
        if (is_array($table)) {
            $this->joins['inner'][] = "INNER JOIN " . $table[key($table)] . " AS " . key($table) . " ON " . $condition;
        } else {
            $this->joins['inner'][] = "INNER JOIN " . $table . " ON " . $condition;
        }
        return $this;
    }



    public function leftJoin($table = array(), $condition = '')
    {
        if (is_array($table)) {
            $this->joins['left'][] = "LEFT JOIN " . $table[key($table)] . " AS " . key($table) . " ON " . $condition;
        } else {
            $this->joins['left'][] = "LEFT JOIN " . $table . " ON " . $condition;
        }
        return $this;
    }



    public function rightJoin($table = array(), $condition = '')
    {
        if (is_array($table)) {
            $this->joins['right'][] = "RIGHT JOIN " . $table[key($table)] . " AS " . key($table) . " ON " . $condition;
        } else {
            $this->joins['right'][] = "RIGHT JOIN " . $table . " ON " . $condition;
        }
        return $this;
    }



    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }



    public function offset($offset)
    {
        if (empty($this->limit)) {
            return false;
        }

        $this->offset = $offset;
        return $this;
    }



    public function orderBy($camp, $order)
    {
        $this->orderBy = $camp;
        $this->sortBy = $order;
        return $this;
    }


    public function groupBy($camps = array())
    {
        if (is_array($camps)) {
            $this->groupBy = implode(',', $camps);
        } else {
            $this->groupBy = $camps;
        }
        return $this;
    }



    public function assemble($flag = null)
    {
        if (empty(self::$camps)) {
            self::$camps = "*";
        }
        if ($this->from === false) {
            return false;
        }

        if (self::$table) {
            $this->from = self::$table;
        }
        //echo $this->from;
        $query = "SELECT " . self::$camps . " FROM " . $this->from;
        if ($this->validJoins()) {
            foreach ($this->joins AS $type => $value) {
                if (count($value)) {
                    for ($i = 0; $i < count($value); $i++) {
                        $query .= ' ' . $value[$i];
                    }
                }
            }
        }

        $query .= $this->where_string;
        $query .= $this->and;
        $query .= $this->or;
        if (strlen($this->groupBy) > 0) {
            $query .= " GROUP BY {$this->groupBy}";
        }
        if (!empty($this->orderBy) && !empty($this->sortBy)) {
            $query .= " ORDER BY {$this->orderBy} {$this->sortBy}";
        }
        if (!empty($this->limit) && is_numeric($this->limit) && intval($this->limit) > 0) {
            $query .= " LIMIT {$this->limit}";
        }
        if (!empty($this->offset) && is_numeric($this->offset) && intval($this->offset) > 0) {
            $query .= " OFFSET {$this->limit}";
        }

        $query .= $flag;
        $query .= ";";

        $result = [];

        foreach($this->where_data as $val) {
            $result[] = $val;
        }

        foreach($this->orData as $val) {
            $result[] = $val;
        }
        foreach($this->andData as $val) {
            $result[] = $val;
        }

//        echo debugSQL($query, $result);
        return SQL($query, $result);

    }



    private function validJoins()
    {
        if (count($this->joins) >= 1) {
            $counter = 0;
            foreach ($this->joins AS $type => $join) {
                if (count($join) >= 1) {
                    $counter ++;
                }
            }
            return ($counter <= 0) ? false : true;
        }
        return false;
    }



    public function get()
    {
        return $this->assemble('');
    }



    public function getFirst()
    {
        return $this->assemble(' LIMIT 1 ');
    }


    public static function update($table)
    {
        // $table = func_get_args();
        self::$instance = new SQLBuilder();

        self::$tableUpdate = $table;

        return self::$instance;
    }

//    public function set($fields, ...$value)
//    {
//        $this->fieldUpdate = $fields;
//        $params = func_get_args();
//        array_shift($params);
//        $this->valueUpdate = $params;
//        return $this;
//    }
    public function set($fields, $params = [])
    {
        $this->fieldUpdate = $fields;
        // echo  $this->fieldUpdate;
//        $params = func_get_args();
//        array_shift($params);
        $this->valueUpdate = $params;
        // print_r( $this->valueUpdate);
        return $this;
    }

    public function runUpdate()
    {
        $query = " UPDATE ".self::$tableUpdate." SET ".$this->fieldUpdate;
        $result = [];

        foreach($this->valueUpdate as $val) {
            $result[] = $val;
        }

        foreach($this->where_data as $val) {
            $result[] = $val;
        }
        if ($this->where_string){
            $query = $query.''.$this->where_string;
//            echo debugSQL($query, $result);
            return SQL($query, $result);
            // echo debugSQL($query, $this->valueUpdate);
        }
        else{
//            echo  debugSQL($query, $result);
            return SQL($query, $result);
            // echo debugSQL($query, $this->valueUpdate);
        }
    }

    public static function delete($table)
    {

        self::$instance = new SQLBuilder();

        self::$deleteFrom = $table;

        return self::$instance;
    }

    public function runDelete()
    {
        $query = " DELETE FROM ".self::$deleteFrom;

        if ($this->where_string){
            $query = $query.''.$this->where_string.";";
//            echo  debugSQL($query, $this->where_data);
           return SQL($query, $this->where_data);
//            echo  debugSQL($query, $this->where_data);
        }
        else{
            $query.=";";
           return SQL($query, $this->where_data);
//            echo debugSQL($query);
        }
    }

    public static function insert($table)
    {
        self::$instance = new SQLBuilder();

        self::$insertInto = $table;

        return self::$instance;
    }

    public function fields($field)
    {
        $this->fieldsInsert = $field;
        return $this;
    }

    public function values($values, $dataArray = [])
    {
        $this->insertValues = $values;
        $this->insertData = $dataArray;
        return $this;
    }

    public function runInsert()
    {
        $query = " INSERT INTO ".self::$insertInto.'('.$this->fieldsInsert." ) "." VALUES"."(".$this->insertValues.")".";";
//        echo debugSQL($query, $this->insertData);
       return SQL($query, $this->insertData);
    }


}
