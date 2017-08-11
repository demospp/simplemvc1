<?php

namespace Views;

use Model\PageModel;

class ListPage extends IndexLayout
{
    protected $offsetName = '';
    protected $items = [];
    protected $pg = [];

    public function __construct($offsetName)
    {
        $this->offsetName = $offsetName;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function getPg()
    {
        return $this->pg;
    }

    /**
     * @param array $pg
     */
    public function setPg($pg)
    {
        $this->pg = $pg;
    }

    protected function renderBody()
    {
        /** @var PageModel $row */
        ?>
        <h2><?= $this->getTitle() ?></h2>
        <a href="/edit">новая</a>
        <table class="my_table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>body</th>
                    <th>keywords</th>
                    <th>modified</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($this->items as $row):?>
            <tr>
                <td><?=htmlentities($row->getPageId())?></td>
                <td><?=htmlentities($row->getTitle())?></td>
                <td><?=htmlentities($row->getBody())?></td>
                <td><?=htmlentities($row->getKeywords())?></td>
                <td><?=htmlentities($row->getModified()->format('Y-m-d H:i:s'))?></td>
                <td><a href="/edit?id=<?=$row->getPageId()?>" target="_blank">редактировать</a></td>
                <td><a href="/view?id=<?=$row->getPageId()?>" target="_blank">просмотр</a></td>
                <td><a href="?id=<?=$row->getPageId()?>">удалить</a></td>
            </tr>
        <?php endforeach;?>
            </tbody>
        </table class="my_table">
        <?php if ($this->pg) :?>
            <table>
                <tr>
                <?php foreach ($this->pg as $p):?>
                    <?php $p[0] = htmlentities($p[0]);?>
                    <td>
                        <?php if (isset($p[1])) :?>
                            <a href = "?<?=$this->offsetName.'='.$p[1] ?>"><?=$p[0]?></a>
                        <?php else:?>
                            <?=$p[0]?>
                        <?php endif;?>
                    </td>
                <?php endforeach;?>
                </tr>
            </table>
        <?php endif; ?>
        <?php
    }
}