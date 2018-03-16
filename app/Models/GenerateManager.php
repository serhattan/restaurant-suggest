<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Entity\Generate;
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

        if (empty($generate->getId())) {
            $newGenerate->id = Helper::generateId();
        } else {
            $newGenerate = DB\Generate::where('id', $generate->getId())->first();
        }

        $newGenerate->group_id = $generate->getGroupId();
        $newGenerate->generate_detail_id = $generate->getGenerateDetailId();
        $newGenerate->restaurant_id = $generate->getRestaurantId();
        $newGenerate->order_no = $generate->getOrderNo();
        $newGenerate->save();

        return $newGenerate;
    }
}
