<?php

namespace Views;

use Model\PageModel;

class EditPage extends IndexLayout
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
        $time = $row->getModified()->format('Y-m-d\TH:i:s');;

        ?>
        <h2><?= $this->getTitle() ?></h2>
        <form method="post">
        <table class="my_table">
            <tbody>
            <tr>
                <td>title</td><td><input type="text" name="title" value="<?= htmlentities($row->getTitle())?>"></td>
            </tr><tr>
                <td>body</td><td><textarea name="body"><?=htmlentities($row->getBody())?></textarea></td>
            </tr><tr>
                <td>keywords</td><td><input type="text" name="keywords" value="<?=htmlentities($row->getKeywords())?>"></td>
            </tr><tr>
                <td>modified</td><td><input type="datetime-local" name="modified" value="<?=$time?>"></td>
            </tr><tr>
                <td colspan="2"><input type="submit"></td>
            </tr>
            </tbody>
        </table>
        </form>
        <?php
    }
}