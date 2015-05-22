<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaForumsPosts
 *
 * @ORM\Table(name="ha_forums_posts")
 * @ORM\Entity
 */
class HaForumsPosts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicID", type="integer", nullable=false)
     */
    private $topicid;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

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
     * @ORM\Column(name="siteID", type="integer", nullable=true)
     */
    private $siteid;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=245, nullable=false)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="countLikes", type="integer", nullable=false)
     */
    private $countlikes;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=245, nullable=true)
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
     * @ORM\Column(name="postID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $postid;


}
