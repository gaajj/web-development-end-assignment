<?php

namespace App;

class Router
{
    private $routes = [];

    public function add($route, $controller, $action)
    {
        $routePattern = preg_replace('/{(\w+)}/', '(\w+)', $route);
        $routePattern = "#^" . $routePattern . "$#";

        $this->routes[] = [
            'pattern' => $routePattern,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function route($url)
    {
        foreach ($this->routes as $route) {
            if (preg_match($route['pattern'], $url, $matches)) {
                array_shift($matches);

                $controller = $route['controller'];
                $action = $route['action'];
                $controllerObject = new $controller;
                call_user_func_array([$controllerObject, $action], $matches);
                return;
            }
        }

        echo "404 not found";
    }
}
