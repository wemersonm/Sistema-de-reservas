<?php

namespace app\Core;

use app\Routes\Routes;
use app\Support\RequestType;
use app\Support\Uri;

class GetParams
{
    public function getParams($route)
    {
        $uri = Uri::getUri();
        $requestMethod = RequestType::getRequestType();
        $routes = Routes::get();

        $indexRoute = array_search($route, $routes[$requestMethod]);
        $separateRoute = explode("/", ltrim($indexRoute, "/"));
        $separateUri = explode("/", ltrim($uri, "/"));
        $routeDiff = array_diff($separateUri, $separateRoute);
        return array_values($routeDiff);
    }
}
