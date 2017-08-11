<?php

namespace Controller;

use Config\Config;
use Interfaces\ControllerInterface;
use Model\PageModel;
use Model\PageRepository;
use Views\EditPage;

class EditController implements ControllerInterface
{
    public function render()
    {
        $db = Config::getDb();
        $id = $_GET['id'] ?? 0;
        $rep = new PageRepository($db);
        /** @var PageModel $obj */
        if ($id)
        {
            $obj = $rep->get($id);
            if ($obj)
            {
                if($_POST)
                {
                    $this->setData($_POST, $obj);
                    $rep->update($obj);
                }
                $view = $this->createView($obj);
                $view->render();
            }
            else
            {
                header('Location:/404');exit();
            }
        }
        elseif ($_POST)
        {
            $obj = new PageModel();
            $this->setData($_POST, $obj);
            $rep->add($obj);
            header('Location:/edit?id='.$obj->getPageId());exit();
        }
        else
        {
            $obj = new PageModel(null);
            $obj->setModified(new \DateTime());
            $view = $this->createView($obj);
            $view->render();
        }
    }

    protected function createView($page): EditPage
    {
        $view = new EditPage();
        $view->setTitle('Редактировать');
        $view->setPage($page);
        return $view;
    }

    protected function setData(array $arr, PageModel $page)
    {
        $modified = new \DateTime($arr['modified']);
        $page->setTitle($arr['title']??'');
        $page->setBody($arr['body']??'');
        $page->setKeywords($arr['keywords']??'');
        $page->setModified($modified);
    }
}
