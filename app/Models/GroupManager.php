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
        $groups = Group::where('user_id', Auth::id())
            ->where('status', Helper::STATUS_ACTIVE)
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
        if (isset($group['id']) && empty($group['id'])) {
            $newGroup->id = Helper::generateId();
            $newGroup->status = Helper::STATUS_ACTIVE;
            $newGroup->created_by = Auth::id();
        } else {
            $newGroup = Group::where($group['id'])->first();
        }

        $newGroup->name = $group['name'];
        $newGroup->budget = $group['budget'];

        return $newGroup->save();
    }
}
