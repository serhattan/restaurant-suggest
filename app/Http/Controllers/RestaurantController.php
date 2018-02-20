<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;
use App\Models\RestaurantManager;
use Illuminate\Support\Facades\Input;

class RestaurantController extends Controller
{
    public function getList()
    {
        $restaurants = RestaurantManager::getAllRestaurantsOfUser();

        return view('pages.restaurant', ['datas' => $restaurants]);
    }

    public function saveAveragePrice(Request $request)
    {
        if (!empty($request->get('restaurantId')) && is_numeric($request->get('newAveragePrice'))) {
            $restaurant = new Entity\Restaurant();
            $restaurant->setId($request->get('restaurantId'));
            $restaurant->setAveragePrice($request->get('newAveragePrice'));
        }

        if (RestaurantManager::update($restaurant)) {
            return redirect('restaurants');
        }

        return false;
    }

    public function remove(Request $request, $id)
    {
        if ($request->is('restaurants/remove/*')) {
            if (RestaurantManager::remove($id)) {
                return redirect('restaurants');
            }
            return false;
        }
    }

    public function addRestaurant($groupId)
    {
        return view('pages.addRestaurant', ['groupId' => $groupId]);
    }

    public function saveRestaurant(Request $request)
    {
        $restaurant = new Entity\Restaurant();
        $restaurant->setName($request->get('restaurantName'));
        $restaurant->setGroupId($request->get('groupId'));
        $restaurant->save($restaurant);

        return redirect('restaurants');
    }
}
