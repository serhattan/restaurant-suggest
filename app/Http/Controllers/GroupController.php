<?php

namespace App\Http\Controllers;

use App\Models\GenerateManager;
use App\Models\GroupManager;
use App\Models\ActivityLogManager;
use App\Models\GroupUserManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function getList()
    {
        return view('pages.groups');
    }

    public function getDetails($id)
    {
        return view('pages.group.details', [
            'group' => GroupManager::get($id),
            'activityLogs' => ActivityLogManager::getByGroupId($id),
            'isAdmin' => GroupUserManager::adminCheck($id, Auth::id())
        ]);
    }

    public function getRestaurants($id)
    {
        return view('pages.group.restaurants', ['group' => GroupManager::get($id)]);
    }

    public function getMembers($id)
    {
        return view('pages.group.userList', ['group' => GroupManager::get($id)]);
    }

    public function getSettings($id)
    {
        return view('pages.group.settings', ['group' => GroupManager::get($id)]);
    }

    public function getNew()
    {
        return view('pages.newGroup');
    }

    public function historyList($id)
    {
        return view('pages.group.history', [
            'activityLogs' => ActivityLogManager::getByGroupId($id),
            'group' => GroupManager::get($id)
        ]);
    }

    public function postNew(Request $request)
    {
        GroupManager::save([
            'name' => $request->get('name'),
            'budget' => $request->get('budget')
        ]);

        return view('pages.groups');
    }

    public function postSaveSettings(Request $request)
    {
        $group = GroupManager::map(
            GroupManager::save([
                'id' => $request->get('groupId'),
                'name' => $request->get('name'),
                'budget' => $request->get('budget')
            ])
        );

        return view('pages.group.settings', ['group' => $group]);
    }

    public function postNewMember(Request $request)
    {
        $groupId = $request->get('groupId');
        GroupManager::newGroupUser($groupId, $request->get('email'));

        return view('pages.group.details', ['group' => GroupManager::get($groupId)]);
    }

    public function getDeleteGroup($id)
    {
        GroupManager::delete($id);

        return view('pages.groups');
    }

    public function getGroupMemberDelete($groupId, $userId)
    {
        GroupUserManager::delete($groupId, $userId);

        return view('pages.groups');
    }

    public function getRegenerate($groupId)
    {
        GenerateManager::regenerate($groupId);

        return view('pages.group.details', [
            'group' => GroupManager::get($groupId),
            'generate' => GenerateManager::get($groupId)
        ]);
    }

    public function getGenerate($groupId)
    {
        GenerateManager::generate($groupId);

        return view('pages.group.details', [
            'group' => GroupManager::get($groupId),
            'generate' => GenerateManager::get($groupId)
        ]);
    }
}
