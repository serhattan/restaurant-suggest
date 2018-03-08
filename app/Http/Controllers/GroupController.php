<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Entity\User;
use App\Models\GroupManager;
use App\Models\GroupMemberManager;
use App\Models\ActivityLogManager;
use App\Models\GroupUserManager;
use App\Models\RestaurantManager;
use App\Models\UserManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class GroupController extends Controller
{
    public function getList()
    {
        return view('pages.groups');
    }

    public function getDetails($id)
    {
        $group = GroupManager::get($id);

        return view('pages.group.details', ['group' => $group]);
    }

    public function getRestaurants($id)
    {
        $group = GroupManager::get($id);

        return view('pages.group.restaurants', ['group' => $group]);

    }

    public function getMembers($id)
    {
        $group = GroupManager::get($id);

        return view('pages.group.userList', ['group' => $group]);
    }

    public function getSettings($id)
    {
        $group = GroupManager::get($id);

        return view('pages.group.settings', ['group' => $group]);
    }

    public function getNew()
    {
        return view('pages.newGroup');
    }

    public function postNew(Request $request)
    {
        $newGroup = GroupManager::save([
            'name' => $request->get('name'),
            'budget' => $request->get('budget')
        ]);

        GroupUserManager::save([
            'userId' => Auth::id(),
            'groupId' => $newGroup->id
        ]);

        ActivityLogManager::save([
            'id' => Helper::generateId(),
            'groupId' => $newGroup->id,
            'userId'=> Auth::id(),
            'activityId' => ActivityLogManager::getActivity(Helper::ADD, HELPER::GROUP_TABLE),
            'helperId' => $newGroup->id,
            'content' => $request->get('name')
        ]);

        $message = $newGroup ?
            'The insert operation succeeded.' :
            'An error occurred during the registration process.';
        $status = $newGroup;

        return view('pages.groups', [
            'message' => $message,
            'status' => $status
        ]);
    }

    public function postSaveSettings(Request $request)
    {
        $groupId = $request->get('groupId');
        GroupManager::save([
            'id' => $groupId,
            'name' => $request->get('name'),
            'budget' => $request->get('budget')
        ]);

        $group = GroupManager::get($groupId);
        ActivityLogManager::save([
            'id' => Helper::generateId(),
            'groupId' => $groupId,
            'userId'=> Auth::id(),
            'activityId' => ActivityLogManager::getActivity(Helper::UPDATE, HELPER::GROUP_TABLE),
            'helperId' => $groupId,
            'content' => json_encode(["name" => $group->getName(), "budget" => $group->getBudget()])  
        ]);

        return view('pages.group.settings', ['group' => $group]);
    }

    public function postNewMember(Request $request)
    {
        $groupId = $request->get('groupId');
        $email = $request->get('email');

        $user = UserManager::getUserByEmail($email);

        if ($user instanceof User) {
            $memberId = GroupUserManager::save([
                'userId' => $user->getId(),
                'groupId' => $groupId
            ]);
        } else {
            $memberId = GroupMemberManager::save([
                'groupId' => $groupId,
                'email' => $email,
                'invitorId' => Auth::id()
            ]);
        }

        ActivityLogManager::save([
            'id' => Helper::generateId(),
            'groupId' => $groupId,
            'userId'=> Auth::id(),
            'activityId' => ActivityLogManager::getActivity(Helper::ADD, Helper::GROUP_USER_TABLE),
            'helperId' => $memberId,
            'content' => $email,
        ]);

        $group = GroupManager::get($groupId);

        return view('pages.group.details', ['group' => $group]);
    }

    public function getDeleteGroup($id)
    {
        $group = GroupManager::get($id);
        GroupManager::delete($id);
        ActivityLogManager::save([
            'id' => Helper::generateId(),
            'groupId' => $id,
            'userId'=> Auth::id(),
            'activityId' => ActivityLogManager::getActivity(Helper::REMOVE, HELPER::GROUP_TABLE),
            'helperId' => $id,
            'content' => $group->getName(),
        ]);
        return view('pages.groups');
    }

    public function getGroupMemberDelete($groupId, $userId)
    {
        $user = UserManager::getUserById($userId);
        GroupUserManager::delete($groupId, $userId);

        ActivityLogManager::save([
            'id' => Helper::generateId(),
            'groupId' => $groupId,
            'userId'=> Auth::id(),
            'activityId' => ActivityLogManager::getActivity(Helper::REMOVE, Helper::GROUP_USER_TABLE),
            'helperId' => $userId,
            'content' => $user->getFirstName() . ' ' . $user->getLastName(),
        ]);

        return view('pages.groups');
    }
}
