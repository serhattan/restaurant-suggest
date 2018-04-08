<?php

namespace App\Http\Controllers;

use App\Models\DB\RestaurantUser;
use App\Models\Entity;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\RestaurantManager;
use App\Models\UserManager;
use App\Models\ActivityLogManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class RestaurantController extends Controller
{
    public function getList()
    {
        return view('pages.restaurant', [
            'datas' => RestaurantManager::getAllRestaurantsOfUser()
        ]);
    }

    public function saveBudget(Request $request)
    {
        RestaurantManager::saveBudget($request);

        return redirect('restaurants');
    }

    public function remove(Request $request, $id)
    {
        if (RestaurantManager::remove($id) && $request->is('restaurants/remove/*')) {
            return redirect('restaurants');
        }
    }

    public function addRestaurant($groupId)
    {
        return view('pages.addRestaurant', [
            'groupId' => $groupId,
            'restaurants' => RestaurantManager::getAllByGroupId($groupId)
        ]);
    }

    public function saveRestaurant(Request $request)
    {
        RestaurantManager::save(
            RestaurantManager::mapExternalRestaurant([
                'name' => $request->get('restaurantName'),
                'groupId' => $request->get('groupId'),
                'distance' => $request->get('distance')
            ])
        );

        return redirect('restaurants');
    }
}
