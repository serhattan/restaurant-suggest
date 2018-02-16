<?php

namespace App\Http\ViewComposers;


use App\Models\GroupManager;
use Illuminate\View\View;

class GroupListComposer
{
    public $groupList = [];

    /**
     * ProjectComposer constructor.
     */
    public function __construct()
    {
        $this->groupList = GroupManager::getAll();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('groupList', $this->groupList);
    }
}