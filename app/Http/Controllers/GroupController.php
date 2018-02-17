<?php

namespace App\Http\Controllers;

use App\Models\GroupManager;
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
        $group = GroupManager::get($id);

        return view('pages.group.details', ['group' => $group]);
    }

    public function getRestaurants($id)
    {

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

        $newGroupUser = GroupUserManager::save([
            'userId' => Auth::id(),
            'groupId' => $newGroup->id
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
        $settings = GroupManager::save([
            'id' => $groupId,
            'name' => $request->get('name'),
            'budget' => $request->get('budget')
        ]);

        $group = GroupManager::get($groupId);

        return view('pages.group.settings', ['group' => $group]);
    }
}
