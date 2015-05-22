<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaPageBlocks
 */
class HaPageBlocks
{
    /**
     * @var integer
     */
    private $pageid;

    /**
     * @var integer
     */
    private $versionid;

    /**
     * @var string
     */
    private $blockref;

    /**
     * @var string
     */
    private $body;

    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var integer
     */
    private $siteid;

    /**
     * @var integer
     */
    private $blockid;


    /**
     * Set pageid
     *
     * @param integer $pageid
     * @return HaPageBlocks
     */
    public function setPageid($pageid)
    {
        $this->pageid = $pageid;

        return $this;
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
     * Set versionid
     *
     * @param integer $versionid
     * @return HaPageBlocks
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
     * Set blockref
     *
     * @param string $blockref
     * @return HaPageBlocks
     */
    public function setBlockref($blockref)
    {
        $this->blockref = $blockref;

        return $this;
    }

    /**
     * Get blockref
     *
     * @return string 
     */
    public function getBlockref()
    {
        return $this->blockref;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return HaPageBlocks
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return HaPageBlocks
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
     * Set siteid
     *
     * @param integer $siteid
     * @return HaPageBlocks
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
     * Get blockid
     *
     * @return integer 
     */
    public function getBlockid()
    {
        return $this->blockid;
    }
}
