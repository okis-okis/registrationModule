<?php

declare(strict_types = 1);

namespace App;

use App\Errors\RouteNotFoundException;

class Router
{
    private array $routes;

    public function register(string $route, callable|array $action): self
    {
        $this->routes[$route] = $action;

        return $this;
    }

    public function printRoutes(): void
    {
        echo '<pre>';
        var_dump($this->routes);
        echo '</pre>';
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function resolve(string $requestUri)
    {
        $route = explode('?', $requestUri)[0];

        $action = $this->routes[$route] ?? null;

        if(!$action){
            //Error
            throw new RouteNotFoundException();
        }

        if(is_callable($action)){
            return call_user_func($action);
        }

        if(is_array($action)){
            [$class, $method] = $action;

            if(class_exists($class)){
                $class = new $class();
                if(method_exists($class, $method)){
                    return call_user_func_array([$class, $method], []);
                }
            }
        }

        throw new RouteNotFoundException();
    }
}