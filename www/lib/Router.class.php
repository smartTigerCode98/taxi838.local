<?php

class Router{

    protected $uri;

    protected $controller;

    protected $action;

    protected $params;

    protected $route;

    protected $method_prefix;

    protected $language;

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return mixed
     */
    public function getMethodPrefix()
    {
        return $this->method_prefix;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }


    public function __construct($uri)
    {

        $flag = false;

        $routes = Config::get('routes');

        // Get default
        $this->route = Config::get('default_route');

        $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';

        $this->language = Config::get('default_language');

        $url = urldecode(trim($uri, '/'));

        $allRoutes = Config::get('Routes');

        foreach ($allRoutes as $urlPattern => $path){

            if(preg_match("~^$urlPattern$~", $url)){

                $url= preg_replace("~^$urlPattern$~",$path, $url);

                $flag = true;

                break;
            }
        }

        if($flag) {

            $this->uri = urldecode(trim($url, '/'));

            //Get path like /lng/controller/action/param1/param2/.../...

            $path_parts = explode('/', $this->uri);

            if (count($path_parts)) {
                //Get route or language  at first element
                if (in_array(strtolower(current($path_parts)), array_keys($routes))) {

                    $this->route = strtolower(current($path_parts));

                    $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';

                    array_shift($path_parts);

                } elseif (in_array(strtolower(current($path_parts)), Config::get('language'))) {

                    $this->language = strtolower(current($path_parts));

                    array_shift($path_parts);
                }
                // Get controller - next element of array
                if (current($path_parts)) {

                    $this->controller = strtolower(current($path_parts));

                    array_shift($path_parts);
                }

                if (current($path_parts)) {

                    $this->action = strtolower(current($path_parts));

                    array_shift($path_parts);
                }

                //Get params - all the rest
                $this->params = $path_parts;

            }
        }

    }


    public static function redirect($path)
    {
        header("Location: $path");
    }

}