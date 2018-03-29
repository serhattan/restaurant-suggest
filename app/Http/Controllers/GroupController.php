<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DB\GenerateDetail;
use App\Models\Entity\User;
use App\Models\GenerateDetailManager;
use App\Models\GenerateManager;
use App\Models\GroupManager;
use App\Models\GroupMemberManager;
use App\Models\ActivityLogManager;
use App\Models\GroupUserManager;
use App\Models\UserManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\Generate\Generate;
use PhpParser\Node\Stmt\GroupUse;

class GroupController extends Controller
{
    public function getList()
    {
        return view('pages.groups');
    }

    public function getDetails($id)
    {
        return view('pages.group.details', ['group' => GroupManager::get($id)]);
    }

    public function getRestaurants($id)
    {
        return view('pages.group.restaurants', ['group' => GroupManager::get($id)]);
    }

    public function getMembers($id)
    {
        return view('pages.group.userList', ['group' => GroupManager::get($id)]);
    }

    public function getSettings($id)
    {
        return view('pages.group.settings', ['group' => GroupManager::get($id)]);
    }

    public function getNew()
    {
        return view('pages.newGroup');
    }

    public function historyList($id)
    {
        return view('pages.group.history', [
            'activityLogs' => ActivityLogManager::getByGroupId($id),
            'group' => GroupManager::get($id)
        ]);
    }

    public function postNew(Request $request)
    {
        GroupManager::save([
            'name' => $request->get('name'),
            'budget' => $request->get('budget')
        ]);

        return view('pages.groups');
    }

    public function postSaveSettings(Request $request)
    {
        $groupId = $request->get('groupId');
        $group = GroupManager::map(GroupManager::save([
            'id' => $groupId,
            'name' => $request->get('name'),
            'budget' => $request->get('budget')
        ]));

        return view('pages.group.settings', ['group' => $group]);
    }

    public function postNewMember(Request $request)
    {
        $groupId = $request->get('groupId');
        $email = $request->get('email');

        GroupManager::newGroupUser($groupId, $email);

        $group = GroupManager::get($groupId);

        return view('pages.group.details', ['group' => $group]);
    }

    public function getDeleteGroup($id)
    {
        GroupManager::delete($id);

        return view('pages.groups');
    }

    public function getGroupMemberDelete($groupId, $userId)
    {
        GroupUserManager::delete($groupId, $userId);

        return view('pages.groups');
    }

    public function getRegenerate($groupId)
    {
        $generate = new Generate();

        $generated = GenerateManager::get($groupId);
        $restauant = $generated->getRestaurant();
        $regenerateCount = $restauant->getRegenerateCount() + 1;

        \App\Models\DB\Restaurant::where('id', $restauant->getId())
            ->where('status', Helper::STATUS_ACTIVE)
            ->update([
                'regenerate_count' => $regenerateCount
            ]);

        $generatedId = $generate->handle($groupId);
        $generatedRestaurant = \App\Models\DB\Generate::with('restaurant')->where('id', $generatedId)->first();
        $generatedRestaurant = GenerateManager::map($generatedRestaurant);
        $group = GroupManager::get($groupId);

        return view('pages.group.details', ['group' => $group, 'generate' => $generatedRestaurant]);
    }

    public function getGenerate($groupId)
    {
        $generate = new Generate();
        $generatedValue = \App\Models\DB\Generate::where('group_id', $groupId)->first();

        if (empty($generatedValue)) {
            $generate->handle($groupId);
        } else {
            $generatedValue = GenerateManager::map($generatedValue);
            $orderNo = $generatedValue->getOrderNo() + 1;
            $newGenerate = \App\Models\DB\GenerateDetail::where(['group_id' => $groupId, 'order_no' => $orderNo])->first();

            if (!empty($newGenerate)) {
                GenerateManager::saveForGenerateDetail(GenerateDetailManager::map($newGenerate));
            } else {
                $generate->handle($groupId);
            }
        }

        $generatedRestaurant = \App\Models\DB\Generate::with('restaurant')->where('group_id', $groupId)->first();
        $generatedRestaurant = GenerateManager::map($generatedRestaurant);
        $group = GroupManager::get($groupId);

        return view('pages.group.details', ['group' => $group, 'generate' => $generatedRestaurant]);
    }
}
