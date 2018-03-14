<?php

namespace App\Models\Entity;

class Generate
{
    private $id;
    private $groupId;
    private $restaurantId;
    private $generateDetailId;
    private $createdAt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param mixed $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * @return mixed
     */
    public function getRestaurantId()
    {
        return $this->restaurantId;
    }

    /**
     * @param mixed $restaurantId
     */
    public function setRestaurantId($restaurantId)
    {
        $this->restaurantId = $restaurantId;
    }

    /**
     * @return mixed
     */
    public function getGenerateDetailId()
    {
        return $this->generateDetailId;
    }

    /**
     * @param mixed $generateDetailId
     */
    public function setGenerateDetailId($generateDetailId)
    {
        $this->generateDetailId = $generateDetailId;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}
