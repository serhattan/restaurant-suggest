<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\DB\GroupUser;
use App\Models\DB\User;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;

class GroupUserManager
{
    /**
     * @param $groupUser
     * @return bool
     */
    public static function save($groupUser)
    {
        $newGroupUser = new GroupUser();
        if (!isset($groupUser['id'])) {
            $newGroupUser->id = Helper::generateId();
            $newGroupUser->status = Helper::STATUS_ACTIVE;
        } else {
            $newGroupUser = GroupUser::where('id', $groupUser['id'])->first();
        }
        $newGroupUser->user_id = $groupUser['userId'];
        $newGroupUser->group_id = $groupUser['groupId'];
        if (isset($groupUser['isAdmin'])) {
            $newGroupUser->is_admin = true;
        }

        $newGroupUser->save();

        return $newGroupUser->id;
    }

    public static function getByUserId($userId)
    {
        $groups = DB\GroupUser::select('group_id')
            ->with('group')
            ->where('user_id', $userId)
            ->groupBy('group_id')
            ->get();

        return self::multiMap($groups);
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
        $newGroupUser->setIsAdmin($groupUser->is_admin);

        if ($groupUser->relationLoaded('user') && !empty($groupUser->user)) {
            $newGroupUser->setUser(UserManager::map($groupUser->user));
        }

        if ($groupUser->relationLoaded('group') && !empty($groupUser->group)) {
            $newGroupUser->setGroup(GroupManager::map($groupUser->group));
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
        $user = UserManager::getById($userId);
        
        if ($user instanceof Entity\User) {
            $groupUser = GroupUser::where('group_id', $groupId)->where('user_id', $userId);
            if (!$groupUser->first()->is_admin) {
                $groupUser->update(['status' => Helper::STATUS_DELETED]);
            }

            ActivityLogManager::save([
                'id' => Helper::generateId(),
                'groupId' => $groupId,
                'userId' => Auth::id(),
                'activityId' => ActivityLogManager::getActivity(Helper::REMOVE, Helper::GROUP_USER_TABLE),
                'helperId' => $userId,
                'content' => [
                    'userFullName' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                    'memberFullName' => $user->getFullName()
                ],
            ]);

            return true;
        }

        return false;
    }

    public static function adminCheck($groupId, $userId)
    {
        $groupUser = DB\GroupUser::where('user_id', $userId)
            ->where('group_id', $groupId)
            ->first();

        if ($groupUser instanceof DB\GroupUser) {
            $groupUser = GroupUserManager::map($groupUser);

           return $groupUser->getIsAdmin();
        }
    }
}