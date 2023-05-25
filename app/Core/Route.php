<?php

namespace app\Core;

use Exception;
    
class Route
{
    public static function run()
    {
        try {
            $filterRoute = new FilterRoute;
            $route = $filterRoute->get();

            $controller = new Controller;
            return $controller->execute($route);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
