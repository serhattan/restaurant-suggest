<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Helpers\Helper;
use App\Models\UserManager;
use Illuminate\Http\Request;
use App\Models\GroupUserManager;
use App\Service\Generate\Generate;
use App\Models\ActivityLogManager;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activityLogGroups = $groupIdList = [];
        $groups = GroupUserManager::getGroupsByUserId(Auth::id());
        foreach($groups as $group) {
            $groupIdList[] = $group->getGroupId();
        }
        $activityLogGroups = ActivityLogManager::getActivityLogsByGroupId($groupIdList);
        foreach($activityLogGroups as $key => $group) {
            $activityLogGroups[$key]->setContent(
                array_map(
                    function($object){
                        return (array) $object;
                    },
                    array(
                        json_decode(
                            $activityLogGroups[$key]->getContent()
                        )
                    )
                )[0]
            );
        }

        $generatedData = Generate::getGeneratedRestaurantByUserId(Auth::id());

        return view('home', ['activityLogGroups' => $activityLogGroups, 'generatedDatas' => $generatedData]);
    }

    public function settings()
    {
        return view('pages/settings');
    }

    public function update(Request $request)
    {
        $user = new Entity\User();
        $user->setId(Auth::id());

        if (!empty($request->get('language'))) {
            session(['language' => $request->get('language')]);
            $user->setLanguage($request->get('language'));
        }

        if(UserManager::update($user)) {
            return redirect('settings');
        }

        return false;
    }

    public function historyList()
    {
        $activityLogs = [];
        $activityLogs = ActivityLogManager::getActivityLogsByUserId(Auth::id());

        return view('pages/history', ['activityLogs' => Helper::getActivityLogs($activityLogs)]);
    }
}
