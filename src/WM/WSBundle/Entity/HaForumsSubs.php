<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaForumsSubs
 */
class HaForumsSubs
{
    /**
     * @var integer
     */
    private $siteid;

    /**
     * @var integer
     */
    private $topicid;

    /**
     * @var integer
     */
    private $userid;


    /**
     * Set siteid
     *
     * @param integer $siteid
     * @return HaForumsSubs
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
     * Set topicid
     *
     * @param integer $topicid
     * @return HaForumsSubs
     */
    public function setTopicid($topicid)
    {
        $this->topicid = $topicid;

        return $this;
    }

    /**
     * Get topicid
     *
     * @return integer 
     */
    public function getTopicid()
    {
        return $this->topicid;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return HaForumsSubs
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
}
