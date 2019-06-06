<?php

require_once (ROOT.DS.'config'.DS.'config.php');

function __autoload($class_name)
{
//    $lib_path =  ROOT.DS.'lib'.DS.strtolower($class_name).'.class.php';

    $lib_path =  ROOT.DS.'lib'.DS.$class_name.'.class.php';

    $controllers_path =  ROOT.DS.'controllers'.DS.str_replace('controller', '', strtolower($class_name)).'.controller.php';

//    $model_path = ROOT.DS.'models'.DS.strtolower($class_name).'.php';

    $model_path = ROOT.DS.'models'.DS.$class_name.'.php';

    $middleware_path = ROOT.DS.'middleware'.DS.str_replace('middleware', '', strtolower($class_name)).'.middleware.php';



//    if (file_exists($lib_path)){
//        require_once ($lib_path);
//    }elseif(file_exists($controllers_path)){
//        require_once ($controllers_path);
//    }elseif(file_exists($model_path)){
//        require_once ($model_path);
//    }else {
//        throw new Exception('Failed to include class: '.$class_name);
//    }

    if (file_exists($lib_path)){
        require_once ($lib_path);
    }elseif(file_exists($model_path)){
        require_once ($model_path);
    }elseif(file_exists($middleware_path)){
        require_once ($middleware_path);
    }elseif(file_exists($controllers_path)){
        require_once ($controllers_path);
    }else {
        throw new Exception('Failed to include class: '.$class_name);
    }

}