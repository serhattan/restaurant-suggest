<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\DB\GroupUser;
use App\Models\Entity;

class GroupUserManager
{
    /**
     * @param $groupUser
     * @return bool
     */
    public static function save($groupUser)
    {
        $newGroupUser = new GroupUser();
        if (!isset($group['id'])) {
            $newGroupUser->id = Helper::generateId();
            $newGroupUser->status = Helper::STATUS_ACTIVE;
        } else {
            $newGroupUser = GroupUser::where('id', $groupUser['id'])->first();
        }
        $newGroupUser->user_id = $groupUser['userId'];
        $newGroupUser->group_id = $groupUser['groupId'];

        return $newGroupUser->save();
    }

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

    public static function delete($groupId, $userId)
    {
        return GroupUser::where('group_id', $groupId)->where('user_id', $userId)->update(['status' => Helper::STATUS_DELETED]);
    }
}