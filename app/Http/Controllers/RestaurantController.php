<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\RestaurantManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class RestaurantController extends Controller
{
    public function getList()
    {
        $restaurants = RestaurantManager::getAllRestaurantsOfUser();

        return view('pages.restaurant', ['datas' => $restaurants]);
    }

    public function saveBudget(Request $request)
    {
        if (!empty($request->get('restaurantId')) && is_numeric($request->get('budget'))) {
            $restaurantUser = new Entity\RestaurantUser();
            $restaurantUser->setRestaurantId($request->get('restaurantId'));
            $restaurantUser->setBudget($request->get('budget'));

            $restaurantId = RestaurantManager::saveRestaurantUser($restaurantUser);

            if (!empty($restaurantId)) {
                \App\Models\DB\Restaurant::where('id', $restaurantId)
                    ->where('status', Helper::STATUS_ACTIVE)
                    ->update(['average_price' => DB::select('select AVG(budget) as budget from restaurant_user where restaurant_id = ?', [$restaurantId])[0]->budget]);
                
                return redirect('restaurants');
            }
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
