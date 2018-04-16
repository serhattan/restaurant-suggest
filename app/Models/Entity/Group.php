<?php

namespace App\Models\Entity;

use Carbon\Carbon;

class Group
{
    private $id;
    private $name;
    private $createdBy;
    private $budget;
    private $status;
    private $users;
    private $restaurants = [];
    private $generate;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return mixed
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param mixed $budget
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @return Restaurant[]
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }

    /**
     * @param mixed $restaurants
     */
    public function setRestaurants($restaurants)
    {
        $this->restaurants[] = $restaurants;
    }

    /**
     * @return Generate
     */
    public function getGenerate()
    {
        return $this->generate;
    }

    /**
     * @param mixed $generate
     */
    public function setGenerate($generate)
    {
        $this->generate = $generate;
    }

    /**
     * @param bool $carbon
     * @return Carbon
     */
    public function getCreatedAt($carbon = false)
    {
        if ($carbon) {
            return new Carbon($this->createdAt);
        }

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
