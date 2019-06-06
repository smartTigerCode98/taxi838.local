<?php

//require('DB.php');

//define('DB_HOST', 'localhost');
//define('DB_NAME', 'diagnoses');
//define('DB_USER', 'root');
//define('DB_PASS', '');
//define('DB_CHAR', 'utf8');


//function SQL($query, $args = [])
//{
//    $result = DB::SQL($query, $args);
//    return $result;
//}

function convertToAssociativeArray($args=array())
{
    $res = implode($args);
    $array1 = array();
    $array2 = explode(', ', $res);
    foreach($array2 as $str) {
        list($key, $value) = explode(' => ', $str);
        $array1[$key] = $value;
    }
    return $array1;
}

//function SQL($query, ...$args)
//{
//    if(strpos($query, ':') === false) {
//        $params = func_get_args();
//        array_shift($params);
//        $result = DB::SQL($query, $params);
//        return $result;
//    } else{
//        $params = convertToAssociativeArray($args);
//        return DB::SQL($query, $params);
//    }
//}

//function debugSQL($query, ...$args)
//{
//    if(strpos($query, ':') === false){
//        $params = func_get_args();
//        array_shift($params);
//        $result = DB::debugSQL($query, $params);
//        return $result;
//    }else{
//        $params = convertToAssociativeArray($args);
//        return DB::debugSQL($query, $params);
//    }
//}

function SQL($query, $args = array())
{
    $result = DB::SQL($query, $args);
    return $result;
}

function debugSQL($query, $args = array())
{
    $result = DB::debugSQL($query, $args);
    return $result;
}
