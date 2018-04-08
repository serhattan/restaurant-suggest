<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\DB\Group;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;

class GroupManager
{

    public static function get($id)
    {
        $group = Group::with([
            'groupUsers' => function ($query) {
                $query->where('status', Helper::STATUS_ACTIVE);
            },
            'groupUsers.user',
            'restaurants',
            'generate',
            'generate.restaurant'
        ])
            ->where('id', $id)
            ->where('status', Helper::STATUS_ACTIVE)
            ->whereHas('groupUsers', function ($query) {
                $query->where('user_id', Auth::id());
                $query->where('status', Helper::STATUS_ACTIVE);
            })
            ->first();

            if ($group instanceof Group) {
            return self::map($group);
        }

        return false;
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        $groups = Group::with([
            'groupUsers' => function ($query) {
                $query->where('status', Helper::STATUS_ACTIVE);
            },
            'groupUsers.user'
        ])
            ->where('status', Helper::STATUS_ACTIVE)
            ->whereHas('groupUsers', function ($query) {
                $query->where('user_id', Auth::id());
                $query->where('status', Helper::STATUS_ACTIVE);
            })
            ->get();

        return self::multiMap($groups);
    }

    /**
     * @param Group $group
     * @return Entity\Group
     */
    public static function map(Group $group)
    {
        $newGroup = new Entity\Group();
        $newGroup->setId($group->id);
        $newGroup->setName($group->name);
        $newGroup->setBudget($group->budget);
        $newGroup->setCreatedBy($group->created_by);
        $newGroup->setStatus($group->status);

        if ($group->relationLoaded('groupUsers') && !empty($group->groupUsers)) {
            $newGroup->setUsers(GroupUserManager::multiMap($group->groupUsers));
        }

        if ($group->relationLoaded('generate') && !empty($group->generate)) {
            $newGroup->setGenerate(GenerateManager::map($group->generate));
        }

        if ($group->relationLoaded('restaurants') && !empty($group->restaurants)) {
            foreach ($group->restaurants as $restaurant) {
                $newGroup->setRestaurants(RestaurantManager::map($restaurant));
            }
        }

        return $newGroup;
    }

    /**
     * @param Group[] $groups
     * @return array
     */
    public static function multiMap($groups)
    {
        $groupList = [];
        foreach ($groups as $group) {
            $groupList[] = self::map($group);
        }

        return $groupList;
    }

    /**
     * @param $group
     * @return Group
     */
    public static function save($data)
    {
        $new = false;
        $group = new Group();
        if (!isset($data['id'])) {
            $group->id = Helper::generateId();
            $group->status = Helper::STATUS_ACTIVE;
            $group->created_by = Auth::id();
            $new = true;
        } else {
            $group = Group::where('id', $data['id'])->first();
        }

        $group->name = $data['name'];
        $group->budget = $data['budget'];
        $group->save();

        if ($new) {
            GroupUserManager::save([
                'userId' => Auth::id(),
                'groupId' => $group->id
            ]);

            ActivityLogManager::save([
                'id' => Helper::generateId(),
                'groupId' => $group->id,
                'userId' => Auth::id(),
                'activityId' => ActivityLogManager::getActivity(Helper::ADD, HELPER::GROUP_TABLE),
                'helperId' => $group->id,
                'content' => [
                    'userFullName' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                    'groupName' => $group->name
                ]
            ]);
        } else {
            ActivityLogManager::save([
                'id' => Helper::generateId(),
                'groupId' => $group->id,
                'userId' => Auth::id(),
                'activityId' => ActivityLogManager::getActivity(Helper::UPDATE, HELPER::GROUP_TABLE),
                'helperId' => $group->id,
                'content' => [
                    'userFullName' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                    'groupName' => $group->name,
                    'groupBudget' => $group->budget
                ]
            ]);
        }

        return $group;
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function delete($id)
    {
        $group = GroupManager::get($id);

        DB\GroupUser::where('group_id', $id)->update(['status' => Helper::STATUS_DELETED]);
        DB\GroupMember::where('group_id', $id)->update(['status' => Helper::STATUS_DELETED]);
        DB\Group::where('id', $id)->update(['status' => Helper::STATUS_DELETED]);

        ActivityLogManager::save([
            'id' => Helper::generateId(),
            'groupId' => $id,
            'userId' => Auth::id(),
            'activityId' => ActivityLogManager::getActivity(Helper::REMOVE, HELPER::GROUP_TABLE),
            'helperId' => $id,
            'content' => [
                'userFullName' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                'groupName' => $group->getName()
            ],
        ]);
    }

    public static function newGroupUser($groupId, $email)
    {
        $user = UserManager::getByEmail($email);

        if ($user instanceof Entity\User) {
            $memberId = GroupUserManager::save([
                'userId' => $user->getId(),
                'groupId' => $groupId
            ]);
        } else {
            $groupMember = GroupMemberManager::save([
                'groupId' => $groupId,
                'email' => $email,
                'invitorId' => Auth::id()
            ]);
        }

        ActivityLogManager::save([
            'id' => Helper::generateId(),
            'groupId' => $groupId,
            'userId' => Auth::id(),
            'activityId' => ActivityLogManager::getActivity(Helper::ADD, Helper::GROUP_USER_TABLE),
            'helperId' => $groupMember->id,
            'content' => [
                "userFullName" => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                "memberEmail" => $email
            ],
        ]);

        return $memberId;
    }
}
