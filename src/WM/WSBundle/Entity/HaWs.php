<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaWs
 */
class HaWs
{
    /**
     * @var string
     */
    private $wwwtitle;

    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var \DateTime
     */
    private $datemodified;

    /**
     * @var string
     */
    private $time;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $description2;

    /**
     * @var string
     */
    private $custom1;

    /**
     * @var string
     */
    private $custom2;

    /**
     * @var string
     */
    private $custom3;

    /**
     * @var string
     */
    private $excerpt;

    /**
     * @var integer
     */
    private $userid;

    /**
     * @var integer
     */
    private $groupid;

    /**
     * @var string
     */
    private $tags;

    /**
     * @var boolean
     */
    private $published;

    /**
     * @var boolean
     */
    private $featured;

    /**
     * @var boolean
     */
    private $deleted;

    /**
     * @var integer
     */
    private $siteid;

    /**
     * @var \DateTime
     */
    private $wwwdate;

    /**
     * @var integer
     */
    private $folderid;

    /**
     * @var integer
     */
    private $categoryId;

    /**
     * @var integer
     */
    private $isPoll;

    /**
     * @var string
     */
    private $mainimage;

    /**
     * @var integer
     */
    private $countcomments;

    /**
     * @var \DateTime
     */
    private $lastcomment;

    /**
     * @var integer
     */
    private $countimages;

    /**
     * @var integer
     */
    private $gallerycat;

    /**
     * @var integer
     */
    private $countlikes;

    /**
     * @var string
     */
    private $lat;

    /**
     * @var string
     */
    private $lng;

    /**
     * @var boolean
     */
    private $mobile;

    /**
     * @var integer
     */
    private $parentid;

    /**
     * @var integer
     */
    private $wwwid;


    /**
     * Set wwwtitle
     *
     * @param string $wwwtitle
     * @return HaWs
     */
    public function setWwwtitle($wwwtitle)
    {
        $this->wwwtitle = $wwwtitle;

        return $this;
    }

    /**
     * Get wwwtitle
     *
     * @return string 
     */
    public function getWwwtitle()
    {
        return $this->wwwtitle;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return HaWs
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
     * @return HaWs
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
     * Set time
     *
     * @param string $time
     * @return HaWs
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return HaWs
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
     * Set description2
     *
     * @param string $description2
     * @return HaWs
     */
    public function setDescription2($description2)
    {
        $this->description2 = $description2;

        return $this;
    }

    /**
     * Get description2
     *
     * @return string 
     */
    public function getDescription2()
    {
        return $this->description2;
    }

    /**
     * Set custom1
     *
     * @param string $custom1
     * @return HaWs
     */
    public function setCustom1($custom1)
    {
        $this->custom1 = $custom1;

        return $this;
    }

    /**
     * Get custom1
     *
     * @return string 
     */
    public function getCustom1()
    {
        return $this->custom1;
    }

    /**
     * Set custom2
     *
     * @param string $custom2
     * @return HaWs
     */
    public function setCustom2($custom2)
    {
        $this->custom2 = $custom2;

        return $this;
    }

    /**
     * Get custom2
     *
     * @return string 
     */
    public function getCustom2()
    {
        return $this->custom2;
    }

    /**
     * Set custom3
     *
     * @param string $custom3
     * @return HaWs
     */
    public function setCustom3($custom3)
    {
        $this->custom3 = $custom3;

        return $this;
    }

    /**
     * Get custom3
     *
     * @return string 
     */
    public function getCustom3()
    {
        return $this->custom3;
    }

    /**
     * Set excerpt
     *
     * @param string $excerpt
     * @return HaWs
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string 
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return HaWs
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
     * @return HaWs
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
     * Set tags
     *
     * @param string $tags
     * @return HaWs
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return HaWs
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set featured
     *
     * @param boolean $featured
     * @return HaWs
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return boolean 
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return HaWs
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
     * @return HaWs
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
     * Set wwwdate
     *
     * @param \DateTime $wwwdate
     * @return HaWs
     */
    public function setWwwdate($wwwdate)
    {
        $this->wwwdate = $wwwdate;

        return $this;
    }

    /**
     * Get wwwdate
     *
     * @return \DateTime 
     */
    public function getWwwdate()
    {
        return $this->wwwdate;
    }

    /**
     * Set folderid
     *
     * @param integer $folderid
     * @return HaWs
     */
    public function setFolderid($folderid)
    {
        $this->folderid = $folderid;

        return $this;
    }

    /**
     * Get folderid
     *
     * @return integer 
     */
    public function getFolderid()
    {
        return $this->folderid;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return HaWs
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set isPoll
     *
     * @param integer $isPoll
     * @return HaWs
     */
    public function setIsPoll($isPoll)
    {
        $this->isPoll = $isPoll;

        return $this;
    }

    /**
     * Get isPoll
     *
     * @return integer 
     */
    public function getIsPoll()
    {
        return $this->isPoll;
    }

    /**
     * Set mainimage
     *
     * @param string $mainimage
     * @return HaWs
     */
    public function setMainimage($mainimage)
    {
        $this->mainimage = $mainimage;

        return $this;
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

    /**
     * Set countcomments
     *
     * @param integer $countcomments
     * @return HaWs
     */
    public function setCountcomments($countcomments)
    {
        $this->countcomments = $countcomments;

        return $this;
    }

    /**
     * Get countcomments
     *
     * @return integer 
     */
    public function getCountcomments()
    {
        return $this->countcomments;
    }

    /**
     * Set lastcomment
     *
     * @param \DateTime $lastcomment
     * @return HaWs
     */
    public function setLastcomment($lastcomment)
    {
        $this->lastcomment = $lastcomment;

        return $this;
    }

    /**
     * Get lastcomment
     *
     * @return \DateTime 
     */
    public function getLastcomment()
    {
        return $this->lastcomment;
    }

    /**
     * Set countimages
     *
     * @param integer $countimages
     * @return HaWs
     */
    public function setCountimages($countimages)
    {
        $this->countimages = $countimages;

        return $this;
    }

    /**
     * Get countimages
     *
     * @return integer 
     */
    public function getCountimages()
    {
        return $this->countimages;
    }

    /**
     * Set gallerycat
     *
     * @param integer $gallerycat
     * @return HaWs
     */
    public function setGallerycat($gallerycat)
    {
        $this->gallerycat = $gallerycat;

        return $this;
    }

    /**
     * Get gallerycat
     *
     * @return integer 
     */
    public function getGallerycat()
    {
        return $this->gallerycat;
    }

    /**
     * Set countlikes
     *
     * @param integer $countlikes
     * @return HaWs
     */
    public function setCountlikes($countlikes)
    {
        $this->countlikes = $countlikes;

        return $this;
    }

    /**
     * Get countlikes
     *
     * @return integer 
     */
    public function getCountlikes()
    {
        return $this->countlikes;
    }

    /**
     * Set lat
     *
     * @param string $lat
     * @return HaWs
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     * @return HaWs
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string 
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set mobile
     *
     * @param boolean $mobile
     * @return HaWs
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return boolean 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set parentid
     *
     * @param integer $parentid
     * @return HaWs
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
     * Get wwwid
     *
     * @return integer 
     */
    public function getWwwid()
    {
        return $this->wwwid;
    }
}
