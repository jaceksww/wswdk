<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaForumsSubs
 *
 * @ORM\Table(name="ha_forums_subs")
 * @ORM\Entity
 */
class HaForumsSubs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="siteID", type="integer", nullable=true)
     */
    private $siteid;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $topicid;

    /**
     * @var integer
     *
     * @ORM\Column(name="userID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userid;


}
