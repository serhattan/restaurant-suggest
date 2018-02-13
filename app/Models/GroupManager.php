<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\DB\Group;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;

class GroupManager
{
    /**
     * @param $id
     * @param array $with
     * @return Entity\Group
     */
    public static function get($id, $with = [])
    {
        $group = Group::with($with)
            ->where('id', $id)
            ->where('status', Helper::STATUS_ACTIVE)
            ->first();

        if ($group instanceof Group) {
            return self::map($group);
        }
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

        if ($group->relationLoaded('restaurants') && !empty($group->restaurants)) {
            foreach($group->restaurants as $restaurant) {
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
     * @return bool
     */
    public static function save($group)
    {
        $newGroup = new Group();
        if (!isset($group['id'])) {
            $newGroup->id = Helper::generateId();
            $newGroup->status = Helper::STATUS_ACTIVE;
            $newGroup->created_by = Auth::id();
        } else {
            $newGroup = Group::where('id', $group['id'])->first();
        }

        $newGroup->name = $group['name'];
        $newGroup->budget = $group['budget'];

        return $newGroup->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function delete($id)
    {
        return DB\Group::where('id', $id)->update(['status', Helper::STATUS_DELETED]);
    }
}
