<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaInfos
 */
class HaInfos
{
    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $new;

    /**
     * @var integer
     */
    private $userid;

    /**
     * @var string
     */
    private $authordisplayname;

    /**
     * @var string
     */
    private $authoravatar;

    /**
     * @var integer
     */
    private $authoruserid;

    /**
     * @var integer
     */
    private $infoid;


    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return HaInfos
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
     * Set content
     *
     * @param string $content
     * @return HaInfos
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return HaInfos
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return HaInfos
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set new
     *
     * @param integer $new
     * @return HaInfos
     */
    public function setNew($new)
    {
        $this->new = $new;

        return $this;
    }

    /**
     * Get new
     *
     * @return integer 
     */
    public function getNew()
    {
        return $this->new;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return HaInfos
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
     * Set authordisplayname
     *
     * @param string $authordisplayname
     * @return HaInfos
     */
    public function setAuthordisplayname($authordisplayname)
    {
        $this->authordisplayname = $authordisplayname;

        return $this;
    }

    /**
     * Get authordisplayname
     *
     * @return string 
     */
    public function getAuthordisplayname()
    {
        return $this->authordisplayname;
    }

    /**
     * Set authoravatar
     *
     * @param string $authoravatar
     * @return HaInfos
     */
    public function setAuthoravatar($authoravatar)
    {
        $this->authoravatar = $authoravatar;

        return $this;
    }

    /**
     * Get authoravatar
     *
     * @return string 
     */
    public function getAuthoravatar()
    {
        return $this->authoravatar;
    }

    /**
     * Set authoruserid
     *
     * @param integer $authoruserid
     * @return HaInfos
     */
    public function setAuthoruserid($authoruserid)
    {
        $this->authoruserid = $authoruserid;

        return $this;
    }

    /**
     * Get authoruserid
     *
     * @return integer 
     */
    public function getAuthoruserid()
    {
        return $this->authoruserid;
    }

    /**
     * Get infoid
     *
     * @return integer 
     */
    public function getInfoid()
    {
        return $this->infoid;
    }
}
