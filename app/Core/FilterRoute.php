<?php

namespace app\Core;

use app\Routes\Routes;
use app\Support\RequestType;
use app\Support\Uri;

class FilterRoute
{
    private string $uri;
    private string $requestMethod;
    private array $routes;


    public function __construct()
    {
        $this->uri = Uri::getUri();
        $this->requestMethod = RequestType::getRequestType();
        $this->routes = Routes::get();
    }

    public function extactRoute()
    {

        if (array_key_exists($this->uri, $this->routes[$this->requestMethod])) {
            return $this->routes[$this->requestMethod][$this->uri];
        }
        return null;
    }

    public function dynamicRoute()
    {

        foreach ($this->routes[$this->requestMethod] as $index => $route) {

            $regex = str_replace("/", "\/", ltrim($index, "/"));
            if (preg_match("/^{$regex}$/", ltrim($this->uri, "/"))) {
                return $route;
            }
        }
        
        return "NotFoundController@index";
    }

    public function get()
    {
        return $this->extactRoute() ?? $this->dynamicRoute();
    }
}
