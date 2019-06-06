<?php

class DB{

    protected static $connection = null;

    protected function __construct() {}
    protected function __clone() {}

    public static function connect()
    {
        if (self::$connection === null)
        {
            try{

                $opt = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => TRUE,
                );
                $dsn = 'mysql:host=' . Config::get('db.host') . ';dbname=' . Config::get('db.db_name') . ';charset=' . Config::get('db.char');
                self::$connection = new PDO($dsn, Config::get('db.user'), Config::get('db.password'), $opt);

            } catch (PDOException $ex) {
                exit($ex->getMessage());
            }
        }
        return self::$connection;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::connect(), $method), $args);
    }

    public static function SQL($query, $args = [])
    {
        if (!$args)
        {
            $start_time  = microtime();
            $start_array = explode(" ", $start_time);
            $start_time  = $start_array[1] + $start_array[0];

            $result  = self::connect()->query($query);
            $resultArray = $result->fetchAll();


            $end_time  = microtime();
            $end_array = explode(" ", $end_time);
            $end_time  = $end_array[1] + $end_array[0];
            $time = $end_time - $start_time;
//            printf("<br><br>Has passed %f second<br><br>",$time);
            $countRows = $result->rowCount();
            if($countRows > 0 && !(stripos($query,'S')===0)){
                return true;
            }else{
                if(!(stripos($query,'S')===0))
                return false;
            }

//            $countRowsInfo = "Has a result of the request ".$countRows." rows";
//            echo $countRowsInfo;
//            echo '<br>';

            return $resultArray;

        }
        $stmt = self::connect()->prepare($query);
        $start_time  = microtime();
        $start_array = explode(" ", $start_time);
        $start_time  = $start_array[1] + $start_array[0];

        $stmt->execute($args);

        $end_time  = microtime();
        $end_array = explode(" ", $end_time);
        $end_time  = $end_array[1] + $end_array[0];
        $time = $end_time - $start_time;
//        printf("<br><br>Has passed %f second<br><br>",$time);
        $countRows = $stmt->rowCount();
//        echo $countRows;
        if($countRows>=0 && !(stripos($query,'S')===0)){
            return true;
        }else{
            if(!(stripos($query,'S')===0))
            return false;
        }
        $countRowsInfo = "Has a result of the request ".$countRows." rows";
//        echo $countRowsInfo;
//        echo '<br>';
        if(stripos($query,'S')===0)
            return $stmt->fetchAll();
    }

    public static function debugSQL($query, array $params = null) {
        if (!empty($params)) {
            $indexed = $params == array_values($params);
            foreach($params as $key=>$value) {
                if (is_object($value)) {
                    if ($value instanceof \DateTime) $value = $value->format('Y-m-d H:i:s');
                    else continue;
                }
                elseif (is_string($value)) $value="'$value'";
                elseif ($value === null) $value='NULL';
                elseif (is_array($value)) $value = implode(',', $value);

                if ($indexed) {
                    $query = preg_replace('/\?/', $value, $query, 1);
                }
                else {
                    if ($key[0] != ':') $key = ':'.$key;
                    $query = str_replace($key,$value,$query);
                }
            }
        }
        return $query;
    }

}