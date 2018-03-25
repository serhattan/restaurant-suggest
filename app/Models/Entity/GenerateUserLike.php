<?php

namespace App\Models\Entity;

class GenerateUserLike
{
    private $id;
    private $generateId;
    private $userId;
    private $user;
    private $generate;

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
    public function getGenerateId()
    {
        return $this->generateId;
    }

    /**
     * @param mixed $generateId
     */
    public function setGenerateId($generateId)
    {
        $this->generateId = $generateId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getGenerate()
    {
        return $this->generate;
    }

    public function setGenerate($generate)
    {
        $this->generate = $generate;
    }
}
