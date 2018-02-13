<?php

namespace App\Http\Controllers;

use App\Models\GroupManager;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function getList()
    {
        $groups = GroupManager::getAll();
        $firstGroup = null;
        if (count($groups) > 0) {
            $firstGroup = collect($groups)->first();
        }
        return view('pages.groups', ['groups' => $groups, 'firstGroup' => $firstGroup]);
    }

    public function getDetails()
    {

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

        $message = $newGroup ?
            'The insert operation succeeded.' :
            'An error occurred during the registration process.';
        $status = $newGroup;

        return view('pages.newGroup', [
            'message' => $message,
            'status' => $status
        ]);
    }
}
