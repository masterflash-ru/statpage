<?php
namespace Mf\Statpage\Entity;


class Page
{
 protected $statpage = null;

    protected $locale = null;

    protected $title = null;

    protected $keywords = null;

    protected $description = null;

    protected $tpl = null;

    protected $page_type = null;

    protected $content = null;

    protected $lastmod = null;

    protected $seo_options = null;

    protected $id = null;

    protected $name = null;

    protected $sysname = null;

    protected $url = null;

    public function setStatpage($statpage)
    {
        $this->statpage=$statpage;
    }

    public function getStatpage()
    {
        return $this->statpage;
    }

    public function setLocale($locale)
    {
        $this->locale=$locale;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setTitle($title)
    {
        $this->title=$title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setKeywords($keywords)
    {
        $this->keywords=$keywords;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function setDescription($description)
    {
        $this->description=$description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setTpl($tpl)
    {
        $this->tpl=$tpl;
    }

    public function getTpl()
    {
        return $this->tpl;
    }

    public function setPage_type($page_type)
    {
        $this->page_type=$page_type;
    }

    public function getPage_type()
    {
        return $this->page_type;
    }

    public function setContent($content)
    {
        $this->content=$content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setLastmod($lastmod)
    {
        $this->lastmod=$lastmod;
    }

    public function getLastmod()
    {
        return $this->lastmod;
    }

    public function setSeo_options($seo_options)
    {
        $this->seo_options=$seo_options;
    }

    public function getSeo_options()
    {
        return $this->seo_options;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name=$name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSysname($sysname)
    {
        $this->sysname=$sysname;
    }

    public function getSysname()
    {
        return $this->sysname;
    }

    public function setUrl($url)
    {
        $this->url=$url;
    }

    public function getUrl()
    {
        return $this->url;
    }


}
