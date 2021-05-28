<?php


class Router
{

    /**
     *
     */
    function process()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace('/tp4/index.php', '', $url);
        /**
         * mapping entre $uri et routes.json
         * Prevoir route non connue => 404
         */
        $json = file_get_contents('routes.json');
        $data = json_decode($json, true);

        $error404 = true;

        foreach ($data as $route){
            if($route['path'] == $url){
                $error404 = false;
                $controller = $route['controller'];
                $controller = explode('@', $controller);
            }
        }

        if($error404){
            return http_response_code(404);
        }

        $className = "\App\Controller\\" . $controller[0];
        $className = new $className();
        $method = $controller[1];
        return $className->$method();


        /**
         * instance controller de la route appel de la methode
         */

    }

}