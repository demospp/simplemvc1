<?php

namespace Views;

use Interfaces\ViewInterface;

class Page404 implements ViewInterface
{
    public function render()
    {
        http_response_code(404);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Нет такой страницы</title>
        </head>
        <body>
            Здесь был я.
        </body>
        </html>
        <?php
    }
}
