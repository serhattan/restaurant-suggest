<?php

namespace App\Http\Controllers;

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
        $restaurants = RestaurantManager::getAllRestaurantsOfUser();

        return view('pages.restaurant', ['datas' => $restaurants]);
    }

    public function saveBudget(Request $request)
    {
        $userId = Auth::id();
        $user = UserManager::getUserById($userId);
        if (!empty($request->get('restaurantId')) && is_numeric($request->get('budget'))) {
            $restaurantUser = new Entity\RestaurantUser();
            $restaurantUser->setRestaurantId($request->get('restaurantId'));
            $restaurantUser->setBudget($request->get('budget'));
            $restaurantId = RestaurantManager::saveRestaurantUser($restaurantUser);
            $restaurant = RestaurantManager::getRestaurantById($restaurantId);

            if (!empty($restaurantId)) {
                ActivityLogManager::save([
                    'id' => Helper::generateId(),
                    'groupId' => $restaurant->getGroupId(),
                    'userId'=> $userId,
                    'activityId' => ActivityLogManager::getActivity(Helper::UPDATE, Helper::RESTAURANT_USER_TABLE),
                    'helperId' => $restaurantId,
                    'content' => json_encode([
                        "userName" => $user->getFirstName(),
                        "userLastName" => $user->getLastName(),
                        "restaurantName" => $request->get('restaurantName'),
                        "budget" => $request->get('budget')
                    ])
                ]);

                $averagePrice = DB::select('select AVG(budget) as budget from restaurant_user where restaurant_id = ?', [$restaurantId])[0]->budget;
                \App\Models\DB\Restaurant::where('id', $restaurantId)
                    ->where('status', Helper::STATUS_ACTIVE)
                    ->update([
                        'average_price' => $averagePrice
                    ]);

                ActivityLogManager::save([
                    'id' => Helper::generateId(),
                    'groupId' => $restaurant->getGroupId(),
                    'userId'=> $userId,
                    'activityId' => ActivityLogManager::getActivity(Helper::UPDATE, Helper::RESTAURANT_TABLE),
                    'helperId' => $restaurantId,
                    'content' => json_encode([
                        "restaurantName" => $request->get('restaurantName'),
                        "averageBudget" => $averagePrice
                    ])
                ]);

                return redirect('restaurants');
            }
        }

        return false;
    }

    public function remove(Request $request, $id)
    {
        if ($request->is('restaurants/remove/*')) {
            if (RestaurantManager::remove($id)) {
                $restaurant = RestaurantManager::getRestaurantById($id);
                ActivityLogManager::save([
                    'id' => Helper::generateId(),
                    'groupId' => $restaurant->getGroupId(),
                    'userId'=> Auth::id(),
                    'activityId' => ActivityLogManager::getActivity(Helper::REMOVE, Helper::RESTAURANT_TABLE),
                    'helperId' => $restaurant->getId(),
                    'content' => $restaurant->getName(),
                ]);

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

        ActivityLogManager::save([
            'id' => Helper::generateId(),
            'groupId' => $restaurant->getGroupId(),
            'userId'=> Auth::id(),
            'activityId' => ActivityLogManager::getActivity(Helper::ADD, Helper::RESTAURANT_TABLE),
            'helperId' => $restaurant->getId(),
            'content' => $restaurant->getName(),
        ]);
        return redirect('restaurants');
    }
}
