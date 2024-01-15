<?php
class Router
{
    private $routes;
    public function __construct()
    {
        $this->routes = [];

    }
    public function addRoute(string $method, string $path, string $controller, string $action)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }
    public function getHandler(string $method, string $uri)
    {
        foreach ($this->routes as $route) {
            $routeParts = explode('/', $route['path']);
            $uriParts = explode('/', $uri);


            $count = count($uriParts) - 1;



            if (str_contains($uriParts[$count], '?')) {
                $clean = strstr($uriParts[$count], '?', true);
                $uriParts[$count] = $clean;
            }

            if ($route['method'] === $method && count($routeParts) === count($uriParts)) {

                $params = [];
                $paramName = null;
                $match = true;

                foreach ($routeParts as $index => $part) {


                    if (isset($part[0]) && $part[0] === '{' && $part[strlen($part) - 1] === '}') {


                        $paramName = trim($part, '{}');

                        $params[$paramName] = $uriParts[$index];

                        str_contains($params[$paramName], '?') ? $params[$paramName] = strstr($params[$paramName], '?', true) : null;

                    } elseif ($part !== $uriParts[$index]) {

                        $match = false;
                        break;
                    }
                }



                if ($match) {
                    return [
                        'method' => $route['method'],
                        'controller' => $route['controller'],
                        'action' => $route['action'],
                        'params' => $params[$paramName] ?? "",
                    ];
                }
            }
        }

        return null;
    }


}