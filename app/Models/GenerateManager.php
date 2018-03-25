<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Entity\Generate;
use App\Models\Entity\GenerateUserlike;
use App\Models\Entity\GenerateDetail;
use App\Models\DB;

class GenerateManager
{
    /**
     * @param DB\Generate $data
     * @return Generate
     */
    public static function map(DB\Generate $data)
    {
        $generate = new Generate();
        $generate->setId($data->id);
        $generate->setGroupId($data->group_id);
        $generate->setRestaurantId($data->restaurant_id);
        $generate->setGenerateDetailId($data->generate_detail_id);
        $generate->setOrderNo($data->order_no);

        if ($data->relationLoaded('restaurant') && !empty($data->restaurant)) {
            $generate->setRestaurant(RestaurantManager::map($data->restaurant));
        }

        return $generate;
    }

    public static function generateUserLikeMap(DB\GenerateUserLike $data)
    {
        $generateUserLike = new GenerateUserLike();
        $generateUserLike->setId($data->id);
        $generateUserLike->userId($data->user_id);
        $generateUserLike->generateId($data->generate_id);

        if ($data->relationLoaded('user') && !empty($data->user)) {
            $generateUserLike->setUser(UserManager::map($user));
        }

        if ($data->relationLoaded('generate') && !empty($data->generate)) {
            $generateUserLike->setGenerate(GenerateManager::map($generate));
        }

        return $generateUserLike;
    }

    /**
     * @param $data
     * @return Generate
     */
    public static function mapExternal($data)
    {
        $generate = new Generate();
        if (isset($data['id'])) {
            $generate->setId($data['id']);
        }
        $generate->setGroupId($data['groupId']);
        $generate->setRestaurantId($data['restaurantId']);
        $generate->setGenerateDetailId($data['generateDetailId']);
        $generate->setOrderNo($data['orderNo']);

        return $generate;
    }

    /**
     * @param Generate $generate
     * @return bool
     */
    public static function save(Generate $generate)
    {
        $newGenerate = new DB\Generate();
        
        self::removeGenerate($generate->getGroupId());

        $newGenerate->id = Helper::generateId();
        $newGenerate->group_id = $generate->getGroupId();
        $newGenerate->generate_detail_id = $generate->getGenerateDetailId();
        $newGenerate->restaurant_id = $generate->getRestaurantId();
        $newGenerate->order_no = $generate->getOrderNo();
        $newGenerate->save();

        return $newGenerate;
    }

    public static function removeGenerate($groupId)
    {
        return DB\Generate::where('group_id', $groupId)->delete();
    }

    public static function saveForGenerateDetail(GenerateDetail $generateDetail)
    {
        $newGenerate = new DB\Generate();

        self::removeGenerate($generateDetail->getGroupId());

        $newGenerate->id = Helper::generateId();
        $newGenerate->group_id = $generateDetail->getGroupId();
        $newGenerate->generate_detail_id = $generateDetail->getId();
        $newGenerate->restaurant_id = $generateDetail->getRestaurantId();
        $newGenerate->order_no = $generateDetail->getOrderNo();
        $newGenerate->save();

        return $newGenerate;
    }
}
