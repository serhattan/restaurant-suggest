<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Helpers\Helper;
use App\Models\UserManager;
use Illuminate\Http\Request;
use App\Models\GenerateManager;
use App\Models\GroupUserManager;
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
        $groupIdList = [];
        $groups = GroupUserManager::getGroupsByUserId(Auth::id());
        foreach ($groups as $group) {
            $groupIdList[] = $group->getGroupId();
        }

        $activityLogGroups = ActivityLogManager::getByGroupIdList($groupIdList);

        $generatedData = GenerateManager::getGeneratedRestaurantByUserId(Auth::id());

        return view('home', ['activityLogGroups' => $activityLogGroups, 'generatedDatas' => $generatedData]);
    }

    public function likeAction($generateId, $isLike)
    {
        GenerateManager::saveGenerateUserLike($generateId, $isLike);

        return redirect('home');
    }

    public function settings()
    {
        return view('pages.settings');
    }

    public function update(Request $request)
    {
        $language = $request->get('language');
        if (!empty($language)) {

            UserManager::updateLanguage(Auth::id(), $language);

            session(['language' => $language]);

            return redirect('settings');
        }

        return false;
    }

    public function historyList()
    {
        return view('pages.history', [
            'activityLogs' => ActivityLogManager::getActivityLogsByUserId(Auth::id())
        ]);
    }
}
