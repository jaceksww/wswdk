<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaWsWsSubjects
 */
class HaWsWsSubjects
{
    /**
     * @var integer
     */
    private $wsId;

    /**
     * @var string
     */
    private $wsSubjectRef;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set wsId
     *
     * @param integer $wsId
     * @return HaWsWsSubjects
     */
    public function setWsId($wsId)
    {
        $this->wsId = $wsId;

        return $this;
    }

    /**
     * Get wsId
     *
     * @return integer 
     */
    public function getWsId()
    {
        return $this->wsId;
    }

    /**
     * Set wsSubjectRef
     *
     * @param string $wsSubjectRef
     * @return HaWsWsSubjects
     */
    public function setWsSubjectRef($wsSubjectRef)
    {
        $this->wsSubjectRef = $wsSubjectRef;

        return $this;
    }

    /**
     * Get wsSubjectRef
     *
     * @return string 
     */
    public function getWsSubjectRef()
    {
        return $this->wsSubjectRef;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
