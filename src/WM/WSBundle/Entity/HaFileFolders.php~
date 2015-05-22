<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaFileFolders
 *
 * @ORM\Table(name="ha_file_folders")
 * @ORM\Entity
 */
class HaFileFolders
{
    /**
     * @var integer
     *
     * @ORM\Column(name="parentID", type="integer", nullable=false)
     */
    private $parentid;

    /**
     * @var string
     *
     * @ORM\Column(name="folderName", type="string", length=50, nullable=true)
     */
    private $foldername;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime", nullable=false)
     */
    private $datecreated;

    /**
     * @var integer
     *
     * @ORM\Column(name="folderOrder", type="integer", nullable=true)
     */
    private $folderorder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted;

    /**
     * @var integer
     *
     * @ORM\Column(name="siteID", type="integer", nullable=true)
     */
    private $siteid;

    /**
     * @var integer
     *
     * @ORM\Column(name="folderID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $folderid;



    /**
     * Set parentid
     *
     * @param integer $parentid
     * @return HaFileFolders
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
     * Set foldername
     *
     * @param string $foldername
     * @return HaFileFolders
     */
    public function setFoldername($foldername)
    {
        $this->foldername = $foldername;

        return $this;
    }

    /**
     * Get foldername
     *
     * @return string 
     */
    public function getFoldername()
    {
        return $this->foldername;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return HaFileFolders
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
     * Set folderorder
     *
     * @param integer $folderorder
     * @return HaFileFolders
     */
    public function setFolderorder($folderorder)
    {
        $this->folderorder = $folderorder;

        return $this;
    }

    /**
     * Get folderorder
     *
     * @return integer 
     */
    public function getFolderorder()
    {
        return $this->folderorder;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return HaFileFolders
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
     * @return HaFileFolders
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
     * Get folderid
     *
     * @return integer 
     */
    public function getFolderid()
    {
        return $this->folderid;
    }
}
