<?php

namespace App\Http\Controllers;

use App\Models\RestaurantUserManager;
use Illuminate\Http\Request;
use App\Models\RestaurantManager;

class RestaurantController extends Controller
{
    public function getList()
    {
        return view('pages.restaurant', [
            'datas' => RestaurantUserManager::getAll()
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
            RestaurantManager::mapExternal([
                'name' => $request->get('restaurantName'),
                'groupId' => $request->get('groupId'),
                'distance' => $request->get('distance')
            ])
        );

        return redirect('restaurants');
    }
}
