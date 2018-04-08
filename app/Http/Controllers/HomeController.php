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
        return view('home', [
            'activityLogGroups' => ActivityLogManager::getUserGroupsActivityLogs(Auth::id()),
            'generatedDatas' => GenerateManager::getGeneratedRestaurantByUserId(Auth::id())
        ]);
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
        UserManager::updateLanguage(Auth::id(), $request->get('language'));

        return redirect('settings');
    }

    public function historyList()
    {
        return view('pages.history', [
            'activityLogs' => ActivityLogManager::getActivityLogsByUserId(Auth::id())
        ]);
    }
}
