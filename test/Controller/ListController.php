<?php

namespace Controller;

use Config\Config;
use Interfaces\ControllerInterface;
use Model\PageRepository;
use Views\ListPage;

class ListController implements ControllerInterface
{
    public function render()
    {
        $db = Config::getDb();
        $id = $_GET['id'] ?? 0;
        $rep = new PageRepository($db);
        $offsetName = 'offset';
        $offset = $_GET[$offsetName] ?? 0;
        if($id)
        {
            if($obj = $rep->get($id))
            {
                $rep->delete($obj);
                header('Location:/list?'.$offsetName.'='.$offset);
            }
            else
            {
                header('Location:/404');
            }
            exit();
        }
        $limit = 10;

        $view = new ListPage($offsetName);
        $count = $rep->getCount();
        $view->setTitle('Список');
        $view->setItems($rep->getList($limit,$offset));
        $view->setPg($this->getPg($count, $limit, $offset));
        $view->render();
    }

    protected function getPg($count, $limit = 0, $offset = 0):array
    {
        if($offset > $count) $offset = $count - 1;
        $arrPg = [];
        if ($count)
        {
            if ($offset > 0)
            {
                $arrPg [] = ['<', ($offset - $limit > 0) ? ($offset - $limit) : 0];
            }

            $arrPg [] = [ceil($offset / $limit) + 1];
            if ($offset + $limit < $count)
            {
                $arrPg [] = ['>', $offset + $limit];
            }
        }
        return $arrPg;
    }
}