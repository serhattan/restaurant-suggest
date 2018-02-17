<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\DB;
use App\Models\Entity;

class GroupMemberManager
{
    public static function getByEmail($email)
    {
        $groupMembers = DB\GroupMember::where('email', $email)->get();

        return self::multiMap($groupMembers);
    }

    /**
     * @param $data
     * @return DB\GroupMember
     */
    public static function save($data)
    {
        $newGroup = new DB\GroupMember();
        if (!isset($group['id'])) {
            $newGroup->id = Helper::generateId();
        } else {
            $newGroup = DB\GroupMember::where('id', $data['id'])->first();
        }

        $newGroup->invitor_id = $data['invitorId'];
        $newGroup->group_id = $data['groupId'];
        $newGroup->email = $data['email'];
        $newGroup->save();
        return $newGroup;
    }

    /**
     * @param DB\GroupMember $groupMember
     * @return Entity\GroupMember
     */
    public static function map(DB\GroupMember $groupMember)
    {
        $newGroupMember = new Entity\GroupMember();
        $newGroupMember->setId($groupMember->id);
        $newGroupMember->setGroupId($groupMember->group_id);
        $newGroupMember->setInvitorId($groupMember->invitor_id);
        $newGroupMember->setEmail($groupMember->email);

        return $newGroupMember;
    }


    /**
     * @param DB\GroupMember[] $groupMembers
     * @return Entity\GroupMember[]
     */
    public static function multiMap($groupMembers)
    {
        $list = [];
        foreach ($groupMembers as $groupMember) {
            $list[] = self::map($groupMember);
        }

        return $list;
    }
}