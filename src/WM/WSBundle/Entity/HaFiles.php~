<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaFiles
 *
 * @ORM\Table(name="ha_files")
 * @ORM\Entity
 */
class HaFiles
{
    /**
     * @var string
     *
     * @ORM\Column(name="fileRef", type="string", length=100, nullable=true)
     */
    private $fileref;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=100, nullable=true)
     */
    private $filename;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime", nullable=false)
     */
    private $datecreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModified", type="datetime", nullable=false)
     */
    private $datemodified;

    /**
     * @var integer
     *
     * @ORM\Column(name="folderID", type="integer", nullable=false)
     */
    private $folderid;

    /**
     * @var integer
     *
     * @ORM\Column(name="userID", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted;

    /**
     * @var integer
     *
     * @ORM\Column(name="filesize", type="integer", nullable=false)
     */
    private $filesize;

    /**
     * @var integer
     *
     * @ORM\Column(name="downloads", type="integer", nullable=false)
     */
    private $downloads;

    /**
     * @var integer
     *
     * @ORM\Column(name="siteID", type="integer", nullable=true)
     */
    private $siteid;

    /**
     * @var integer
     *
     * @ORM\Column(name="fileID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fileid;



    /**
     * Set fileref
     *
     * @param string $fileref
     * @return HaFiles
     */
    public function setFileref($fileref)
    {
        $this->fileref = $fileref;

        return $this;
    }

    /**
     * Get fileref
     *
     * @return string 
     */
    public function getFileref()
    {
        return $this->fileref;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return HaFiles
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
     * @return HaFiles
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
     * @return HaFiles
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
     * Set folderid
     *
     * @param integer $folderid
     * @return HaFiles
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
     * Set userid
     *
     * @param integer $userid
     * @return HaFiles
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
     * Set deleted
     *
     * @param boolean $deleted
     * @return HaFiles
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
     * Set filesize
     *
     * @param integer $filesize
     * @return HaFiles
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
     * Set downloads
     *
     * @param integer $downloads
     * @return HaFiles
     */
    public function setDownloads($downloads)
    {
        $this->downloads = $downloads;

        return $this;
    }

    /**
     * Get downloads
     *
     * @return integer 
     */
    public function getDownloads()
    {
        return $this->downloads;
    }

    /**
     * Set siteid
     *
     * @param integer $siteid
     * @return HaFiles
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
     * Get fileid
     *
     * @return integer 
     */
    public function getFileid()
    {
        return $this->fileid;
    }
}
