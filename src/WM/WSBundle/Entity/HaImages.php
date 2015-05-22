<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaImages
 */
class HaImages
{
    /**
     * @var string
     */
    private $imageref;

    /**
     * @var string
     */
    private $filename;

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
    private $imagename;

    /**
     * @var integer
     */
    private $folderid;

    /**
     * @var integer
     */
    private $groupid;

    /**
     * @var integer
     */
    private $userid;

    /**
     * @var string
     */
    private $class;

    /**
     * @var integer
     */
    private $filesize;

    /**
     * @var integer
     */
    private $maxsize;

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
    private $imageid;


    /**
     * Set imageref
     *
     * @param string $imageref
     * @return HaImages
     */
    public function setImageref($imageref)
    {
        $this->imageref = $imageref;

        return $this;
    }

    /**
     * Get imageref
     *
     * @return string 
     */
    public function getImageref()
    {
        return $this->imageref;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return HaImages
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return HaImages
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
     * @return HaImages
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
     * Set imagename
     *
     * @param string $imagename
     * @return HaImages
     */
    public function setImagename($imagename)
    {
        $this->imagename = $imagename;

        return $this;
    }

    /**
     * Get imagename
     *
     * @return string 
     */
    public function getImagename()
    {
        return $this->imagename;
    }

    /**
     * Set folderid
     *
     * @param integer $folderid
     * @return HaImages
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
     * Set groupid
     *
     * @param integer $groupid
     * @return HaImages
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
     * Set userid
     *
     * @param integer $userid
     * @return HaImages
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
     * Set class
     *
     * @param string $class
     * @return HaImages
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set filesize
     *
     * @param integer $filesize
     * @return HaImages
     */
    public function setFilesize($filesize)
    {
        $this->filesize = $filesize;

        return $this;
    }

    /**
     * Get filesize
     *
     * @return integer 
     */
    public function getFilesize()
    {
        return $this->filesize;
    }

    /**
     * Set maxsize
     *
     * @param integer $maxsize
     * @return HaImages
     */
    public function setMaxsize($maxsize)
    {
        $this->maxsize = $maxsize;

        return $this;
    }

    /**
     * Get maxsize
     *
     * @return integer 
     */
    public function getMaxsize()
    {
        return $this->maxsize;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return HaImages
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
     * @return HaImages
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
     * Get imageid
     *
     * @return integer 
     */
    public function getImageid()
    {
        return $this->imageid;
    }
}
