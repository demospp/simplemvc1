<?php

namespace Views;

use Model\PageModel;

class ViewPage extends IndexLayout
{
    /** @var PageModel  */
    protected $page = null;

    /**
     * @return PageModel
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param PageModel $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }


    protected function renderBody()
    {
        /** @var PageModel $row */
        $row = $this->page;
        ?>
        <h2><?= $this->getTitle() ?></h2>
        <a href="/edit?id=<?=$this->page->getPageId()?>">редактировать</a>
        <table class="my_table">
            <tbody>
            <tr>
                <td>id</td><td><?=htmlentities($row->getPageId())?></td>
            </tr><tr>
                <td>title</td><td><?=htmlentities($row->getTitle())?></td>
            </tr><tr>
                <td>body</td><td><?=htmlentities($row->getBody())?></td>
            </tr><tr>
                <td>keywords</td><td><?=htmlentities($row->getKeywords())?></td>
            </tr><tr>
                <td>modified</td><td><?=htmlentities($row->getModified()->format('Y-m-d H:i:s'))?></td>
            </tr>
            </tbody>
        </table>
        <?php
    }
}