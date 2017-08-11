<?php

namespace Controller;

use Interfaces\ControllerInterface;

class Page404 implements ControllerInterface
{
    public function render()
    {
       $view = new \Views\Page404();
       $view->render();
    }
}
