<?php

namespace Controller;

use Config\Config;
use Interfaces\ControllerInterface;
use Model\PageRepository;
use Views\ViewPage;

class ViewController implements ControllerInterface
{
    public function render()
    {
        $db = Config::getDb();
        $id = $_GET['id'] ?? 0;
        $rep = new PageRepository($db);
        $obj = $rep->get($id);
        if ($obj)
        {
            $view = new ViewPage();
            $view->setTitle('Просмотр');
            $view->setPage($obj);
            $view->render();
        }
        else
        {
            header('Location:/404');exit();
        }
    }
}
