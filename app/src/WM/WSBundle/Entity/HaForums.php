<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaForums
 *
 * @ORM\Table(name="ha_forums")
 * @ORM\Entity
 */
class HaForums
{
    /**
     * @var string
     *
     * @ORM\Column(name="forumName", type="string", length=100, nullable=true)
     */
    private $forumname;

    /**
     * @var integer
     *
     * @ORM\Column(name="catID", type="integer", nullable=true)
     */
    private $catid;

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
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="topics", type="integer", nullable=false)
     */
    private $topics;

    /**
     * @var integer
     *
     * @ORM\Column(name="replies", type="integer", nullable=false)
     */
    private $replies;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastPostID", type="integer", nullable=true)
     */
    private $lastpostid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="private", type="boolean", nullable=false)
     */
    private $private;

    /**
     * @var integer
     *
     * @ORM\Column(name="groupID", type="integer", nullable=true)
     */
    private $groupid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

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
     * @ORM\Column(name="forumID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $forumid;


}
