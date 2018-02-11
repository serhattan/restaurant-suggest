<?php

namespace App;

use App\Models\DB;
use App\Models\Entity;
use Illuminate\Database\Eloquent\Model;

class RestaurantManager
{
    /**
     * @param $restaurantData
     * @return Entity\Restaurant
     */

    public static function mapRestaurant (DB\Restaurant $restaurantData) 
    {
        $restaurant = new Entity\Restaurant();
        $restaurant->setId($id);
        $restaurant->setName($name);
        $restaurant->setGroupId($groupId);
        $restaurant->setStatus($status);
        $restaurant->setAveragePrice($averagePrice);
    }

    public static function delete (Entity\Restaurant $restaurant)
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

    public static function save (Entity\Restaurant $restaurant)
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
