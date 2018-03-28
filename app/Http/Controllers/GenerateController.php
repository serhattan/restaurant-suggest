<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\GroupUserManager;
class GenerateController extends Controller
{
    public function generateList()
    {
        $groupUsers = GroupUserManager::getGroupsByUserId(Auth::id());
        return view('pages.generate', ['groupUsers' => $groupUsers]);
    }
}
