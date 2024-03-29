<?php

class App{

    protected static $router;

    /**
     * @return mixed
     */
    public static function getRouter()
    {
        return self::$router;
    }

    public static function run($uri)
    {
        self::$router = new Router($uri);

        $controller_class = ucfirst(self::$router->getController()).'Controller';

        $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());

        $layout = self::$router->getRoute();

        if(self::$router->getController() == 'account'){
            if($layout == 'default') {
                $client_middleware = new ClientMiddleware();
                if (!$client_middleware->handle()) {
                    header('Location: /user/login');
                }
            }
        }

        if(($layout == 'admin' || self::$router->getController() == 'admin') && $controller_method != 'admin_login'){
            $admin_middleware = new AdminMiddleware();
            if(!$admin_middleware->handle()){
                header( 'Location: /admin/user/login');
            }
        }


        //Calling controller's method
        if($controller_class!= null && $controller_method!=null) {

            $controller_object = new $controller_class();

            if (method_exists($controller_object, $controller_method)) {
                //Controller's action may  a return a view path
                $view_path = $controller_object->$controller_method();

                try {
                    $view_object = new View($controller_object->getData(), $view_path);
                } catch (Exception $e) {}

                $content = $view_object->render();
            }

            } else {
                require_once ('../views/404/404.php');
                throw new Exception('Method '.$controller_method.' of class '.$controller_class.' does not exist.');

            }


            $layout_path = VIEWS_PATH.DS.$layout.'.php';


            try {
                $layout_view_object = new View(compact('content'), $layout_path);
            } catch (Exception $e) {
            }

            echo $layout_view_object->render();


    }


}