<?php

namespace App\Models;

use App\Models\DB\Group;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;

class GroupManager
{
    public static function getAll()
    {
        $groups = Group::where('user_id', Auth::id())->get();

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
}
