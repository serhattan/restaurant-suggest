<?php

namespace App\Models;

use App\Models\DB;
use App\Models\Entity;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class RestaurantManager
{
    public static function getAllRestaurantsOfUser()
    {
        $restaurants = DB\Group::with(['groupUsers' => function ($query) {
            $query->where('status', Helper::STATUS_ACTIVE);
        }, 'restaurants'])
        ->where('status', Helper::STATUS_ACTIVE)
        ->whereHas('groupUsers', function ($query) {
            $query->where('user_id', Auth::id());
            $query->where('status', Helper::STATUS_ACTIVE);
        })
        ->get();

        foreach ($restaurants as $restaurant) {
            $restaurantsGroup[] = self::restaurantGroupsMap($restaurant);
        }

        return $restaurantsGroup;
    }

    public static function restaurantGroupsMap(DB\Group $restaurantGroupData)
    {
        $restaurantsGroup = new Entity\Group();
        $restaurantsGroup->setId($restaurantGroupData->id);
        $restaurantsGroup->setName($restaurantGroupData->name);
        $restaurantsGroup->setCreatedBy($restaurantGroupData->createdBy);
        $restaurantsGroup->setBudget($restaurantGroupData->budget);
        $restaurantsGroup->setStatus($restaurantGroupData->status);
        $restaurantsGroup->setUsers($restaurantGroupData->users);

        if ($restaurantGroupData->relationLoaded('restaurants') && !empty($restaurantGroupData->restaurants)) {
            foreach($restaurantGroupData->restaurants as $restaurant) {
                $restaurantsGroup->setRestaurants(self::map($restaurant));
            }
        }
        return $restaurantsGroup;
    }

    public static function map(DB\Restaurant $restaurantData)
    {
        $restaurant = new Entity\Restaurant();
        $restaurant->setId($restaurantData->id);
        $restaurant->setName($restaurantData->name);
        $restaurant->setGroupId($restaurantData->group_id);
        $restaurant->setStatus($restaurantData->status);
        $restaurant->setAveragePrice($restaurantData->average_price);

        return $restaurant;
    }

    public static function delete(Entity\Restaurant $restaurant)
    {
        try {
            $restaurant->setStatus(Helper::STATUS_DELETED);
        } catch (\Exception $e) {
            return $e;
        }

        if ($restaurant->save()) {
            return true;
        }
        return false;
    }

    public static function save(Entity\Restaurant $restaurant)
    {
        if (!Helper::isNull($restaurant->getId())) {
            $model = DB\Restaurant::find($restaurant->getId());
        }

        if ($model instanceof DB\Restaurant) {
            $model->id = $restaurant->getId();
            $model->name = $restaurant->getName();
            $model->group_id = $restaurant->getGroupId();
            $model->status = $restaurant->getStatus();
            $model->average_price = $restaurant->getAveragePrice();
            $model->save();

            return $model;
        }
    }
}


    // public static function getAllGroupsByGivingPrice()
    // {
    //     $restaurantUsers = DB\RestaurantUser::where('user_id', Auth::id())
    //        ->with(['restaurant' => function ($query) {
    //             $query->where('restaurant.status', Helper::STATUS_ACTIVE)
    //                 ->with(['group'=> function ($q) {
    //                     $q->where('group.status', Helper::STATUS_ACTIVE);
    //                 }]);
    //             }])
    //         ->where('status', Helper::STATUS_ACTIVE)
    //         ->get();

    //     foreach ($restaurantUsers as $restaurantUser) {
    //         $restaurant[] = self::multipleUserDataMapper($restaurantUser);
    //     }

    //     return $restaurant;
    // }

    // public static function multipleUserDataMapper(DB\RestaurantUser $restaurantUserData)
    // {
    //     $restaurantUser = new Entity\RestaurantUser();
    //     $restaurantUser->setId($restaurantUserData->id);
    //     $restaurantUser->setRestaurantId($restaurantUserData->restaurantId);
    //     $restaurantUser->setUserId($restaurantUserData->userId);
    //     $restaurantUser->setBudget($restaurantUserData->budget);
    //     $restaurantUser->setStatus($restaurantUserData->status);

    //     if ($restaurantUserData->relationLoaded('restaurant') && !empty($restaurantUserData->restaurant)) {
    //         $restaurantUser->setRestaurant(self::map($restaurantUserData->restaurant));
    //     }

    //     if ($restaurantUserData->restaurant->relationLoaded('group') && !empty($restaurantUserData->restaurant->group)) {
    //         $restaurantUser->setRestaurantGroup(GroupManager::map($restaurantUserData->restaurant->group));
    //     }

    //     return $restaurantUser;
    // }
