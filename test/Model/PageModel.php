<?php

namespace Model;

class PageModel
{
    private $pageId = null;
    private $title = null;
    private $body = null;
    private $keywords =null;
    private $modified = null;

    /**
     * PageModel constructor.
     * @param null $pageId
     */
    public function __construct($pageId = null)
    {
        $this->setPageId($pageId);
    }

    /**
     * @return null
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @param null $pageId
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return null
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param null $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return null
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param null $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return \DateTime
     */
    public function getModified(): \DateTime
    {
        return $this->modified;
    }

    /**
     * @param \DateTime $modified
     */
    public function setModified(\DateTime $modified)
    {
        $this->modified = $modified;
    }
}