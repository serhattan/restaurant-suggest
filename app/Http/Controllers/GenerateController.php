<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\GroupUserManager;
class GenerateController extends Controller
{
    public function generateList()
    {
        return view('pages.generate', [
            'groupUsers' => GroupUserManager::getGroupsByUserId(Auth::id())
        ]);
    }
}
