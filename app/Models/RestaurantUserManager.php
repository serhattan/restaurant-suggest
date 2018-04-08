<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

class RestaurantUserManager
{    
    /**
     * @return array
     */
    public static function getAll()
    {
        $restaurantsGroup = [];
        $restaurants = DB\Group::with([
            'groupUsers' => function ($query) {
                $query->where('status', Helper::STATUS_ACTIVE);
            },
            'restaurants' => function ($q) {
                $q->where('status', Helper::STATUS_ACTIVE);
            },
            'restaurants.restaurantUsers' => function ($query) {
                $query->where('user_id', Auth::id());
            }
        ])
        ->where('status', Helper::STATUS_ACTIVE)
        ->whereHas('groupUsers', function ($query) {
            $query->where('user_id', Auth::id());
            $query->where('status', Helper::STATUS_ACTIVE);
        })
        ->orderByDesc('created_at')
        ->get();

        foreach ($restaurants as $restaurant) {
            $restaurantsGroup[] = GroupManager::map($restaurant);
        }

        return $restaurantsGroup;
    }


    /**
     * @param DB\RestaurantUser $restaurantUserData
     * @return Entity\RestaurantUser
     */
    public static function map(DB\RestaurantUser $restaurantUserData)
    {
        $restaurantUser = new Entity\RestaurantUser();
        $restaurantUser->setId($restaurantUserData->id);
        $restaurantUser->setRestaurantId($restaurantUserData->restaurant_id);
        $restaurantUser->setUserId($restaurantUserData->user_id);
        $restaurantUser->setBudget($restaurantUserData->budget);
        $restaurantUser->setStatus($restaurantUserData->status);

        return $restaurantUser;
    }

    public static function mapExternal($restaurantUserData)
    {
        $restaurantUser = new Entity\RestaurantUser();
        if (isset($restaurantUserData['id'])) {
            $restaurantUser->setId($restaurantUserData['id']);
        }

        if (isset($restaurantUserData['restaurantId'])) {
            $restaurantUser->setRestaurantId($restaurantUserData['restaurantId']);
        }

        if (isset($restaurantUserData['userId'])) {
            $restaurantUser->setUserId($restaurantUserData['userId']);
        }

        if (isset($restaurantUserData['budget'])) {
            $restaurantUser->setBudget($restaurantUserData['budget']);
        }
        
        if (isset($restaurantUserData['status'])) {
            $restaurantUser->setStatus($restaurantUserData['status']);
        }

        return $restaurantUser;
    }


    public static function save(Entity\RestaurantUser $restaurantUser)
    {
        $userId = Auth::id();
        $restaurantId = $restaurantUser->getRestaurantId();
        $budget = $restaurantUser->getBudget();

        if (!empty($restaurantId) && !empty($budget)) {
            $restaurantUser = DB\RestaurantUser::where([
                'restaurant_id' => $restaurantId,
                'user_id' => $userId,
                'status' => Helper::STATUS_ACTIVE
            ]);

            if ($restaurantUser->first()) {
                $newRestaurantModel = $restaurantUser->update(['budget' => $budget]);
            } else {
                $newRestaurantUserModel = new DB\RestaurantUser();
                $newRestaurantUserModel->id = Helper::generateId();
                $newRestaurantUserModel->user_id = $userId;
                $newRestaurantUserModel->restaurant_id = $restaurantId;
                $newRestaurantUserModel->budget = $budget;
                $newRestaurantUserModel->status = Helper::STATUS_ACTIVE;
                $newRestaurantUserModel->save();
            }

            $restaurant = RestaurantManager::getById($restaurantId);
            ActivityLogManager::save([
                'id' => Helper::generateId(),
                'groupId' => $restaurant->getGroupId(),
                'userId'=> Auth::id(),
                'activityId' => ActivityLogManager::getActivity(Helper::UPDATE, Helper::RESTAURANT_USER_TABLE),
                'helperId' => $restaurantId,
                'content' => [
                    "userFullName" => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                    "restaurantName" => $restaurant->getName(),
                    "budget" => $budget,
                ]
            ]);

            return $restaurantId;
        }
    }
}
