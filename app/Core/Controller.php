<?php

namespace app\Core;

use app\Routes\Routes;
use app\Support\RequestType;
use app\Support\Uri;
use Exception;

class Controller
{
    public function execute(string $route)
    {

        list($controller, $method) = explode("@", $route);
        $controllerWithNamespace = "app\\Controllers\\" . $controller;
        if (!class_exists($controllerWithNamespace)) {
            throw new Exception("A classe {$controller} não existe");
        }
        $instanceController = new $controllerWithNamespace;
        if (!method_exists($instanceController, $method)) {
            throw new Exception("O método {$method} não existe");
        }
        $params = new GetParams;
        $params = $params->getParams($route);
        return $instanceController->$method($params);
    }
}
