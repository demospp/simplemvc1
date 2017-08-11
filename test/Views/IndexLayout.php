<?php

namespace Views;

use Interfaces\ViewInterface;

class IndexLayout implements ViewInterface
{
    private $title = '';

    public function render()
    {
        ?>
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <title><?=$this->getTitle()?></title>
            <link rel="stylesheet" href="/css/style.css" />
        </head>
        <body>
        <?php $this->renderBody() ?>
        </body>
        </html>
        <?php
    }

    /**
     * @return string
     */
    protected function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    protected function renderBody()
    {
        return '';
    }
}
