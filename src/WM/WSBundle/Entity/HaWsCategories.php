<?php

namespace WM\WSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HaWsCategories
 */
class HaWsCategories
{
    /**
     * @var integer
     */
    private $wsId;

    /**
     * @var integer
     */
    private $categoryId;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set wsId
     *
     * @param integer $wsId
     * @return HaWsCategories
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
     * Set categoryId
     *
     * @param integer $categoryId
     * @return HaWsCategories
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
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
