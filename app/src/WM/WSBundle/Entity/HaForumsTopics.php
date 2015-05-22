<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaForumsTopics
 *
 * @ORM\Table(name="ha_forums_topics")
 * @ORM\Entity
 */
class HaForumsTopics
{
    /**
     * @var integer
     *
     * @ORM\Column(name="forumID", type="integer", nullable=false)
     */
    private $forumid;

    /**
     * @var string
     *
     * @ORM\Column(name="topicTitle", type="string", length=150, nullable=true)
     */
    private $topictitle;

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
     * @ORM\Column(name="replies", type="integer", nullable=false)
     */
    private $replies;

    /**
     * @var integer
     *
     * @ORM\Column(name="views", type="integer", nullable=false)
     */
    private $views;

    /**
     * @var integer
     *
     * @ORM\Column(name="userID", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastPostID", type="integer", nullable=true)
     */
    private $lastpostid;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastPostUserID", type="integer", nullable=false)
     */
    private $lastpostuserid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sticky", type="boolean", nullable=false)
     */
    private $sticky;

    /**
     * @var boolean
     *
     * @ORM\Column(name="locked", type="boolean", nullable=false)
     */
    private $locked;

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
     * @var string
     *
     * @ORM\Column(name="tags", type="text", nullable=false)
     */
    private $tags;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mobile", type="boolean", nullable=false)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="tmpUserName", type="string", length=245, nullable=true)
     */
    private $tmpusername;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topicid;


}
