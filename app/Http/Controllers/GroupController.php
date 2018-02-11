<?php

namespace App\Http\Controllers;

use App\Models\GroupManager;

class GroupController extends Controller
{
    public function getList()
    {
        $groups = GroupManager::getAll();
        $firstGroup = null;
        if (count($groups) > 0) {
            $firstGroup = collect($groups)->first();
        }
        return view('pages.groups', ['groups' =>  $groups, 'firstGroup' => $firstGroup]);
    }

    public function getDetails()
    {

    }

    public function postNew()
    {

    }
}
