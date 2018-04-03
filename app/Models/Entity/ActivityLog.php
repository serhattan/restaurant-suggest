<?php

namespace App\Models\Entity;

class ActivityLog
{
    private $id;
    private $groupId;
    private $userId;
    private $activityId;
    private $helperId;
    private $content;
    private $activity;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getGroupId()
    {
        return $this->groupId;
    }

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getActivityId()
    {
        return $this->activityId;
    }

    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;
    }

    public function getHelperId()
    {
        return $this->helperId;
    }

    public function setHelperId($helperId)
    {
        $this->helperId = $helperId;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = collect(array_map(
            function ($object) {
                return (array)$object;
            },
            array(
                json_decode(
                    $content
                )
            )
        ))->first();

    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setGroup($group)
    {
        $this->group = $group;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getActivity()
    {
        return $this->activity;
    }

    public function setActivity($activity)
    {
        $this->activity = $activity;
    }
}
