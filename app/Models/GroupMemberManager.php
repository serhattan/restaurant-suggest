<?php

namespace App\Models;


use App\Helpers\Helper;
use App\Models\DB\GroupMember;

class GroupMemberManager
{
    public static function save($data)
    {
        $newGroup = new GroupMember();
        if (!isset($group['id'])) {
            $newGroup->id = Helper::generateId();
        } else {
            $newGroup = GroupMember::where('id', $data['id'])->first();
        }

        $newGroup->invitor_id = $data['invitorId'];
        $newGroup->group_id = $data['groupId'];
        $newGroup->email = $data['email'];
        $newGroup->save();
        return $newGroup;
    }
}