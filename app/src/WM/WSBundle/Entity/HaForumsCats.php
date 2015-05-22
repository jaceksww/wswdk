<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaForumsCats
 *
 * @ORM\Table(name="ha_forums_cats")
 * @ORM\Entity
 */
class HaForumsCats
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
     * @ORM\Column(name="catName", type="string", length=50, nullable=true)
     */
    private $catname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime", nullable=false)
     */
    private $datecreated;

    /**
     * @var integer
     *
     * @ORM\Column(name="catOrder", type="integer", nullable=true)
     */
    private $catorder;

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
     * @ORM\Column(name="catID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $catid;


}
