<?php

namespace App\Http\Controllers;

use App\Models\GroupManager;

class GenerateController extends Controller
{
    public function generateList()
    {
        return view('pages.generate', [
            'groups' => GroupManager::getAll()
        ]);
    }
}
