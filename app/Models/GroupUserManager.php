<?php

namespace App\Models;


use App\Models\DB\GroupUser;
use App\Models\Entity;

class GroupUserManager
{
    /**
     * @param GroupUser $groupUser
     * @return Entity\GroupUser
     */
    public static function map(GroupUser $groupUser)
    {
        $newGroupUser = new Entity\GroupUser();
        $newGroupUser->setId($groupUser->id);
        $newGroupUser->setGroupId($groupUser->group_id);
        $newGroupUser->setUserId($groupUser->user_id);
        $newGroupUser->setStatus($groupUser->status);

        if ($groupUser->relationLoaded('user') && !empty($groupUser->user)) {
            $newGroupUser->setUser(UserManager::map($groupUser->user));
        }

        return $newGroupUser;
    }

    /**
     * @param GroupUser[] $groupUsers
     * @return Entity\GroupUser[]
     */
    public static function multiMap($groupUsers)
    {
        $groupUserList = [];
        foreach ($groupUsers as $groupUser) {
            $groupUserList[] = self::map($groupUser);
        }

        return $groupUserList;
    }
}