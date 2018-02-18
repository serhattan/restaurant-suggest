<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\UserManager;
use Illuminate\Http\Request;
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
        return view('home');
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
}
