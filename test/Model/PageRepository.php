<?php

namespace Model;

use DateTime;
use Interfaces\DbInterface;

class PageRepository
{
    private $myDb = null;
    private $table = '`pet__page`';

    /**
     * @param DbInterface $myDb
     */
    public function __construct($myDb)
    {
        $this->myDb = $myDb;
    }

    public function add(PageModel $page)
    {
        $arr = $this->convertToArr($page);
        $str=[];
        foreach ($arr as $key => $val)
        {
            $str[]= '`'.$key.'` = ' .$this->myDb->escape($val);
        }

        $str = implode(' , ', $str);

        $sql = 'insert into '.$this->table.' set '.$str;
        $this->myDb->query($sql);
        $page->setPageId($this->myDb->getInsertId());
        return $page;
    }

    public function update(PageModel $page)
    {
        $arr = $this->convertToArr($page);

        if($id = $arr['pageId'])
        {
            $str=[];
            unset($arr['pageId']);
            foreach ($arr as $key => $val)
            {
                $str[]= '`'.$key.'` ='. $this->myDb->escape($val);
            }
            $str = implode(' , ', $str);
            $sql = 'update '.$this->table.' set '.$str.' where pageId ='.$id;
            $this->myDb->query($sql);
        }
        return $page;
    }

    /**
     * @param PageModel $page
     * @return mixed
     */
    public function delete(PageModel $page)
    {
        $id = (int)$page->getPageId();
        $sql = 'delete from '.$this->table.' where pageId = '.$id;
        return $this->myDb->query($sql);
    }

    public function get($id)
    {
        $id = (int)$id;
        $obj = null;
        $sql = 'select * from '.$this->table.' as pp where pp.pageId = '.$id;
        if (($res = $this->myDb->query($sql)) !== false )
        {
            while ($row = $res->fetch_assoc())
            {
                $obj = $this->convertToPage($row);
                break;
            }
        }
        return $obj;
    }

    public function getList($limit, $offset)
    {
        $pages = [];
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = 'select * from '.$this->table.' limit '.$offset.', '.$limit;
        /** @var \mysqli_result $res */
        if (($res = $this->myDb->query($sql)) !== false )
        {
            while ($row = $res->fetch_assoc())
            {
                $pages[$row['pageId']] = $this->convertToPage($row);
            }
        }
        return $pages;
    }

    public function getCount()
    {
        /** @var \mysqli_result $res */
        $sql = 'select count(*) from '.$this->table;
        $res = $this->myDb->query($sql);
        $count = $res->fetch_row()[0];
        return $count;
    }

    protected function convertToPage($arrPage):PageModel
    {
        if(empty($arrPage['pageId']))
        {
            throw  new \Exception('Invalid pageId');
        }
        $obj = new PageModel($arrPage['pageId']);
        $obj->setTitle($arrPage['title']);
        $obj->setBody($arrPage['body']);
        $obj->setKeywords($arrPage['keywords']);
        $obj->setModified(new DateTime($arrPage['modified']));
        return $obj;
    }

    /**
     * @param PageModel $page
     * @return array
     */
    protected function convertToArr(PageModel $page):array
    {
        $arr = [];
        $arr['pageId'] = (int)$page->getPageId();
        $arr['title'] = $page->getTitle();
        $arr['body'] = $page->getBody();
        $arr['keywords'] = $page->getKeywords();
        $arr['modified'] = $page->getModified()->format('Y-m-d H:i:s');
        return $arr;
    }
}