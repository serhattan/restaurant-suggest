<?php

namespace App\Models;

use App\Models\DB;
use App\Models\Entity;
use App\Helpers\Helper;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;

class RestaurantManager
{
    /**
     * @param $id
     * @return Entity\Restaurant
     */
    public static function getById($id)
    {
        $restaurant = DB\Restaurant::find($id);

        if ($restaurant instanceof DB\Restaurant) {
            return self::map($restaurant);
        }
    }

    /**
     * @param $groupId
     * @return Entity\Restaurant[]
     */
    public static function getAllByGroupId($groupId)
    {
        $restaurants = DB\Restaurant::where([
            'group_id' => $groupId, 
            'status' => Helper::STATUS_ACTIVE
        ])->get();

        return self::multiMap($restaurants);
    }

    /**
     * @param DB\Restaurant[] $restaurants
     * @return Entity\Restaurant[]
     */
    public static function multiMap($restaurants)
    {
        $list = [];
        foreach ($restaurants as $restaurant) {
            $list[] = self::map($restaurant);
        }

        return $list;
    }

    /**
     * @param DB\Restaurant $restaurantData
     * @return Entity\Restaurant
     */
    public static function map(DB\Restaurant $restaurantData)
    {
        $restaurant = new Entity\Restaurant();
        $restaurant->setId($restaurantData->id);
        $restaurant->setName($restaurantData->name);
        $restaurant->setGroupId($restaurantData->group_id);
        $restaurant->setStatus($restaurantData->status);
        $restaurant->setAveragePrice($restaurantData->average_price);
        $restaurant->setDistance($restaurantData->distance);
        $restaurant->setRegenerateCount($restaurantData->regenerate_count);

        if ($restaurantData->relationLoaded('restaurantUsers') && !empty($restaurantData->restaurantUsers)) {
            foreach ($restaurantData->restaurantUsers as $restaurantUser) {
                $restaurant->setRestaurantUsers(RestaurantUserManager::map($restaurantUser));
            }
        }

        return $restaurant;
    }

    /**
     * @param $restaurantData
     * @return Entity\Restaurant
     */
    public static function mapExternal($restaurantData)
    {
        $restaurant = new Entity\Restaurant();
        if (isset($restaurantData['name'])) {
            $restaurant->setName($restaurantData['name']);
        }

        if (isset($restaurantData['groupId'])) {
            $restaurant->setGroupId($restaurantData['groupId']);
        }

        if (isset($restaurantData['status'])) {
            $restaurant->setStatus($restaurantData['status']);
        }

        if (isset($restaurantData['averagePrice'])) {
            $restaurant->setAveragePrice($restaurantData['averagePrice']);
        }

        if (isset($restaurantData['distance'])) {
            $restaurant->setDistance($restaurantData['distance']);
        }

        if (isset($restaurantData['regenerateCount'])) {
            $restaurant->setRegenerateCount($restaurantData['regenerateCount']);
        }

        if (isset($restaurantData['restaurantUsers'])) {
            $restaurant->setRestaurantUsers($restaurantData['restaurantUsers']);
        }

        return $restaurant;
    }

    public static function delete(Entity\Restaurant $restaurant)
    {
        $restaurant->setStatus(Helper::STATUS_DELETED);

        if ($restaurant->save()) {
            return true;
        }
        return false;
    }

    public static function save(Entity\Restaurant $restaurant)
    {
        $newRestaurant = new DB\Restaurant();
        if (empty($restaurant->getId())) {
            $restaurant->setId(Helper::generateId());
            $restaurant->setStatus(Helper::STATUS_ACTIVE);
            $restaurant->setAveragePrice(0.00);
            $restaurant->setRegenerateCount(0);
        } else {
            $newRestaurant = DB\Restaurant::find($restaurant->getId());
        }

        if ($newRestaurant instanceof DB\Restaurant) {
            $newRestaurant->id = $restaurant->getId();
            $newRestaurant->name = $restaurant->getName();
            $newRestaurant->group_id = $restaurant->getGroupId();
            $newRestaurant->status = $restaurant->getStatus();
            $newRestaurant->average_price = $restaurant->getAveragePrice();
            $newRestaurant->distance = $restaurant->getDistance();
            $newRestaurant->regenerate_count = $restaurant->getRegenerateCount();
            $newRestaurant->save();

            $user = UserManager::getById(Auth::id());
            ActivityLogManager::save([
                'id' => Helper::generateId(),
                'groupId' => $restaurant->getGroupId(),
                'userId'=> $user->getId(),
                'activityId' => ActivityLogManager::getActivity(Helper::ADD, Helper::RESTAURANT_TABLE),
                'helperId' => $restaurant->getId(),
                'content' => [
                    "userFullName" => $user->getFullName(),
                    "restaurantName" => $restaurant->getName()
                ],
            ]);

            return $restaurant->getId();
        }
    }

    public static function saveBudget($request)
    {
        if (!empty($request->get('restaurantId')) && is_numeric($request->get('budget'))) {
            $restaurantId = RestaurantUserManager::save(
                RestaurantUserManager::mapExternal([
                    'restaurantId' => $request->get('restaurantId'),
                    'budget' => $request->get('budget')
                ])
            );

            if (!empty($restaurantId)) {

                $averagePrice = Facades\DB::select('select AVG(budget) as budget from restaurant_user where restaurant_id = ?', [$restaurantId])[0]->budget;

                $restaurant = \App\Models\DB\Restaurant::where('id', $restaurantId)
                    ->where('status', Helper::STATUS_ACTIVE);
                $restaurant->update([
                    'average_price' => $averagePrice
                ]);

                $restaurant = self::map($restaurant->first());

                ActivityLogManager::save([
                    'id' => Helper::generateId(),
                    'groupId' => $restaurant->getGroupId(),
                    'userId'=> Auth::id(),
                    'activityId' => ActivityLogManager::getActivity(Helper::UPDATE, Helper::RESTAURANT_TABLE),
                    'helperId' => $restaurantId,
                    'content' => [
                        "userFullName" => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                        "restaurantName" => $request->get('restaurantName'),
                        "averageBudget" => $averagePrice
                    ]
                ]);

                return true;
            }
        }

        return false;
    }

    public static function remove($id)
    {
        $restaurant = DB\Restaurant::where('id', $id);
        $restaurant->update(['status' => Helper::STATUS_DELETED]);
        
        $restaurant = self::map($restaurant->first());
        $admin = UserManager::getById(Auth::id());

        ActivityLogManager::save([
            'id' => Helper::generateId(),
            'groupId' => $restaurant->getGroupId(),
            'userId'=> $admin->getId(),
            'activityId' => ActivityLogManager::getActivity(Helper::REMOVE, Helper::RESTAURANT_TABLE),
            'helperId' => $restaurant->getId(),
            'content' => [
                "userFullName" => $admin->getFullName(),
                "restaurantName" => $restaurant->getName()
            ],
        ]);

        return true;
    }
}
