<?php
namespace Statpage\Entity;


class Page
{
    protected $id;
    protected $name;
    protected $description;
    protected $keywords;
	protected $title;
	protected $url;
	protected $sysname;
	protected $page_type;
	protected $locale;
	protected $tpl;
	protected $content;
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

   
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function getKeywords()
    {
        return $this->keywords;
    }
    
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }
   
   
   
    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }
   


    public function getUrl() 
    {
        return $this->url;
    }

    public function setUrl($url) 
    {
        $this->url = $url;
    }
   
   public function getSysname() 
    {
        return $this->sysname;
    }

    public function setSysname($sysname) 
    {
        $this->sysname = $sysname;
    }
 
    public function getPage_Type() 
    {
        return $this->page_type;
    }

    public function setPage_Type($page_type) 
    {
        $this->page_type = $page_type;
    }
   
   public function getLocale() 
    {
        return $this->locale;
    }

    public function setLocale($locale) 
    {
        $this->locale = $locale;
    }
   public function getTpl() 
    {
        return $this->tpl;
    }

    public function setTpl($tpl) 
    {
        $this->tpl = $tpl;
    }


   public function getContent() 
    {
        return $this->content;
    }

    public function setContent($content) 
    {
        $this->content = $content;
    }


}
