<?php

namespace Config;

class Router
{
    private $route = [];

    public function __construct()
    {
        $route = [];
        $route['list'] = \Controller\ListController::class;
        $route['edit'] = \Controller\EditController::class;
        $route['view'] = \Controller\ViewController::class;
        $route['404'] = \Controller\Page404::class;
        $this->route = $route;
    }

    public function proc()
    {
        $request = trim($_SERVER['DOCUMENT_URI'],'/');
        $route = $this->route;

        /** @var \Interfaces\ControllerInterface $controller */
        if(isset($route[$request]))
        {
            $controller = new $route[$request]();
        }
        else
        {
            $controller = new $route['404']();
        }
        echo $controller->render();
    }
}
