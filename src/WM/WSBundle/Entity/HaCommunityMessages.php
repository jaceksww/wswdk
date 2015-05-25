<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaCommunityMessages
 */
class HaCommunityMessages
{
    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var \DateTime
     */
    private $datemodified;

    /**
     * @var integer
     */
    private $userid;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $message;

    /**
     * @var integer
     */
    private $siteid;

    /**
     * @var integer
     */
    private $messageid;


    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     * @return HaCommunityMessages
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
     * @return HaCommunityMessages
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
     * Set userid
     *
     * @param integer $userid
     * @return HaCommunityMessages
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
     * Set subject
     *
     * @param string $subject
     * @return HaCommunityMessages
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return HaCommunityMessages
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set siteid
     *
     * @param integer $siteid
     * @return HaCommunityMessages
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
     * Get messageid
     *
     * @return integer 
     */
    public function getMessageid()
    {
        return $this->messageid;
    }
}
