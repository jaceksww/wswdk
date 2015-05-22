<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaPages
 */
class HaPages
{
    /**
     * @var integer
     */
    private $versionid;

    /**
     * @var string
     */
    private $pagename;

    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var \DateTime
     */
    private $datemodified;

    /**
     * @var \DateTime
     */
    private $datepublished;

    /**
     * @var string
     */
    private $title;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var integer
     */
    private $draftid;

    /**
     * @var integer
     */
    private $templateid;

    /**
     * @var integer
     */
    private $parentid;

    /**
     * @var integer
     */
    private $pageorder;

    /**
     * @var string
     */
    private $keywords;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $redirect;

    /**
     * @var integer
     */
    private $userid;

    /**
     * @var integer
     */
    private $groupid;

    /**
     * @var boolean
     */
    private $navigation;

    /**
     * @var integer
     */
    private $views;

    /**
     * @var boolean
     */
    private $deleted;

    /**
     * @var integer
     */
    private $siteid;

    /**
     * @var integer
     */
    private $pageid;
    
    /**
     * @var string
     */
    private $mainimage;


    /**
     * Set versionid
     *
     * @param integer $versionid
     * @return HaPages
     */
    public function setVersionid($versionid)
    {
        $this->versionid = $versionid;

        return $this;
    }

    /**
     * Get versionid
     *
     * @return integer 
     */
    public function getVersionid()
    {
        return $this->versionid;
    }

    /**
     * Set pagename
     *
     * @param string $pagename
     * @return HaPages
     */
    public function setPagename($pagename)
    {
        $this->pagename = $pagename;

        return $this;
    }

    /**
     * Get pagename
     *
     * @return string 
     */
    public function getPagename()
    {
        return $this->pagename;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return HaPages
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    /**
     * Get datecreated
     *
     * @return \DateTime 
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

    /**
     * Set datemodified
     *
     * @param \DateTime $datemodified
     * @return HaPages
     */
    public function setDatemodified($datemodified)
    {
        $this->datemodified = $datemodified;

        return $this;
    }

    /**
     * Get datemodified
     *
     * @return \DateTime 
     */
    public function getDatemodified()
    {
        return $this->datemodified;
    }

    /**
     * Set datepublished
     *
     * @param \DateTime $datepublished
     * @return HaPages
     */
    public function setDatepublished($datepublished)
    {
        $this->datepublished = $datepublished;

        return $this;
    }

    /**
     * Get datepublished
     *
     * @return \DateTime 
     */
    public function getDatepublished()
    {
        return $this->datepublished;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return HaPages
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return HaPages
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set uri
     *
     * @param string $uri
     * @return HaPages
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return string 
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set draftid
     *
     * @param integer $draftid
     * @return HaPages
     */
    public function setDraftid($draftid)
    {
        $this->draftid = $draftid;

        return $this;
    }

    /**
     * Get draftid
     *
     * @return integer 
     */
    public function getDraftid()
    {
        return $this->draftid;
    }

    /**
     * Set templateid
     *
     * @param integer $templateid
     * @return HaPages
     */
    public function setTemplateid($templateid)
    {
        $this->templateid = $templateid;

        return $this;
    }

    /**
     * Get templateid
     *
     * @return integer 
     */
    public function getTemplateid()
    {
        return $this->templateid;
    }

    /**
     * Set parentid
     *
     * @param integer $parentid
     * @return HaPages
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;

        return $this;
    }

    /**
     * Get parentid
     *
     * @return integer 
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * Set pageorder
     *
     * @param integer $pageorder
     * @return HaPages
     */
    public function setPageorder($pageorder)
    {
        $this->pageorder = $pageorder;

        return $this;
    }

    /**
     * Get pageorder
     *
     * @return integer 
     */
    public function getPageorder()
    {
        return $this->pageorder;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return HaPages
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return HaPages
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set redirect
     *
     * @param string $redirect
     * @return HaPages
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;

        return $this;
    }

    /**
     * Get redirect
     *
     * @return string 
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return HaPages
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set groupid
     *
     * @param integer $groupid
     * @return HaPages
     */
    public function setGroupid($groupid)
    {
        $this->groupid = $groupid;

        return $this;
    }

    /**
     * Get groupid
     *
     * @return integer 
     */
    public function getGroupid()
    {
        return $this->groupid;
    }

    /**
     * Set navigation
     *
     * @param boolean $navigation
     * @return HaPages
     */
    public function setNavigation($navigation)
    {
        $this->navigation = $navigation;

        return $this;
    }

    /**
     * Get navigation
     *
     * @return boolean 
     */
    public function getNavigation()
    {
        return $this->navigation;
    }

    /**
     * Set views
     *
     * @param integer $views
     * @return HaPages
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return integer 
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return HaPages
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set siteid
     *
     * @param integer $siteid
     * @return HaPages
     */
    public function setSiteid($siteid)
    {
        $this->siteid = $siteid;

        return $this;
    }

    /**
     * Get siteid
     *
     * @return integer 
     */
    public function getSiteid()
    {
        return $this->siteid;
    }

    /**
     * Get pageid
     *
     * @return integer 
     */
    public function getPageid()
    {
        return $this->pageid;
    }
    
    /**
     * Get mainimage
     *
     * @return string 
     */
    public function getMainimage()
    {
        return $this->mainimage;
    }

   
}
